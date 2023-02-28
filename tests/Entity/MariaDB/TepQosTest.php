<?php

namespace App\Tests\Entity\MariaDB;

use App\Entity\MariaDB\TepQos;
use PHPUnit\Framework\TestCase;

class TepQosTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $qos = new TepQos();

        $qos->setId(1);
        $this->assertEquals(1, $qos->getId());

        $qos->setDate('2022-01-01');
        $this->assertEquals('2022-01-01', $qos->getDate());

        $qos->setClient('ACME Corp');
        $this->assertEquals('ACME Corp', $qos->getClient());

        $qos->setInterventions(5);
        $this->assertEquals(5, $qos->getInterventions());

        $qos->setMes(3);
        $this->assertEquals(3, $qos->getMes());

        $qos->setEchecOrange(2);
        $this->assertEquals(2, $qos->getEchecOrange());

        $qos->setEchecClient(1);
        $this->assertEquals(1, $qos->getEchecClient());

        $qos->setTauxReussite(60);
        $this->assertEquals(60, $qos->getTauxReussite());

        $qos->setRmcClient(10);
        $this->assertEquals(10, $qos->getRmcClient());

        $qos->setTvcClient(20);
        $this->assertEquals(20, $qos->getTvcClient());

        $qos->setAnn(4);
        $this->assertEquals(4, $qos->getAnn());

        $qos->setDfa(1);
        $this->assertEquals(1, $qos->getDfa());

        $qos->setReo(6);
        $this->assertEquals(6, $qos->getReo());

        $qos->setPbc(1);
        $this->assertEquals(1, $qos->getPbc());

        $qos->setEtu(1);
        $this->assertEquals(1, $qos->getEtu());

        $qos->setRmf(2);
        $this->assertEquals(2, $qos->getRmf());

        $qos->setMat(3);
        $this->assertEquals(3, $qos->getMat());

        $qos->setDos(1);
        $this->assertEquals(1, $qos->getDos());
    }
}
