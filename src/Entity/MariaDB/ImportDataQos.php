<?php

namespace App\Entity\MariaDB;

use App\Repository\ImportDataQosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImportDataQosRepository::class)
 */
class ImportDataQos
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=255)
     */
    public string $dps;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $idCedre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $dateMesTech;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $codeSite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $dateCmdClient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $etatDps;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $domaine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $client;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $service;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $techno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $delaiSla;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public int $delaiProd;

    /**
     * @ORM\Column(type="integer")
     */
    public int $retardSla;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $zone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $retard;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $typeSla;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $qosMensuel;

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
    public function getDateCmdClient(): string
    {
        return $this->dateCmdClient;
    }

    /**
     * @param string $dateCmdClient
     */
    public function setDateCmdClient(string $dateCmdClient): void
    {
        $this->dateCmdClient = $dateCmdClient;
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
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @param string $service
     */
    public function setService(string $service): void
    {
        $this->service = $service;
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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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
    public function getZone(): string
    {
        return $this->zone;
    }

    /**
     * @param string $zone
     */
    public function setZone(string $zone): void
    {
        $this->zone = $zone;
    }

    /**
     * @return string
     */
    public function getRetard(): string
    {
        return $this->retard;
    }

    /**
     * @param string $retard
     */
    public function setRetard(string $retard): void
    {
        $this->retard = $retard;
    }

    /**
     * @return string
     */
    public function getTypeSla(): string
    {
        return $this->typeSla;
    }

    /**
     * @param string $typeSla
     */
    public function setTypeSla(string $typeSla): void
    {
        $this->typeSla = $typeSla;
    }

    /**
     * @return string
     */
    public function getQosMensuel(): string
    {
        return $this->qosMensuel;
    }

    /**
     * @param string $qosMensuel
     */
    public function setQosMensuel(string $qosMensuel): void
    {
        $this->qosMensuel = $qosMensuel;
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
