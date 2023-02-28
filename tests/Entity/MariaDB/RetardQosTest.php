<?php

namespace App\Tests\Entity\MariaDB;

use App\Entity\MariaDB\ImportDataQos;
use App\Entity\MariaDB\RetardQos;
use PHPUnit\Framework\TestCase;

class RetardQosTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $retardQos = new RetardQos();
        $retardQos->setDps('12345');
        $retardQos->setIdCedre('54321');
        $retardQos->setDateMesTech('2022-01-01');
        $retardQos->setCodeSite('ABC');
        $retardQos->setEtatDps('open');
        $retardQos->setDomaine('domain');
        $retardQos->setClient('client');
        $retardQos->setTechno('techno');
        $retardQos->setDelaiSla('delaiSla');
        $retardQos->setDelaiProd(10);
        $retardQos->setRetardSla(5);
        $retardQos->setDateMesLong('2022-02-01');
        $retardQos->setDateCmdLong('2022-02-02');
        $retardQos->setTotal(80);
        $retardQos->setSla(60);
        $retardQos->setPenalites("OUI");
        $retardQos->setJoursClient(20);
        $retardQos->setCauseClient("TRAVAUX");
        $retardQos->setCauseOrange('POI');
        $retardQos->setJoursOrange(40);

        $this->assertEquals('12345', $retardQos->getDps());
        $this->assertEquals('54321', $retardQos->getIdCedre());
        $this->assertEquals('2022-01-01', $retardQos->getDateMesTech());
        $this->assertEquals('ABC', $retardQos->getCodeSite());
        $this->assertEquals('open', $retardQos->getEtatDps());
        $this->assertEquals('domain', $retardQos->getDomaine());
        $this->assertEquals('client', $retardQos->getClient());
        $this->assertEquals('techno', $retardQos->getTechno());
        $this->assertEquals('delaiSla', $retardQos->getDelaiSla());
        $this->assertEquals(10, $retardQos->getDelaiProd());
        $this->assertEquals(5, $retardQos->getRetardSla());
        $this->assertEquals('2022-02-01', $retardQos->getDateMesLong());
        $this->assertEquals('2022-02-02', $retardQos->getDateCmdLong());
        $this->assertEquals(80, $retardQos->getTotal());
        $this->assertEquals(60, $retardQos->getSla());
        $this->assertEquals("OUI", $retardQos->getPenalites());
        $this->assertEquals(20, $retardQos->getJoursClient());
        $this->assertEquals("TRAVAUX", $retardQos->getCauseClient());
        $this->assertEquals(40, $retardQos->getJoursOrange());
        $this->assertEquals("POI", $retardQos->getCauseOrange());
    }
}
