<?php

namespace App\Tests\Controller;

use App\Controller\QosController;
use App\Processing\GlobalFunction;
use App\Processing\SqlProcessing;
use App\Repository\ClientsQosRepository;
use App\Repository\ImportDataQosRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class QosControllerTest extends WebTestCase
{
/*
    private HttpClientInterface $client;

    public function setUp(): void
    {
        $this->client = HttpClient::create();
    }

    public function testUpdateMonthlyDataResponseCode(): void
    {
        $client = static::createClient();
        $managerRegistry = $client->getContainer()->get(ManagerRegistry::class);
        $importDataQosRepository = $client->getContainer()->get(ImportDataQosRepository::class);
        $sqlProcessing = $client->getContainer()->get(SqlProcessing::class);
        $globalFunction = $client->getContainer()->get(GlobalFunction::class);

        // Test with empty data
        $client->request('POST', '/uploadQosData', [], [], [], '');
        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);

        // Test with data that can't be inserted
        $client->request('POST', '/uploadQosData', [], [], [], json_encode([['invalid data']]));
        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);

        // Test with valid data
        $client->request('POST', '/uploadQosData', [], [], [], json_encode([['valid data']]));
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }*/

/*    public function testGetRetardByClient()
    {
        $client = static::createClient();
        $client->request('GET', '/GetRetardFor/client/2023-02-17');
        $response = $client->getResponse();
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }*/
}
