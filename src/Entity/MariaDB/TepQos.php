<?php

namespace App\Entity\MariaDB;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TepQosRepository;

/**
 * @ORM\Entity(repositoryClass=TepQosRepository::class)
 * @ORM\Table(name="tep_qos")
 */
class TepQos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */

    public int $id;

    /**
     * @ORM\Column(type="string")
     */

    public string $date;

    /**
     * @ORM\Column(type="string")
     */

    public string $client;

    /**
     * @ORM\Column(type="integer")
     */

    public int $interventions;

    /**
     * @ORM\Column(type="integer")
     */

    public int $mes;

    /**
     * @ORM\Column(type="integer")
     */

    public int $echecOrange;

    /**
     * @ORM\Column(type="integer")
     */

    public int $echecClient;

    /**
     * @ORM\Column(type="integer")
     */

    public int $tauxReussite;

    /**
     * @ORM\Column(type="integer")
     */

    public int $rmcClient;

    /**
     * @ORM\Column(type="integer")
     */

    public int $tvcClient;

    /**
     * @ORM\Column(type="integer")
     */

    public int $ann;

    /**
     * @ORM\Column(type="integer")
     */

    public int $dfa;

    /**
     * @ORM\Column(type="integer")
     */

    public int $reo;

    /**
     * @ORM\Column(type="integer")
     */

    public int $pbc;

    /**
     * @ORM\Column(type="integer")
     */

    public int $etu;

    /**
     * @ORM\Column(type="integer")
     */

    public int $rmf;

    /**
     * @ORM\Column(type="integer")
     */

    public int $mat;

    /**
     * @ORM\Column(type="integer")
     */

    public int $dos;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @param string $client
     */
    public function setClient(string $client): void
    {
        $this->client = $client;
    }

    /**
     * @return int
     */
    public function getInterventions(): int
    {
        return $this->interventions;
    }

    /**
     * @param int $interventions
     */
    public function setInterventions(int $interventions): void
    {
        $this->interventions = $interventions;
    }

    /**
     * @return int
     */
    public function getMes(): int
    {
        return $this->mes;
    }

    /**
     * @param int $mes
     */
    public function setMes(int $mes): void
    {
        $this->mes = $mes;
    }

    /**
     * @return int
     */
    public function getEchecOrange(): int
    {
        return $this->echecOrange;
    }

    /**
     * @param int $echecOrange
     */
    public function setEchecOrange(int $echecOrange): void
    {
        $this->echecOrange = $echecOrange;
    }

    /**
     * @return int
     */
    public function getEchecClient(): int
    {
        return $this->echecClient;
    }

    /**
     * @param int $echecClient
     */
    public function setEchecClient(int $echecClient): void
    {
        $this->echecClient = $echecClient;
    }

    /**
     * @return int
     */
    public function getTauxReussite(): int
    {
        return $this->tauxReussite;
    }

    /**
     * @param int $tauxReussite
     */
    public function setTauxReussite(int $tauxReussite): void
    {
        $this->tauxReussite = $tauxReussite;
    }

    /**
     * @return int
     */
    public function getRmcClient(): int
    {
        return $this->rmcClient;
    }

    /**
     * @param int $rmcClient
     */
    public function setRmcClient(int $rmcClient): void
    {
        $this->rmcClient = $rmcClient;
    }

    /**
     * @return int
     */
    public function getTvcClient(): int
    {
        return $this->tvcClient;
    }

    /**
     * @param int $tvcClient
     */
    public function setTvcClient(int $tvcClient): void
    {
        $this->tvcClient = $tvcClient;
    }

    /**
     * @return int
     */
    public function getAnn(): int
    {
        return $this->ann;
    }

    /**
     * @param int $ann
     */
    public function setAnn(int $ann): void
    {
        $this->ann = $ann;
    }

    /**
     * @return int
     */
    public function getDfa(): int
    {
        return $this->dfa;
    }

    /**
     * @param int $dfa
     */
    public function setDfa(int $dfa): void
    {
        $this->dfa = $dfa;
    }

    /**
     * @return int
     */
    public function getReo(): int
    {
        return $this->reo;
    }

    /**
     * @param int $reo
     */
    public function setReo(int $reo): void
    {
        $this->reo = $reo;
    }

    /**
     * @return int
     */
    public function getPbc(): int
    {
        return $this->pbc;
    }

    /**
     * @param int $pbc
     */
    public function setPbc(int $pbc): void
    {
        $this->pbc = $pbc;
    }

    /**
     * @return int
     */
    public function getEtu(): int
    {
        return $this->etu;
    }

    /**
     * @param int $etu
     */
    public function setEtu(int $etu): void
    {
        $this->etu = $etu;
    }

    /**
     * @return int
     */
    public function getRmf(): int
    {
        return $this->rmf;
    }

    /**
     * @param int $rmf
     */
    public function setRmf(int $rmf): void
    {
        $this->rmf = $rmf;
    }

    /**
     * @return int
     */
    public function getMat(): int
    {
        return $this->mat;
    }

    /**
     * @param int $mat
     */
    public function setMat(int $mat): void
    {
        $this->mat = $mat;
    }

    /**
     * @return int
     */
    public function getDos(): int
    {
        return $this->dos;
    }

    /**
     * @param int $dos
     */
    public function setDos(int $dos): void
    {
        $this->dos = $dos;
    }
}
