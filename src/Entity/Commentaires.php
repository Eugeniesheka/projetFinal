<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Commentaires")
 * @ORM\HasLifecycleCallbacks() 
 * @ORM\Entity(repositoryClass=CommentairesRepository::class)
 */
class Commentaires
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creatAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenus;

    /**
     * @var Annonces
     * @ORM\ManyToOne(targetEntity=Annonces::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;
    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->createAt = new \DateTime();
        $this->updateAt = new \DateTime();
    }
     /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updateAt= new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeInterface
    {
        return $this->creatAt;
    }

    public function setCreatAt(\DateTimeInterface $creatAt): self
    {
        $this->creatAt = $creatAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getContenus(): ?string
    {
        return $this->contenus;
    }

    public function setContenus(string $contenus): self
    {
        $this->contenus = $contenus;

        return $this;
    }

    public function getAnnonce(): ?Annonces
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonces $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }
}
