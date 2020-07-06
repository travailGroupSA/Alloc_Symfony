<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $num_chambre;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $num_batiment;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumChambre(): ?string
    {
        return $this->num_chambre;
    }

    public function setNumChambre(string $num_chambre): self
    {
        $this->num_chambre = $num_chambre;

        return $this;
    }

    public function getNumBatiment(): ?string
    {
        return $this->num_batiment;
    }

    public function setNumBatiment(string $num_batiment): self
    {
        $this->num_batiment = $num_batiment;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
