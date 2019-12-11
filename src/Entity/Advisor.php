<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdvisorRepository")
 */
class Advisor
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
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $place;


    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $availabilityStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $availabilityEnd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $presentation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="advisor")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Board", inversedBy="advisors")
     */
    private $board;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->board = new ArrayCollection();
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }


    public function getAvailabilityStart(): ?\DateTimeInterface
    {
        return $this->availabilityStart;
    }

    public function setAvailabilityStart(?\DateTimeInterface $availabilityStart): self
    {
        $this->availabilityStart = $availabilityStart;

        return $this;
    }

    public function getAvailabilityEnd(): ?\DateTimeInterface
    {
        return $this->availabilityEnd;
    }

    public function setAvailabilityEnd(?\DateTimeInterface $availabilityEnd): self
    {
        $this->availabilityEnd = $availabilityEnd;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addAdvisor($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeAdvisor($this);
        }

        return $this;
    }

    /**
     * @return Collection|Board[]
     */
    public function getBoard(): Collection
    {
        return $this->board;
    }

    public function addBoard(Board $board): self
    {
        if (!$this->board->contains($board)) {
            $this->board[] = $board;
        }

        return $this;
    }

    public function removeBoard(Board $board): self
    {
        if ($this->board->contains($board)) {
            $this->board->removeElement($board);
        }

        return $this;
    }
}
