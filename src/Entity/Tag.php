<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Advisor", inversedBy="tags")
     */
    private $advisor;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Demand", inversedBy="tags")
     */
    private $demand;

    public function __construct()
    {
        $this->advisor = new ArrayCollection();
        $this->demand = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?array
    {
        return $this->name;
    }

    public function setName(array $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Advisor[]
     */
    public function getAdvisor(): Collection
    {
        return $this->advisor;
    }

    public function addAdvisor(Advisor $advisor): self
    {
        if (!$this->advisor->contains($advisor)) {
            $this->advisor[] = $advisor;
        }

        return $this;
    }

    public function removeAdvisor(Advisor $advisor): self
    {
        if ($this->advisor->contains($advisor)) {
            $this->advisor->removeElement($advisor);
        }

        return $this;
    }

    /**
     * @return Collection|Demand[]
     */
    public function getDemand(): Collection
    {
        return $this->demand;
    }

    public function addDemand(Demand $demand): self
    {
        if (!$this->demand->contains($demand)) {
            $this->demand[] = $demand;
        }

        return $this;
    }

    public function removeDemand(Demand $demand): self
    {
        if ($this->demand->contains($demand)) {
            $this->demand->removeElement($demand);
        }

        return $this;
    }
}
