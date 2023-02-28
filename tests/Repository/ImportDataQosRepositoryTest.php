<?php

namespace App\Tests\Repository;

use App\Entity\MariaDB\ImportDataQos;
use App\Repository\ImportDataQosRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ImportDataQosRepositoryTest extends KernelTestCase
{
   /*
    private ImportDataQosRepository $importDataQosRepository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()->get('doctrine')->getManager();

        $this->importDataQosRepository = $entityManager->getRepository(ImportDataQos::class);
    }*/

/*    public function testRequestGetRetardData()
    {
        $result = $this->importDataQosRepository->requestGetRetardData();

        $this->assertIsArray($result);

        foreach ($result as $importDataQos) {
            $this->assertInstanceOf(ImportDataQos::class, $importDataQos);
            $this->assertEquals('OUI', $importDataQos->getRetard());
            $this->assertEquals('OUI', $importDataQos->getQosMensuel());
        }
    }*/

}
