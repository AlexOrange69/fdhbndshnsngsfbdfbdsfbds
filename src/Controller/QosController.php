<?php

namespace App\Controller;

use App\Entity\NoSQL\Data;
use App\Entity\NoSQL\DataLists\ListeCommandesEnCours;
use App\Entity\NoSQL\Historique;
use App\Entity\MariaDB\TepQos;
use App\Entity\NoSQL\ReportData;
use App\Entity\NoSQL\ListReportData;
use App\Processing\GlobalFunction;
use App\Processing\initializationNoSqlData;
use App\Repository\ClientsQosRepository;
use App\Repository\ImportDataQosRepository;
use App\Repository\RetardQosRepository;
use App\Repository\TepQosRepository;
use Doctrine\Persistence\ManagerRegistry;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Processing\SqlProcessing;
use App\Processing\DataProcessing;


class QosController extends AbstractController
{

/**
 * There are all the routes/api of the project
 *
 *  @var $doctrine = making insert, modification and deletion into database
 *  @var $RepositoryRequest = making request searching into database (All the method are into the repository folder)
 *  @var $sqlProcessing = is refere to the file SqlProcessing.php, this file is use for database update
 */

    private HttpClientInterface $clientHttp;

    private static $loggerRequest;


    public function __construct(HttpClientInterface $clientHttp)
    {
        $this->clientHttp = $clientHttp;
        self::$loggerRequest = new Logger("Request");

    }

    #[Route('/GetClients', name: 'get_clients', methods: "GET")]
    public function getClients(ClientsQosRepository $repositoryRequest): Response
    {
        return $this->json([
            'clients' => $repositoryRequest->requestGetClient()
        ]);
    }


    /* --- GET DATA FOR QOS FRONT ---*/

    /** Route to call for get data retard by client */

    #[Route('/GetRetardFor/{client}/{date}', name: 'get_retard_by_client', methods: "GET")]
    public function getRetardByClient(RetardQosRepository $repositoryRequest, $client, $date): Response
    {
        $date = str_replace("#-#", '/', $date);
        return $this->json([
            'jsonRetardData' => $repositoryRequest->requestGetRetardByClientAndDate($client, $date)
        ]);
    }

    /** Route to call for get data TEP by client */

    #[Route('/GetTepFor/{client}/{date}', name: 'get_tep_by_client', methods: "GET")]
    public function getTepByClient(ManagerRegistry $doctrine, SqlProcessing $sqlRequest, $client, $date): Response
    {
        $date = str_replace("#-#", '/', $date);
        $repository = $doctrine->getRepository(TepQos::class);
        $updateTepData=$repository->findBy(["date" => $date, "client" => $client]);
        if (!$updateTepData) {
            $updateTepData=$sqlRequest->createNewMonthlyTep($client, $doctrine, $date);
            if ($updateTepData === true) {
                $updateTepData=$repository->findBy(["date" => $date, "client" => $client]);
            } else {
                $updateTepData = "problème";
            }
        }
        return $this->json([
            'jsonTepData' => $updateTepData
        ]);
    }

    #[Route('/getDeliveryData/{client}/{date}', name: 'get_data_delivery', methods: "GET")]
    public function getMonthlyDeliveryData(ImportDataQosRepository $dataRepositoryRequest, $client, $date): Response
    {
        $date = str_replace("#-#", '/', $date);
        return $this->json([
            "jsonDeliveryData" => $dataRepositoryRequest->requestGetDeliveryData($client, $date)
        ]);
    }

    #[Route('/addClient/{client}', name: 'add_clients', methods: "GET")]
    public function addClients(ManagerRegistry $doctrine, SqlProcessing $sqlRequest, $client): Response
    {
        $requestInfo = $sqlRequest->addClient($client, $doctrine);

        return new Response("Client ajouté");
    }

    #[Route('/deleteClient/{client}', name: 'delete_clients', methods: "GET")]
    public function deleteClients(ManagerRegistry $doctrine, SqlProcessing $sqlRequest, $client): Response
    {
        try {
            $data = $repositoryRequest->findAll();
        } catch (\Exception $e) {
            self::$loggerRequest->error('Call request "get_tep_powerBI" failure');
            return new Response("ERREUR : Lors de la récuperation de vos données.", 404);
        }
        self::$loggerRequest->info('Call request "get_tep_powerBI" succeeded');
        return $this->json(['tepData' => $data]);
    }


    /* --- UPDATE DATA FROM QOS FRONT ---*/

    /** Route to call for update data table data_qos and retard_qos */

    #[Route('/uploadQosData', name: 'upload_monthly_data', methods: "POST")]
    public function updateMonthlyData(ManagerRegistry $doctrine, ImportDataQosRepository $repositoryRequestImportData, SqlProcessing $sqlRequest, GlobalFunction $useGlobalFunction): Response
    {
        /** Get excel data file from WEBIX4 */

        $dataBrut = $_POST['data'] ?? null;

        if ($dataBrut != null) {
            $data = json_decode($dataBrut, true);

            /** Insert new data in data table */

            $statutuploadData = $sqlRequest->uploadDataWebixToServer($data, $doctrine, $useGlobalFunction);
            if ($statutuploadData === true) {

                /**  Get data with variable "retard" = "oui" for making retard data table */

                $statutUploadRetardTable = $sqlRequest->uploadRetardTable($repositoryRequestImportData, $doctrine);
                if ($statutUploadRetardTable === true){
                    self::$loggerRequest->info('Call request "upload_monthly_data" succeeded');
                    return new Response("SUCCES : La mise a jour des données a été réussie", 200);
                }else{
                    self::$loggerRequest->error('Call request "upload_monthly_data" failure (lvl 3 : doctrine "RetardQOS" symfony failure)' );
                    return new Response("ERREUR : Lors de l'insertion des données concernant les retards", 404);
                }

            } else {
                self::$loggerRequest->error('Call request "upload_monthly_data" failure (lvl 2 : doctrine "ImportDataQOS" symfony failure)' );
                return new Response("ERREUR : Lors de l'insertion des données.", 404);
            }

        } else {
            self::$loggerRequest->error('Call request "upload_monthly_data" failure (lvl 1 : Empty data)' );
            return new Response("ERREUR : Le fichier envoyé est vide", 404);
        }
    }

    /** Route to call for update data table retard */

    #[Route('/updateRetardTable', name: 'update_data_retard', methods: "POST")]
    public function updateDataRetard(SqlProcessing $sqlRequest, ManagerRegistry $doctrine): Response
    {
        $updateDataRetard = $_POST['data'] ?? null;
        if ($updateDataRetard != null) {
            $dataRetard = json_decode($updateDataRetard, true);
            $statutUpdateRetardTable = $sqlRequest->updateRetardTableByDps($dataRetard, $doctrine);
            if ($statutUpdateRetardTable === true) {
                self::$loggerRequest->info('Call request "update_data_retard" succeeded');
                return new Response("Data upload", 200);
            } else {
                self::$loggerRequest->error('Call request "update_data_retard" failure (lvl 2 : doctrine symfony failure)' );
                return new Response("ERREUR : Lors de la mise a jour de la table des retards.",404);
            }
        } else {
            self::$loggerRequest->error('Call request "update_data_retard" failure (lvl 1 : Empty data)' );
            return new Response("ERREUR : Lors de la récuperation de vos données.", 404);
        }
    }

    /** Route to call for update data table Tep */

    #[Route('/updateTepTable', name: 'update_data_tep', methods: "POST")]
    public function updateDataTep(SqlProcessing $sqlRequest, ManagerRegistry $doctrine): Response
    {
        $updateDataTep = $_POST['data'] ?? null;
        if ($updateDataTep != null) {
            $dataTep = json_decode($updateDataTep, true);
            $statutUpdateTepTable = $sqlRequest->updateTepTableById($dataTep, $doctrine);
            if ($statutUpdateTepTable === true) {
                self::$loggerRequest->info('Call request "update_data_tep" succeeded');
                return new Response("Data upload");
            } else {
                self::$loggerRequest->error('Call request "update_data_tep" failure (lvl 2 : échec de la doctrine symfony)' );
                return new Response("ERREUR : Lors de la mise à jour de la table du TEP.",404);
            }
        } else {
            self::$loggerRequest->error('Call request "update_data_tep" failure (lvl 1 : données reçu vide)' );
            return new Response("ERREUR : Lors de la récuperation des données envoyées.", 404);
        }
    }




    /* --- PARTIE DATA FOR POWER BI ---*/

    #[Route('/getAllDataQOS', name: 'get_data_powerBI', methods: "GET")]
    public function getAllData(ImportDataQosRepository $repositoryRequest): Response
    {
        try {
            $data = $repositoryRequest->findAll();
        } catch (\Exception $e) {
            return new Response("ERREUR : Lors de la récuperation de vos données.", 404);
            self::$loggerRequest->error('Call request "get_data_powerBI" failure');
        }
        self::$loggerRequest->info('Call request "get_data_powerBI" succeeded');
        return $this->json(['data' => $data]);
    }

    #[Route('/getAllRetardQOS', name: 'get_retard_powerBI', methods: "GET")]
    public function getAllDataRetard(RetardQosRepository $repositoryRequest): Response
    {
        try {
            $data = $repositoryRequest->findAll();
        } catch (\Exception $e) {
            return new Response("ERREUR : Lors de la récuperation de vos données.", 404);
            self::$loggerRequest->error('Call request "get_retard_powerBI" failure');
        }
        self::$loggerRequest->info('Call request "get_retard_powerBI" succeeded');
        return $this->json(['retardData' => $data]);
    }

    #[Route('/getAllTepQOS', name: 'get_tep_powerBI', methods: "GET")]
    public function getAllDataTep(TepQosRepository $repositoryRequest): Response
    {
        try {
            $data = $repositoryRequest->findAll();
        } catch (\Exception $e) {
            return new Response("ERREUR : Lors de la récuperation de vos données.", 404);
            self::$loggerRequest->error('Call request "get_tep_powerBI" failure');
        }
        self::$loggerRequest->info('Call request "get_tep_powerBI" succeeded');
        return $this->json(['tepData' => $data]);
    }

    #[Route('/getAllTepQOS2', name: 'get_tep_powerBI2', methods: "GET")]
    public function getAllDataTep2(): Response
    {
        self::$loggerRequest->info('Call request "get_tep_powerBI" failure');
        return new Response("Succes : Lors de la récuperation de vos données.", 200);
    }
}

