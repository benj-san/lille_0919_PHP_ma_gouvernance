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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $presentation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="advisors")
     */
    private $tags;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="advisors")
     */
    private $tagsStatut;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="advisors")
     */
    private $tagsCertificate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="advisors")
     */
    private $tagsActualFunction;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="advisors")
     */
    private $tagsContexts;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="advisors")
     */
    private $tagsCompetences;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="advisors")
     */
    private $tagsExpertises;



    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Board", inversedBy="advisors")
     */
    private $boards;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentary;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resume", mappedBy="advisor")
     */
    private $resumes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $idealMission;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $gouvernanceExperience = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $mandateState= false;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mandateContribution;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $method;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $gain;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $realisation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $topSkill;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $progress;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $otherSpec;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $dailyRate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avaibility;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rgpd = true;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $submissionDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkedin;


    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->tagsStatut = new ArrayCollection();
        $this->tagsCertificate = new ArrayCollection();
        $this->tagsActualFunction = new ArrayCollection();
        $this->tagsCompetences = new ArrayCollection();
        $this->tagsContexts = new ArrayCollection();
        $this->tagsExpertises = new ArrayCollection();
        $this->boards = new ArrayCollection();
        $this->resumes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function gettagsStatut()
    {
        return $this->tagsStatut;
    }

    /**
     * @param mixed $tagsStatut
     * @return Advisor
     */
    public function settagsStatut($tagsStatut)
    {
        $this->tagsStatut = $tagsStatut;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getBoards(): ArrayCollection
    {
        return $this->boards;
    }

    /**
     * @param ArrayCollection $boards
     * @return Advisor
     */
    public function setBoards(ArrayCollection $boards): Advisor
    {
        $this->boards = $boards;
        return $this;
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
        return $this->boards;
    }

    public function addBoard(Board $board): self
    {
        if (!$this->boards->contains($board)) {
            $this->boards[] = $board;
        }

        return $this;
    }

    public function removeBoard(Board $board): self
    {
        if ($this->boards->contains($board)) {
            $this->boards->removeElement($board);
        }

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(?string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }


    /**
     * @return Collection|Resume[]
     */
    public function getResumes(): Collection
    {
        return $this->resumes;
    }

    public function addResume(Resume $resume): self
    {
        if (!$this->resumes->contains($resume)) {
            $this->resumes[] = $resume;
            $resume->setAdvisor($this);
        }

        return $this;
    }

    public function removeResume(Resume $resume): self
    {
        if ($this->resumes->contains($resume)) {
            $this->resumes->removeElement($resume);
            // set the owning side to null (unless already changed)
            if ($resume->getAdvisor() === $this) {
                $resume->setAdvisor(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getIdealMission(): ?string
    {
        return $this->idealMission;
    }

    public function setIdealMission(?string $idealMission): self
    {
        $this->idealMission = $idealMission;

        return $this;
    }

    public function getGouvernanceExperience(): ?bool
    {
        return $this->gouvernanceExperience;
    }

    public function setGouvernanceExperience(?bool $gouvernanceExperience): self
    {
        $this->gouvernanceExperience = $gouvernanceExperience;

        return $this;
    }

    public function getMandateState(): ?bool
    {
        return $this->mandateState;
    }

    public function setMandateState(?bool $mandateState): self
    {
        $this->mandateState = $mandateState;

        return $this;
    }

    public function getMandateContribution(): ?string
    {
        return $this->mandateContribution;
    }

    public function setMandateContribution(?string $mandateContribution): self
    {
        $this->mandateContribution = $mandateContribution;

        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(?string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getGain(): ?string
    {
        return $this->gain;
    }

    public function setGain(?string $gain): self
    {
        $this->gain = $gain;

        return $this;
    }

    public function getRealisation(): ?string
    {
        return $this->realisation;
    }

    public function setRealisation(?string $realisation): self
    {
        $this->realisation = $realisation;

        return $this;
    }

    public function getTopSkill(): ?string
    {
        return $this->topSkill;
    }

    public function setTopSkill(?string $topSkill): self
    {
        $this->topSkill = $topSkill;

        return $this;
    }

    public function getProgress(): ?string
    {
        return $this->progress;
    }

    public function setProgress(?string $progress): self
    {
        $this->progress = $progress;

        return $this;
    }

    public function getOtherSpec(): ?string
    {
        return $this->otherSpec;
    }

    public function setOtherSpec(?string $otherSpec): self
    {
        $this->otherSpec = $otherSpec;

        return $this;
    }

    public function getDailyRate(): ?float
    {
        return $this->dailyRate;
    }

    public function setDailyRate(?float $dailyRate): self
    {
        $this->dailyRate = $dailyRate;

        return $this;
    }

    public function getAvaibility(): ?string
    {
        return $this->avaibility;
    }

    public function setAvaibility(?string $avaibility): self
    {
        $this->avaibility = $avaibility;

        return $this;
    }

    public function getRgpd(): ?bool
    {
        return $this->rgpd;
    }

    public function setRgpd(?bool $rgpd): self
    {
        $this->rgpd = $rgpd;

        return $this;
    }

    public function getSubmissionDate(): ?\DateTimeInterface
    {
        return $this->submissionDate;
    }

    public function setSubmissionDate(?\DateTimeInterface $submissionDate): self
    {
        $this->submissionDate = $submissionDate;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTagsCertificate(): ArrayCollection
    {
        return $this->tagsCertificate;
    }

    /**
     * @param ArrayCollection $tagsCertificate
     * @return Advisor
     */
    public function setTagsCertificate(ArrayCollection $tagsCertificate): Advisor
    {
        $this->tagsCertificate = $tagsCertificate;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTagsActualFunction(): ArrayCollection
    {
        return $this->tagsActualFunction;
    }

    /**
     * @param ArrayCollection $tagsActualFunction
     * @return Advisor
     */
    public function setTagsActualFunction(ArrayCollection $tagsActualFunction): Advisor
    {
        $this->tagsActualFunction = $tagsActualFunction;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTagsContexts(): ArrayCollection
    {
        return $this->tagsContexts;
    }

    /**
     * @param ArrayCollection $tagsContexts
     * @return Advisor
     */
    public function setTagsContexts(ArrayCollection $tagsContexts): Advisor
    {
        $this->tagsContexts = $tagsContexts;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTagsCompetences(): ArrayCollection
    {
        return $this->tagsCompetences;
    }

    /**
     * @param ArrayCollection $tagsCompetences
     * @return Advisor
     */
    public function setTagsCompetences(ArrayCollection $tagsCompetences): Advisor
    {
        $this->tagsCompetences = $tagsCompetences;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTagsExpertises(): ArrayCollection
    {
        return $this->tagsExpertises;
    }

    /**
     * @param ArrayCollection $tagsExpertises
     * @return Advisor
     */
    public function setTagsExpertises(ArrayCollection $tagsExpertises): Advisor
    {
        $this->tagsExpertises = $tagsExpertises;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * @param mixed $linkedin
     * @return Advisor
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
        return $this;
    }
}
