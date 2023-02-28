<?php

namespace App\Tests\Entity\MariaDB;

use App\Entity\MariaDB\ImportDataQos;
use PHPUnit\Framework\TestCase;

class ImportDataQosTest extends TestCase
{

    public function testGettersAndSetters()
    {
        $importDataQos = new ImportDataQos();
        $importDataQos->setDps('12345');
        $importDataQos->setIdCedre('54321');
        $importDataQos->setDateMesTech('2022-01-01');
        $importDataQos->setCodeSite('ABC');
        $importDataQos->setDateCmdClient('2022-01-02');
        $importDataQos->setEtatDps('open');
        $importDataQos->setDomaine('domain');
        $importDataQos->setClient('client');
        $importDataQos->setService('service');
        $importDataQos->setTechno('techno');
        $importDataQos->setType('type');
        $importDataQos->setDelaiSla('delaiSla');
        $importDataQos->setDelaiProd(10);
        $importDataQos->setRetardSla(5);
        $importDataQos->setZone('zone');
        $importDataQos->setRetard('retard');
        $importDataQos->setTypeSla('typeSla');
        $importDataQos->setQosMensuel('qosMensuel');
        $importDataQos->setDateMesLong('2022-02-01');
        $importDataQos->setDateCmdLong('2022-02-02');

        $this->assertEquals('12345', $importDataQos->getDps());
        $this->assertEquals('54321', $importDataQos->getIdCedre());
        $this->assertEquals('2022-01-01', $importDataQos->getDateMesTech());
        $this->assertEquals('ABC', $importDataQos->getCodeSite());
        $this->assertEquals('2022-01-02', $importDataQos->getDateCmdClient());
        $this->assertEquals('open', $importDataQos->getEtatDps());
        $this->assertEquals('domain', $importDataQos->getDomaine());
        $this->assertEquals('client', $importDataQos->getClient());
        $this->assertEquals('service', $importDataQos->getService());
        $this->assertEquals('techno', $importDataQos->getTechno());
        $this->assertEquals('type', $importDataQos->getType());
        $this->assertEquals('delaiSla', $importDataQos->getDelaiSla());
        $this->assertEquals(10, $importDataQos->getDelaiProd());
        $this->assertEquals(5, $importDataQos->getRetardSla());
        $this->assertEquals('zone', $importDataQos->getZone());
        $this->assertEquals('retard', $importDataQos->getRetard());
        $this->assertEquals('typeSla', $importDataQos->getTypeSla());
        $this->assertEquals('qosMensuel', $importDataQos->getQosMensuel());
        $this->assertEquals('2022-02-01', $importDataQos->getDateMesLong());
        $this->assertEquals('2022-02-02', $importDataQos->getDateCmdLong());
    }
}
