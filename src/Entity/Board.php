<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BoardRepository")
 */
class Board
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Demand", inversedBy="boards")
     */
    private $demand;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Advisor", mappedBy="board")
     */
    private $advisors;

    public function __construct()
    {
        $this->advisors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDemand(): ?Demand
    {
        return $this->demand;
    }

    public function setDemand(?Demand $demand): self
    {
        $this->demand = $demand;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(?\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return Collection|Advisor[]
     */
    public function getAdvisors(): Collection
    {
        return $this->advisors;
    }

    public function addAdvisor(Advisor $advisor): self
    {
        if (!$this->advisors->contains($advisor)) {
            $this->advisors[] = $advisor;
            $advisor->addBoard($this);
        }

        return $this;
    }

    public function removeAdvisor(Advisor $advisor): self
    {
        if ($this->advisors->contains($advisor)) {
            $this->advisors->removeElement($advisor);
            $advisor->removeBoard($this);
        }

        return $this;
    }
}
