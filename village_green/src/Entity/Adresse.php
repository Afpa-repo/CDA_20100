<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse", indexes={@ORM\Index(name="IDX_C35F0816C7440455", columns={"client"})})
 * @ORM\Entity
 */
class Adresse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_num_rue", type="string", length=255, nullable=false)
     */
    private $adrNumRue;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_ville", type="string", length=255, nullable=false)
     */
    private $adrVille;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_pays", type="string", length=255, nullable=false)
     */
    private $adrPays;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_cp", type="string", length=255, nullable=false)
     */
    private $adrCp;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="cli_id")
     * })
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdrNumRue(): ?string
    {
        return $this->adrNumRue;
    }

    public function setAdrNumRue(string $adrNumRue): self
    {
        $this->adrNumRue = $adrNumRue;

        return $this;
    }

    public function getAdrVille(): ?string
    {
        return $this->adrVille;
    }

    public function setAdrVille(string $adrVille): self
    {
        $this->adrVille = $adrVille;

        return $this;
    }

    public function getAdrPays(): ?string
    {
        return $this->adrPays;
    }

    public function setAdrPays(string $adrPays): self
    {
        $this->adrPays = $adrPays;

        return $this;
    }

    public function getAdrCp(): ?string
    {
        return $this->adrCp;
    }

    public function setAdrCp(string $adrCp): self
    {
        $this->adrCp = $adrCp;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }


}
