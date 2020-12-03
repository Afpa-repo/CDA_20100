<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="cmd_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cmdId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cmd_date", type="date", nullable=true)
     */
    private $cmdDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmd_reduc", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $cmdReduc;

    /**
     * @var int
     *
     * @ORM\Column(name="cmd_fact_id", type="integer", nullable=false)
     */
    private $cmdFactId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cmd_fact_date", type="date", nullable=true)
     */
    private $cmdFactDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmd_cli_adresse_fact", type="string", length=50, nullable=true)
     */
    private $cmdCliAdresseFact;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmd_cli_cp_fact", type="string", length=5, nullable=true, options={"fixed"=true})
     */
    private $cmdCliCpFact;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmd_cli_ville_fact", type="string", length=50, nullable=true)
     */
    private $cmdCliVilleFact;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmd_cli_adresse_liv", type="string", length=50, nullable=true)
     */
    private $cmdCliAdresseLiv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmd_cli_cp_liv", type="string", length=5, nullable=true, options={"fixed"=true})
     */
    private $cmdCliCpLiv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmd_cli_ville_liv", type="string", length=50, nullable=true)
     */
    private $cmdCliVilleLiv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmd_cli_coeff", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $cmdCliCoeff;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Client", inversedBy="passeCmd")
     * @ORM\JoinTable(name="passe",
     *   joinColumns={
     *     @ORM\JoinColumn(name="passe_cmd_id", referencedColumnName="cmd_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="passe_cli_id", referencedColumnName="cli_id")
     *   }
     * )
     */
    private $passeCli;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="seComposeDeCmd")
     */
    private $seComposeDePro;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->passeCli = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seComposeDePro = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getCmdId(): ?int
    {
        return $this->cmdId;
    }

    public function getCmdDate(): ?\DateTimeInterface
    {
        return $this->cmdDate;
    }

    public function setCmdDate(?\DateTimeInterface $cmdDate): self
    {
        $this->cmdDate = $cmdDate;

        return $this;
    }
    public function __toString()
    {
        return $this->getCmdCliAdresseLiv().'[br]'.$this->getCmdCliCpLiv().', '.$this->getCmdCliVilleLiv();
    }

    public function getCmdReduc(): ?string
    {
        return $this->cmdReduc;
    }

    public function setCmdReduc(?string $cmdReduc): self
    {
        $this->cmdReduc = $cmdReduc;

        return $this;
    }

    public function getCmdFactId(): ?int
    {
        return $this->cmdFactId;
    }

    public function setCmdFactId(int $cmdFactId): self
    {
        $this->cmdFactId = $cmdFactId;

        return $this;
    }

    public function getCmdFactDate(): ?\DateTimeInterface
    {
        return $this->cmdFactDate;
    }

    public function setCmdFactDate(?\DateTimeInterface $cmdFactDate): self
    {
        $this->cmdFactDate = $cmdFactDate;

        return $this;
    }

    public function getCmdCliAdresseFact(): ?string
    {
        return $this->cmdCliAdresseFact;
    }

    public function setCmdCliAdresseFact(?string $cmdCliAdresseFact): self
    {
        $this->cmdCliAdresseFact = $cmdCliAdresseFact;

        return $this;
    }

    public function getCmdCliCpFact(): ?string
    {
        return $this->cmdCliCpFact;
    }

    public function setCmdCliCpFact(?string $cmdCliCpFact): self
    {
        $this->cmdCliCpFact = $cmdCliCpFact;

        return $this;
    }

    public function getCmdCliVilleFact(): ?string
    {
        return $this->cmdCliVilleFact;
    }

    public function setCmdCliVilleFact(?string $cmdCliVilleFact): self
    {
        $this->cmdCliVilleFact = $cmdCliVilleFact;

        return $this;
    }

    public function getCmdCliAdresseLiv(): ?string
    {
        return $this->cmdCliAdresseLiv;
    }

    public function setCmdCliAdresseLiv(?string $cmdCliAdresseLiv): self
    {
        $this->cmdCliAdresseLiv = $cmdCliAdresseLiv;

        return $this;
    }

    public function getCmdCliCpLiv(): ?string
    {
        return $this->cmdCliCpLiv;
    }

    public function setCmdCliCpLiv(?string $cmdCliCpLiv): self
    {
        $this->cmdCliCpLiv = $cmdCliCpLiv;

        return $this;
    }

    public function getCmdCliVilleLiv(): ?string
    {
        return $this->cmdCliVilleLiv;
    }

    public function setCmdCliVilleLiv(?string $cmdCliVilleLiv): self
    {
        $this->cmdCliVilleLiv = $cmdCliVilleLiv;

        return $this;
    }

    public function getCmdCliCoeff(): ?string
    {
        return $this->cmdCliCoeff;
    }

    public function setCmdCliCoeff(?string $cmdCliCoeff): self
    {
        $this->cmdCliCoeff = $cmdCliCoeff;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getPasseCli(): Collection
    {
        return $this->passeCli;
    }

    public function addPasseCli(Client $passeCli): self
    {
        if (!$this->passeCli->contains($passeCli)) {
            $this->passeCli[] = $passeCli;
        }

        return $this;
    }

    public function removePasseCli(Client $passeCli): self
    {
        $this->passeCli->removeElement($passeCli);

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getSeComposeDePro(): Collection
    {
        return $this->seComposeDePro;
    }

    public function addSeComposeDePro(Produit $seComposeDePro): self
    {
        if (!$this->seComposeDePro->contains($seComposeDePro)) {
            $this->seComposeDePro[] = $seComposeDePro;
            $seComposeDePro->addSeComposeDeCmd($this);
        }

        return $this;
    }

    public function removeSeComposeDePro(Produit $seComposeDePro): self
    {
        if ($this->seComposeDePro->removeElement($seComposeDePro)) {
            $seComposeDePro->removeSeComposeDeCmd($this);
        }

        return $this;
    }

}
