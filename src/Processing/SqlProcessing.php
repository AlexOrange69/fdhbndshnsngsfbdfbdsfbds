<?php

namespace App\Processing;

use App\Entity\MariaDB\Clients;
use App\Entity\MariaDB\ImportDataQos;
use App\Entity\MariaDB\RetardQos;
use App\Entity\MariaDB\TepQos;
use App\Repository\ImportDataQosRepository;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Exception\DriverException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class SqlProcessing
{




    public function uploadDataWebixToServer(
        array           $data,
        ManagerRegistry $doctrine,
        GlobalFunction  $globalFunction
    ) : bool {
        $em = $doctrine->getManager();

        /** Here we use @var = $data like an array because we get this data from front service by excel data from Webix4   */

        $repository = $doctrine->getRepository(ImportDataQos::class);
        foreach ($data as $id => $key) {
            $checkData = $repository->find($key['DPS']);
            if ($checkData) {
                $newData = $this->importUpdateFunction($checkData, $key, $globalFunction, 1);
            } else {
                $newData = $this->importUpdateFunction(new ImportDataQos(), $key, $globalFunction, 2);
            }
                $em->persist($newData);
        }
        $em->flush();
        return true;
    }


    public function uploadRetardTable(DataQosRepository $repositoryRequest, ManagerRegistry $doctrine) : bool
    {
        /** Here we use @var = $getData like an object because we get this data from database   */

        $em = $doctrine->getManager();

        $getData = $repositoryRequest->RequestGetRetardData();

        # TODO METTRE DES TRY CATCH ET REMONTER L ERREUR DANS LA VARIABLE POUR AFFICHER UN RETOUR ERREUR ET LOGS
        $repository = $doctrine->getRepository(RetardQos::class);
        foreach ($getData as $id => $key) {
            $checkDps = $repository->find($key->getDps());
            if ($checkDps) {
                $newData = $this->retardUpdateFunction($checkDps, $key, 1);
            } else {
                $newData = $this->retardUpdateFunction(new RetardQos(), $key, 2);
            }
            $em->persist($newData);
        }
        $em->flush();
        return true;
    }

    public function updateRetardTableByDps(array $dataRetard, ManagerRegistry $doctrine) : bool
    {

        /** Here we use @var = $dataRetard like an array because we get this data from front service   */

        $repository = $doctrine->getRepository(RetardQos::class);
        $em = $doctrine->getManager();
        foreach ($dataRetard as $id => $key) {
            $updateRetardData=$repository->find($key['dps']);
            /** si il retrouve pas le dps dans le repo */
            if (!$updateRetardData) {
                return false;
            } else {
                $updateRetardData->setCauseOrange($key['causeOrange']);
                $updateRetardData->setJoursOrange($key['joursOrange']);
                $updateRetardData->setCauseClient($key['causeClient']);
                $updateRetardData->setJoursClient($key['joursClient']);
                $updateRetardData->setPenalites($key['penalites']);
                $updateRetardData->setSla($key['sla']);
                $updateRetardData->setTotal($key['total']);
                $em->persist($updateRetardData);
                $em->flush();
            }
        }
        return true;
    }

    public function updateTepTableById(array $dataTep, ManagerRegistry $doctrine) : bool
    {

        /** Here we use @var = $dataTep like an array because we get this data from front service   */

        $repository = $doctrine->getRepository(TepQos::class);
        $em = $doctrine->getManager();
        $updateTepData=$repository->find($dataTep['id']);
        /** si il retrouve pas l'id dans le repo */
        if (!$updateTepData) {
            return false;
        } else {
            $updateTepData->setInterventions($dataTep["interventions"]);
            $updateTepData->setMes($dataTep["mes"]);
            $updateTepData->setEchecOrange($dataTep["echecOrange"]);
            $updateTepData->setEchecClient($dataTep["echecClient"]);
            $updateTepData->setTauxReussite($dataTep["tauxReussite"]);
            $updateTepData->setRmcClient($dataTep["rmcClient"]);
            $updateTepData->setTvcClient($dataTep["tvcClient"]);
            $updateTepData->setAnn($dataTep["ann"]);
            $updateTepData->setDfa($dataTep["dfa"]);
            $updateTepData->setReo($dataTep["reo"]);
            $updateTepData->setPbc($dataTep["pbc"]);
            $updateTepData->setEtu($dataTep["etu"]);
            $updateTepData->setRmf($dataTep["rmf"]);
            $updateTepData->setMat($dataTep["mat"]);
            $updateTepData->setDos($dataTep["dos"]);
            $em->persist($updateTepData);
            $em->flush();
        }
        return true;
    }

    public function createNewMonthlyTep(string $client, ManagerRegistry $doctrine, $date) : bool
    {
        $em = $doctrine->getManager();

        $insertNewTep = new TepQos();
        $insertNewTep->setDate($date);
        $insertNewTep->setClient($client);
        $insertNewTep->setInterventions(0);
        $insertNewTep->setMes(0);
        $insertNewTep->setEchecOrange(0);
        $insertNewTep->setEchecClient(0);
        $insertNewTep->setTauxReussite(0);
        $insertNewTep->setRmcClient(0);
        $insertNewTep->setTvcClient(0);
        $insertNewTep->setAnn(0);
        $insertNewTep->setDfa(0);
        $insertNewTep->setReo(0);
        $insertNewTep->setPbc(0);
        $insertNewTep->setEtu(0);
        $insertNewTep->setRmf(0);
        $insertNewTep->setMat(0);
        $insertNewTep->setDos(0);

        $em->persist($insertNewTep);
        $em->flush();
        return true;
    }

    public function importUpdateFunction(
        ImportDataQos  $data,
        array          $key,
        GlobalFunction $globalFunction,
        int            $opt
    ) : ImportDataQos {

        if ($opt == 2) {
            $data->setDps($key['DPS']);
        }
        if (array_key_exists('SU', $key)) {
            $data->setIdCedre($key['SU']);
        }
        if (array_key_exists('Date MES', $key)) {
            $data->setDateMesTech($globalFunction->convertDateExcel($key['Date MES'], true));
        }
        if (array_key_exists('Nom Site', $key)) {
            $data->setCodeSite($key['Nom Site']);
        }
        $data->setDateCmdClient($globalFunction->convertDateExcel($key['Date commande'], true));
        $data->setEtatDps($key['ETAT_DPS']);

        if (array_key_exists('DOMAINE', $key)) {
            $data->setDomaine($key['DOMAINE']);
        }
        $data->setClient($key['CLIENT']);
        if (array_key_exists('SERVICE', $key)) {
            $data->setService($key['SERVICE']);
        }
        if (array_key_exists('TECHNO', $key)) {
            $data->setTechno($key['TECHNO']);
        }
        $data->setType($key['TYPE']);
        $data->setDelaiSla($key['DELAI_SLA']);
        if (array_key_exists('DELAI_PROD', $key)) {
            $data->setDelaiProd($key['DELAI_PROD']);
        }
        if (array_key_exists('RETARD_SLA', $key)) {
            $data->setRetardSla($key['RETARD_SLA']);
        }
        $data->setZone($key['ZONE']);
        $data->setRetard($key['RETARD']);
        $data->setTypeSla($key['TYPE_SLA']);
        $data->setQosMensuel($key['QOS_MENSUEL_BY_SERVICE']);
        $data->setDateCmdLong($globalFunction->convertDateExcel($key['Date commande'], false));
        if (array_key_exists('Date MES', $key)) {
            $data->setDateMesLong($globalFunction->convertDateExcel($key['Date MES'], false));
        }

        return $data;
    }

    public function retardUpdateFunction(RetardQos $RetardData, ImportDataQos $key, int $opt) : RetardQos
    {
        $checkTotal = 0;
        $checkTotalRetard = 0;
        if ($opt == 2) {
            $RetardData->setDps($key->getDps());
        }
        if (array_key_exists('idCedre', (array)$key)) {
            $RetardData->setIdCedre($key->getIdCedre());
        }
        if (array_key_exists('dateMesTech', (array)$key)) {
            $RetardData->setDateMesTech($key->getDateMesTech());
        }
        if (array_key_exists('codeSite', (array)$key)) {
            $RetardData->setCodeSite($key->getCodeSite());
        }
        $RetardData->setEtatDps($key->getEtatDps());
        $RetardData->setTechno($key->getTechno());
        $RetardData->setDomaine($key->getDomaine());
        $RetardData->setClient($key->getClient());
        $RetardData->setDelaiSla($key->getDelaiSla());
        $RetardData->setDelaiProd($key->getDelaiProd());
        $RetardData->setRetardSla($key->getRetardSla());
        if ($opt == 1) {
            $checkTotal = $RetardData->getJoursClient()+$RetardData->getJoursOrange();
            $checkTotalRetard = $key->getRetardSla();
        }
        if ($opt == 2 or $checkTotal > $checkTotalRetard or $checkTotal < $checkTotalRetard) {
            $RetardData->setCauseOrange('');
            $RetardData->setJoursOrange(0);
            $RetardData->setCauseClient('');
            $RetardData->setJoursClient(0);
            $RetardData->setPenalites('');
            $RetardData->setSla('');
            $RetardData->setTotal($key->getRetardSla());
        }
        if (array_key_exists('dateMesLong', (array)$key)) {
            $RetardData->setDateMesLong($key->getDateMesLong());
        }
        if (array_key_exists('dateCmdLong', (array)$key)) {
            $RetardData->setDateCmdLong($key->getDateCmdLong());
        }


        return $RetardData;
    }

    public function addClient(String $clientsData, ManagerRegistry $doctrine) : bool
    {
        try{
            $em = $doctrine->getManager();
            $insertNewClient = new Clients();
            $insertNewClient->setName($clientsData);
            $em->persist($insertNewClient);
            $em->flush();
        }catch (\Exception $e){
            $loggerProcess->error('Call request "get_tep_powerBI" failure');
            return false;
        }


        return "ok";
    }

    public function deleteClient(String $clientsData, ManagerRegistry $doctrine) : bool
    {
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Clients::class);
        $deleteClient = $repository->findOneBy(['name' => $clientsData]);
        if (!$deleteClient) {
            return false;
        } else {
            $em->remove($deleteClient);
            $em->flush();
            return true;
        }
    }
}
