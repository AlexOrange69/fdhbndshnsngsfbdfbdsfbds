<?php

namespace App\Entity\MariaDB;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RetardQosRepository;

/**
 * @ORM\Entity(repositoryClass=RetardQosRepository::class)
 */
class RetardQos
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=255)
     */
    public string $dps;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $client;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $domaine;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $idCedre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $codeSite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $dateMesTech;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $etatDps;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $techno;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public int $delaiProd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $delaiSla;

    /**
     * @ORM\Column(type="integer")
     */
    public int $retardSla;

    /**
     * @ORM\Column(type="text", length=255)
     */
    public string $causeOrange;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    public int $joursOrange;

    /**
     * @ORM\Column(type="text", length=255)
     */
    public string $causeClient;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    public int $joursClient;

    /**
     * @ORM\Column(type="string")
     */
    public string $penalites;

    /**
     * @ORM\Column(type="string")
     */
    public string $sla;

    /**
     * @ORM\Column(type="integer")
     */
    public int $total;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $dateMesLong;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $dateCmdLong;

    /**
     * @return string
     */
    public function getDps(): string
    {
        return $this->dps;
    }

    /**
     * @param string $dps
     */
    public function setDps(string $dps): void
    {
        $this->dps = $dps;
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
     * @return string
     */
    public function getDomaine(): string
    {
        return $this->domaine;
    }

    /**
     * @param string $domaine
     */
    public function setDomaine(string $domaine): void
    {
        $this->domaine = $domaine;
    }

    /**
     * @return string
     */
    public function getIdCedre(): string
    {
        return $this->idCedre;
    }

    /**
     * @param string $idCedre
     */
    public function setIdCedre(string $idCedre): void
    {
        $this->idCedre = $idCedre;
    }

    /**
     * @return string
     */
    public function getCodeSite(): string
    {
        return $this->codeSite;
    }

    /**
     * @param string $codeSite
     */
    public function setCodeSite(string $codeSite): void
    {
        $this->codeSite = $codeSite;
    }

    /**
     * @return string
     */
    public function getDateMesTech(): string
    {
        return $this->dateMesTech;
    }

    /**
     * @param string $dateMesTech
     */
    public function setDateMesTech(string $dateMesTech): void
    {
        $this->dateMesTech = $dateMesTech;
    }

    /**
     * @return string
     */
    public function getEtatDps(): string
    {
        return $this->etatDps;
    }

    /**
     * @param string $etatDps
     */
    public function setEtatDps(string $etatDps): void
    {
        $this->etatDps = $etatDps;
    }

    /**
     * @return string
     */
    public function getTechno(): string
    {
        return $this->techno;
    }

    /**
     * @param string $techno
     */
    public function setTechno(string $techno): void
    {
        $this->techno = $techno;
    }

    /**
     * @return int
     */
    public function getDelaiProd(): int
    {
        return $this->delaiProd;
    }

    /**
     * @param int $delaiProd
     */
    public function setDelaiProd(int $delaiProd): void
    {
        $this->delaiProd = $delaiProd;
    }

    /**
     * @return string
     */
    public function getDelaiSla(): string
    {
        return $this->delaiSla;
    }

    /**
     * @param string $delaiSla
     */
    public function setDelaiSla(string $delaiSla): void
    {
        $this->delaiSla = $delaiSla;
    }

    /**
     * @return int
     */
    public function getRetardSla(): int
    {
        return $this->retardSla;
    }

    /**
     * @param int $retardSla
     */
    public function setRetardSla(int $retardSla): void
    {
        $this->retardSla = $retardSla;
    }


    /**
     * @return string
     */
    public function getCauseOrange(): string
    {
        return $this->causeOrange;
    }

    /**
     * @param string $causeOrange
     */
    public function setCauseOrange(string $causeOrange): void
    {
        $this->causeOrange = $causeOrange;
    }

    /**
     * @return int
     */
    public function getJoursOrange(): int
    {
        return $this->joursOrange;
    }

    /**
     * @param int $joursOrange
     */
    public function setJoursOrange(int $joursOrange): void
    {
        $this->joursOrange = $joursOrange;
    }

    /**
     * @return string
     */
    public function getCauseClient(): string
    {
        return $this->causeClient;
    }

    /**
     * @param string $causeClient
     */
    public function setCauseClient(string $causeClient): void
    {
        $this->causeClient = $causeClient;
    }

    /**
     * @return int
     */
    public function getJoursClient(): int
    {
        return $this->joursClient;
    }

    /**
     * @param int $joursClient
     */
    public function setJoursClient(int $joursClient): void
    {
        $this->joursClient = $joursClient;
    }

    /**
     * @return string
     */
    public function getPenalites(): string
    {
        return $this->penalites;
    }

    /**
     * @param string $penalites
     */
    public function setPenalites(string $penalites): void
    {
        $this->penalites = $penalites;
    }

    /**
     * @return string
     */
    public function getSla(): string
    {
        return $this->sla;
    }

    /**
     * @param string $sla
     */
    public function setSla(string $sla): void
    {
        $this->sla = $sla;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getDateMesLong(): string
    {
        return $this->dateMesLong;
    }

    /**
     * @param string $dateMesLong
     */
    public function setDateMesLong(string $dateMesLong): void
    {
        $this->dateMesLong = $dateMesLong;
    }

    /**
     * @return string
     */
    public function getDateCmdLong(): string
    {
        return $this->dateCmdLong;
    }

    /**
     * @param string $dateCmdLong
     */
    public function setDateCmdLong(string $dateCmdLong): void
    {
        $this->dateCmdLong = $dateCmdLong;
    }

}
