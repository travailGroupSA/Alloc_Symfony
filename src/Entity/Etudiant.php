<?php
namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *      message="Le prenom est invalide"
     * )
     */
    private $prenom;

     /**
     *  @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *      message="Le nom est invalide"
     * )
     */
    private $nom;
    

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $boursier;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInscription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="etudiants")
     */
    private $chambre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $montantBourse;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Regex(
     * pattern = "/^7[05678]{1}[0-9]{7}+$/",
     * message = "Numero de telephone '{{ value }}' invalide"
     * )
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     * pattern="/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",
     * message="Email Invalide"
     * )
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getBoursier(): ?string
    {
        return $this->boursier;
    }

    public function setBoursier(?string $boursier): self
    {
        $this->boursier = $boursier;

        return $this;
    }

    public function getTypeBourse(): ?string
    {
        return $this->typeBourse;
    }

    public function setTypeBourse(?string $typeBourse): self
    {
        $this->typeBourse = $typeBourse;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getMontantBourse(): ?int
    {
        return $this->montantBourse;
    }

    public function setMontantBourse(?int $montantBourse): self
    {
        $this->montantBourse = $montantBourse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
