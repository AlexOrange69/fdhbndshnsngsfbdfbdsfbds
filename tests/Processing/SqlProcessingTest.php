<?php

namespace App\Tests\Processing;

use App\Entity\MariaDB\Clients;
use App\Entity\MariaDB\ImportDataQos;
use App\Entity\MariaDB\RetardQos;
use App\Entity\MariaDB\TepQos;
use App\Processing\GlobalFunction;
use App\Processing\SqlProcessing;
use App\Repository\RetardQosRepository;
use App\Repository\TepQosRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;

class SqlProcessingTest extends TestCase
{
    public function testAddClient()
    {
        $clientsData = 'John Doe';

        // Créer un objet ClientManager et mock ManagerRegistry
        $clientManager = new SqlProcessing();
        $doctrine = $this->createMock(ManagerRegistry::class);

        // Configurer le mock pour renvoyer un EntityManager
        $em = $this->createMock(EntityManagerInterface::class);
        $doctrine->method('getManager')->willReturn($em);

        // Configurer le mock pour vérifier que persist et flush sont appelés avec l'objet Clients correct
        $em->expects($this->once())->method('persist')->with($this->isInstanceOf(Clients::class));
        $em->expects($this->once())->method('flush');

        // Appeler la méthode addClient et vérifier si elle retourne "ok"
        $result = $clientManager->addClient($clientsData, $doctrine);
        $this->assertEquals(true, $result);
    }

    public function testRetardUpdateFunction()
    {
        // Données de test
        $importData = new ImportDataQos();
        $importData->setDps('12345');
        $importData->setIdCedre('ABCDE');
        $importData->setDateMesTech('2022-02-14');
        $importData->setCodeSite('SITE-001');
        $importData->setEtatDps('en cours');
        $importData->setTechno('ADSL');
        $importData->setDomaine('informatique');
        $importData->setClient('Client A');
        $importData->setDelaiSla(10);
        $importData->setDelaiProd(12);
        $importData->setRetardSla(5);
        $importData->setDateMesLong('2022-02-01');
        $importData->setDateCmdLong('2022-01-28');

        $retardData = new RetardQos();
        $retardData->setJoursClient(3);
        $retardData->setJoursOrange(2);
        $retardData->setTotal(5);

        $opt = 2;
        $processing = new SqlProcessing();

        // Exécuter la fonction à tester
        $updatedRetardData = $processing->retardUpdateFunction($retardData, $importData, $opt);

        // Vérifier les résultats
        $this->assertEquals($updatedRetardData->getDps(), $importData->getDps());
        $this->assertEquals($updatedRetardData->getIdCedre(), $importData->getIdCedre());
        $this->assertEquals($updatedRetardData->getDateMesTech(), $importData->getDateMesTech());
        $this->assertEquals($updatedRetardData->getCodeSite(), $importData->getCodeSite());
        $this->assertEquals($updatedRetardData->getEtatDps(), $importData->getEtatDps());
        $this->assertEquals($updatedRetardData->getTechno(), $importData->getTechno());
        $this->assertEquals($updatedRetardData->getDomaine(), $importData->getDomaine());
        $this->assertEquals($updatedRetardData->getClient(), $importData->getClient());
        $this->assertEquals($updatedRetardData->getDelaiSla(), $importData->getDelaiSla());
        $this->assertEquals($updatedRetardData->getDelaiProd(), $importData->getDelaiProd());
        $this->assertEquals($updatedRetardData->getRetardSla(), $importData->getRetardSla());
        $this->assertEquals($updatedRetardData->getDateMesLong(), $importData->getDateMesLong());
        $this->assertEquals($updatedRetardData->getDateCmdLong(), $importData->getDateCmdLong());

        $this->assertEquals($updatedRetardData->getCauseOrange(), '');
        $this->assertEquals($updatedRetardData->getJoursOrange(), 0);
        $this->assertEquals($updatedRetardData->getCauseClient(), '');
        $this->assertEquals($updatedRetardData->getJoursClient(), 0);
        $this->assertEquals($updatedRetardData->getPenalites(), '');
        $this->assertEquals($updatedRetardData->getSla(), '');
        $this->assertEquals($updatedRetardData->getTotal(), $importData->getRetardSla());
    }

    public function testDeleteExistingClient()
    {
        // Création des dépendances nécessaires pour la fonction
        $doctrine = $this->createMock(ManagerRegistry::class);
        $em = $this->createMock(EntityManagerInterface::class);
        $repository = $this->createMock(ObjectRepository::class);
        $deleteClient = $this->createMock(Clients::class);

        // Configurer les mocks pour les retours de fonctions spécifiques
        $repository->expects($this->once())
            ->method('findOneBy')
            ->with(['name' => 'client1'])
            ->willReturn($deleteClient);

        $doctrine->expects($this->once())
            ->method('getManager')
            ->willReturn($em);

        $doctrine->expects($this->once())
            ->method('getRepository')
            ->with(Clients::class)
            ->willReturn($repository);

        $em->expects($this->once())
            ->method('remove')
            ->with($deleteClient);

        $em->expects($this->once())
            ->method('flush');

        // Appeler la fonction à tester
        $myClass = new SqlProcessing();
        $result = $myClass->deleteClient('client1', $doctrine);

        // Vérifier le résultat
        $this->assertTrue($result);
    }

    public function testDeleteNonExistingClient()
    {
        // Création des dépendances nécessaires pour la fonction
        $doctrine = $this->createMock(ManagerRegistry::class);
        $repository = $this->createMock(ObjectRepository::class);

        // Configurer les mocks pour les retours de fonctions spécifiques
        $repository->expects($this->once())
            ->method('findOneBy')
            ->with(['name' => 'client1'])
            ->willReturn(null);

        $doctrine->expects($this->once())
            ->method('getRepository')
            ->with(Clients::class)
            ->willReturn($repository);

        // Appeler la fonction à tester
        $myClass = new SqlProcessing();
        $result = $myClass->deleteClient('client1', $doctrine);

        // Vérifier le résultat
        $this->assertFalse($result);
    }

    public function testImportUpdateFunction(): void
    {
        $data = new ImportDataQos();
        $key = [
            'DPS' => '123',
            'SU' => '456',
            'Date MES' => '44972',
            'Nom Site' => 'Site 1',
            'Date commande' => '44958',
            'ETAT_DPS' => 'Open',
            'DOMAINE' => 'Domaine 1',
            'CLIENT' => 'Client 1',
            'SERVICE' => 'Service 1',
            'TECHNO' => 'Techno 1',
            'TYPE' => 'Type 1',
            'DELAI_SLA' => 2,
            'DELAI_PROD' => 4,
            'RETARD_SLA' => 1,
            'ZONE' => 'Zone 1',
            'RETARD' => 2,
            'TYPE_SLA' => 'Type SLA 1',
            'QOS_MENSUEL_BY_SERVICE' => '90%',
        ];
        $globalFunction = new GlobalFunction();
        $slqProcessing = new SqlProcessing();
        $opt = 2;

        $importDataQos = $slqProcessing->importUpdateFunction($data, $key, $globalFunction, $opt);

        $this->assertEquals('123', $importDataQos->getDps());
        $this->assertEquals('456', $importDataQos->getIdCedre());
        $this->assertEquals('02/2023', $importDataQos->getDateMesTech());
        $this->assertEquals('Site 1', $importDataQos->getCodeSite());
        $this->assertEquals('02/2023', $importDataQos->getDateCmdClient());
        $this->assertEquals('Open', $importDataQos->getEtatDps());
        $this->assertEquals('Domaine 1', $importDataQos->getDomaine());
        $this->assertEquals('Client 1', $importDataQos->getClient());
        $this->assertEquals('Service 1', $importDataQos->getService());
        $this->assertEquals('Techno 1', $importDataQos->getTechno());
        $this->assertEquals('Type 1', $importDataQos->getType());
        $this->assertEquals('2', $importDataQos->getDelaiSla());
        $this->assertEquals('4', $importDataQos->getDelaiProd());
        $this->assertEquals('1', $importDataQos->getRetardSla());
        $this->assertEquals('Zone 1', $importDataQos->getZone());
        $this->assertEquals('2', $importDataQos->getRetard());
        $this->assertEquals('Type SLA 1', $importDataQos->getTypeSla());
        $this->assertEquals('90%', $importDataQos->getQosMensuel());
        $this->assertEquals('01/02/2023', $importDataQos->getDateCmdLong());
        $this->assertEquals('15/02/2023', $importDataQos->getDateMesLong());
    }

    public function testCreateNewMonthlyTep()
    {
        $client = 'Client1';
        $doctrine = $this->createMock(ManagerRegistry::class);
        $entityManager = $this->createMock(EntityManager::class);

        $doctrine->expects($this->once())
            ->method('getManager')
            ->willReturn($entityManager);

        $entityManager->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(TepQos::class));

        $entityManager->expects($this->once())
            ->method('flush');

        $tepQos = new TepQos();
        $tepQos->setClient($client);
        $tepQos->setDate('10/03/2022');


        $tepQosService = new SqlProcessing();
        $result = $tepQosService->createNewMonthlyTep($client, $doctrine, '10/03/2022');

        $this->assertTrue($result);
    }

    public function testUpdateTepTableById()
    {
        // DataSet
        $dataTep = [
            'id' => 1,
            'interventions' => '5',
            'mes' => '4',
            'echecOrange' => '1',
            'echecClient' => '0',
            'tauxReussite' => '80',
            'rmcClient' => '0',
            'tvcClient' => '0',
            'ann' => '0',
            'dfa' => '0',
            'reo' => '0',
            'pbc' => '0',
            'etu' => '0',
            'rmf' => '0',
            'mat' => '0',
            'dos' => '0'
        ];

        // Create mock for ManagerRegistry
        $doctrine = $this->getMockBuilder(ManagerRegistry::class)
            ->getMock();

        // Create mock for repository TepQos
        $repository = $this->getMockBuilder(TepQosRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Config mockfor send object TepQos with id 1
        $repository->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn(new TepQos());

        // Config mock of ManagerRegistry for send mock of repository
        $doctrine->expects($this->once())
            ->method('getRepository')
            ->with(TepQos::class)
            ->willReturn($repository);

        // Create mock for EntityManager
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Config mock of ManagerRegistry for send mock of EntityManager
        $doctrine->expects($this->once())
            ->method('getManager')
            ->willReturn($em);

        // Config mock of EntityManager for call persist() and flush()
        $em->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(TepQos::class));
        $em->expects($this->once())
            ->method('flush');

        // Call function for testing
        $tepQos = new SqlProcessing();
        $result = $tepQos->updateTepTableById($dataTep, $doctrine);

        // Check result (true)
        $this->assertTrue($result);
    }

    public function testUpdateRetardTableWithReturnsTrue()
    {

        // data set

        $dataRetard = array(
            1 => array(
                'dps' => 1,
                'causeOrange' => 'Problème technique',
                'joursOrange' => 3,
                'causeClient' => 'Indisponibilité du personnel',
                'joursClient' => 5,
                'penalites' => "OUI",
                'sla' => 60,
                'total' => 8
            )
        );

        // Create mock for ManagerRegistry
        $doctrine = $this->getMockBuilder(ManagerRegistry::class)
            ->getMock();

        // Create mock for RetardQos repository
        $repository = $this->getMockBuilder(RetardQosRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Config mock for send object Retard with id 1
        $repository->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn(new RetardQos());

        // Config mock of ManagerRegistry for send mock de repository
        $doctrine->expects($this->once())
            ->method('getRepository')
            ->with(RetardQos::class)
            ->willReturn($repository);

        // Create mock for EntityManager
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Config mock of ManagerRegistry for send mock of EntityManager
        $doctrine->expects($this->once())
            ->method('getManager')
            ->willReturn($em);

        // Config mock of EntityManager for call persist() and flush()
        $em->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(RetardQos::class));
        $em->expects($this->once())
            ->method('flush');

        // call function for testing
        $sqlProcessing = new SqlProcessing();
        $result = $sqlProcessing->updateRetardTableByDps($dataRetard, $doctrine);

        // Check result (true)
        $this->assertTrue($result);
    }

    public function testUpdateRetardTableWithReturnsFalse()
    {
        $dataRetard = array(
            1 => array(
                'dps' => 1,
                'causeOrange' => 'Problème technique',
                'joursOrange' => 3,
                'causeClient' => 'Indisponibilité du personnel',
                'joursClient' => 5,
                'penalites' => "OUI",
                'sla' => 60,
                'total' => 8
            )
        );

        // Create mock for ManagerRegistry
        $doctrine = $this->getMockBuilder(ManagerRegistry::class)
            ->getMock();

        // Create mock for RetardQos repository
        $repository = $this->getMockBuilder(RetardQosRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Config mock for return null
        $repository->expects($this->once())
            ->method('find')
            ->willReturn(null);

        // Config mock of ManagerRegistry for send mock repository
        $doctrine->expects($this->once())
            ->method('getRepository')
            ->with(RetardQos::class)
            ->willReturn($repository);

        // Create mock for EntityManager
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Config mock of ManagerRegistry for send mock of EntityManager
        $doctrine->expects($this->once())
            ->method('getManager')
            ->willReturn($em);


        // call function for testing
        $sqlProcessing = new SqlProcessing();
        $result = $sqlProcessing->updateRetardTableByDps($dataRetard, $doctrine);

        // Check result (true)
        $this->assertFalse($result);
    }


}
