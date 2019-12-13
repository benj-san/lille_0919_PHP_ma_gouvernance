<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResumeRepository")
 */
class Resume
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Advisor", mappedBy="resume")
     */
    private $advisor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Demand", inversedBy="resumes")
     */
    private $demand;

    public function __construct()
    {
        $this->advisor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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
            $advisor->setResume($this);
        }

        return $this;
    }

    public function removeAdvisor(Advisor $advisor): self
    {
        if ($this->advisor->contains($advisor)) {
            $this->advisor->removeElement($advisor);
            // set the owning side to null (unless already changed)
            if ($advisor->getResume() === $this) {
                $advisor->setResume(null);
            }
        }

        return $this;
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
}
