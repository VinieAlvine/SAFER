<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Biens::class)]
    private Collection $biens;

    public function __construct()
    {
        $this->biens = new ArrayCollection();
    }
    public function __toString(){
        return $this->getNom();
    }
    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Biens>
     */
    public function getBiens(): Collection
    {
        return $this->biens;
    }

    public function addBien(Biens $bien): self
    {
        if (!$this->biens->contains($bien)) {
            $this->biens->add($bien);
            $bien->setCategory($this);
        }

        return $this;
    }

    public function removeBien(Biens $bien): self
    {
        if ($this->biens->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getCategory() === $this) {
                $bien->setCategory(null);
            }
        }

        return $this;
    }
}
