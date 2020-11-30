<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Client
 *
 * @ORM\Table(name="client", indexes={@ORM\Index(name="cli_com_id", columns={"cli_com_id"})})
 * @ORM\Entity
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="cli_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cliId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cli_nom", type="string", length=50, nullable=true)
     */
    private $cliNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cli_prenom", type="string", length=50, nullable=true)
     */
    private $cliPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="cli_email", type="string", length=250, nullable=false)
     */
    private $cliEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="cli_password", type="string", length=250, nullable=false)
     */
    private $cliPassword;

    /**
     * @Assert\EqualTo(propertyPath="cli_password", message="Vos mots de passe sont différents")
     */
    public $cliConfPassword;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cli_adresse", type="string", length=250, nullable=true)
     */
    private $cliAdresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cli_cp", type="string", length=5, nullable=true, options={"fixed"=true})
     */
    private $cliCp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cli_ville", type="string", length=50, nullable=true)
     */
    private $cliVille;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cli_regl", type="string", length=50, nullable=true)
     */
    private $cliRegl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cli_categ", type="string", length=50, nullable=true)
     */
    private $cliCateg;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cli_coeff", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $cliCoeff;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cli_com_id", referencedColumnName="com_id")
     * })
     */
    private $cliCom;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Commande", mappedBy="passeCli")
     */
    private $passeCmd;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->passeCmd = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getCliId(): ?int
    {
        return $this->cliId;
    }

    public function getCliNom(): ?string
    {
        return $this->cliNom;
    }

    public function setCliNom(?string $cliNom): self
    {
        $this->cliNom = $cliNom;

        return $this;
    }

    public function getCliPrenom(): ?string
    {
        return $this->cliPrenom;
    }

    public function setCliPrenom(?string $cliPrenom): self
    {
        $this->cliPrenom = $cliPrenom;

        return $this;
    }

    public function getCliEmail(): ?string
    {
        return $this->cliEmail;
    }

    public function setCliEmail(string $cliEmail): self
    {
        $this->cliEmail = $cliEmail;

        return $this;
    }

    public function getCliPassword(): ?string
    {
        return $this->cliPassword;
    }

    public function setCliPassword(string $cliPassword): self
    {
        $this->cliPassword = $cliPassword;

        return $this;
    }

    public function getCliAdresse(): ?string
    {
        return $this->cliAdresse;
    }

    public function setCliAdresse(?string $cliAdresse): self
    {
        $this->cliAdresse = $cliAdresse;

        return $this;
    }

    public function getCliCp(): ?string
    {
        return $this->cliCp;
    }

    public function setCliCp(?string $cliCp): self
    {
        $this->cliCp = $cliCp;

        return $this;
    }

    public function getCliVille(): ?string
    {
        return $this->cliVille;
    }

    public function setCliVille(?string $cliVille): self
    {
        $this->cliVille = $cliVille;

        return $this;
    }

    public function getCliRegl(): ?string
    {
        return $this->cliRegl;
    }

    public function setCliRegl(?string $cliRegl): self
    {
        $this->cliRegl = $cliRegl;

        return $this;
    }

    public function getCliCateg(): ?string
    {
        return $this->cliCateg;
    }

    public function setCliCateg(?string $cliCateg): self
    {
        $this->cliCateg = $cliCateg;

        return $this;
    }

    public function getCliCoeff(): ?string
    {
        return $this->cliCoeff;
    }

    public function setCliCoeff(?string $cliCoeff): self
    {
        $this->cliCoeff = $cliCoeff;

        return $this;
    }

    public function getCliCom(): ?Commercial
    {
        return $this->cliCom;
    }

    public function setCliCom(?Commercial $cliCom): self
    {
        $this->cliCom = $cliCom;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getPasseCmd(): Collection
    {
        return $this->passeCmd;
    }

    public function addPasseCmd(Commande $passeCmd): self
    {
        if (!$this->passeCmd->contains($passeCmd)) {
            $this->passeCmd[] = $passeCmd;
            $passeCmd->addPasseCli($this);
        }

        return $this;
    }

    public function removePasseCmd(Commande $passeCmd): self
    {
        if ($this->passeCmd->removeElement($passeCmd)) {
            $passeCmd->removePasseCli($this);
        }

        return $this;
    }

}
