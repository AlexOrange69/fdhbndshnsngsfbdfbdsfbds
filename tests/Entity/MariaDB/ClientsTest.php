<?php

namespace App\Tests\Entity\MariaDB;

use App\Entity\MariaDB\Clients;
use PHPUnit\Framework\TestCase;

class ClientsTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $client = new Clients();

        $client->setId(1);
        $this->assertEquals(1, $client->getId());

        $client->setName('John Doe');
        $this->assertEquals('John Doe', $client->getName());
    }

}
