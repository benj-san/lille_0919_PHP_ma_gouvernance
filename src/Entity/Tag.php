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
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Advisor", inversedBy="tags")
     */
    private $advisors;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Demand", inversedBy="tags")
     */
    private $demand;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="tags")
     */
    private $category;

    public function __construct()
    {
        $this->advisors = new ArrayCollection();
        $this->demand = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return Collection|Advisor[]
     */
    public function getAdvisor(): Collection
    {
        return $this->advisors;
    }

    public function addAdvisor(Advisor $advisor): self
    {
        if (!$this->advisors->contains($advisor)) {
            $this->advisors[] = $advisor;
        }

        return $this;
    }

    public function removeAdvisor(Advisor $advisor): self
    {
        if ($this->advisors->contains($advisor)) {
            $this->advisors->removeElement($advisor);
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAdvisors(): ArrayCollection
    {
        return $this->advisors;
    }

    /**
     * @param ArrayCollection $advisors
     * @return Tag
     */
    public function setAdvisors(ArrayCollection $advisors): Tag
    {
        $this->advisors = $advisors;
        return $this;
    }
}
