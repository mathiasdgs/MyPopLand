<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as DocCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=Rate::class, mappedBy="article")
     */
    private $rates;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="articles")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="articles")
     */
    private $category;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $rateAverage;

    /**
     * @ORM\ManyToMany(targetEntity=Collection::class, mappedBy="article")
     */
    private $collections;


    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->rates = new ArrayCollection();
        $this->collections = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return DocCollection|Rate[]
     */
    public function getRates(): DocCollection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates[] = $rate;
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        $this->rates->removeElement($rate);

        return $this;
    }

    /**
     * @return DocCollection|User[]
     */
    public function getUsers(): DocCollection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

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

    public function __toString(){
        // to show the name of the Category in the select
        return $this->title;
        // to show the id of the Category in the select
        // return $this->id;
    }

    public function getRateAverage(): ?float
    {
        return $this->rateAverage;
    }

    public function setRateAverage(?float $rateAverage): self
    {
        $this->rateAverage = $rateAverage;

        return $this;
    }

    /**
     * @return DocCollection|Collection[]
     */
    public function getCollections(): DocCollection
    {
        return $this->collections;
    }

    public function addCollection(Collection $collection): self
    {
        if (!$this->collections->contains($collection)) {
            $this->collections[] = $collection;
            $collection->addArticle($this);
        }

        return $this;
    }

    public function removeCollection(Collection $collection): self
    {
        if ($this->collections->removeElement($collection)) {
            $collection->removeArticle($this);
        }

        return $this;
    }    
}
