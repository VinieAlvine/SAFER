<?php

namespace App\Entity;

use App\Repository\FavorisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavorisRepository::class)]
class Favoris
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idBiens = null;

    #[ORM\Column]
    private ?int $idUser = null;

    #[ORM\Column(length: 255)]
    private ?string $emailUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdBiens(): ?int
    {
        return $this->idBiens;
    }

    public function setIdBiens(int $idBiens): self
    {
        $this->idBiens = $idBiens;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->emailUser;
    }

    public function setEmailUser(string $emailUser): self
    {
        $this->emailUser = $emailUser;

        return $this;
    }
}
