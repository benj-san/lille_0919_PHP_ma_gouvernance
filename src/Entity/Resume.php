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
     * @ORM\ManyToOne(targetEntity="App\Entity\Demand", inversedBy="resumes")
     */
    private $demand;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Advisor", inversedBy="resumes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $advisor;

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

    public function getDemand(): ?Demand
    {
        return $this->demand;
    }

    public function setDemand(?Demand $demand): self
    {
        $this->demand = $demand;

        return $this;
    }

    public function getAdvisor(): ?Advisor
    {
        return $this->advisor;
    }

    public function setAdvisor(?Advisor $advisor): self
    {
        $this->advisor = $advisor;

        return $this;
    }
}
