<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 *  @ApiResource()
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=13, nullable=true)
     * @Assert\NotBlank
     */
    private $ean;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $teaser;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type("int")
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picturemain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picturefront;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pictureback;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $manual;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="articles")
     */
    private $fk_category;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="articles")
     */
    private $fk_tags;

    public function __construct()
    {
        $this->fk_tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): self
    {
        $this->ean = $ean;

        return $this;
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

    public function getTeaser(): ?string
    {
        return $this->teaser;
    }

    public function setTeaser(?string $teaser): self
    {
        $this->teaser = $teaser;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPicturemain(): ?string
    {
        return $this->picturemain;
    }

    public function setPicturemain(?string $picturemain): self
    {
        $this->picturemain = $picturemain;

        return $this;
    }

    public function getPicturefront(): ?string
    {
        return $this->picturefront;
    }

    public function setPicturefront(?string $picturefront): self
    {
        $this->picturefront = $picturefront;

        return $this;
    }

    public function getPictureback(): ?string
    {
        return $this->pictureback;
    }

    public function setPictureback(?string $pictureback): self
    {
        $this->pictureback = $pictureback;

        return $this;
    }

    public function getManual(): ?string
    {
        return $this->manual;
    }

    public function setManual(?string $manual): self
    {
        $this->manual = $manual;

        return $this;
    }

    public function getFkCategory(): ?Category
    {
        return $this->fk_category;
    }

    public function setFkCategory(?Category $fk_category): self
    {
        $this->fk_category = $fk_category;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getFkTags(): Collection
    {
        return $this->fk_tags;
    }

    public function addFkTag(Tag $fkTag): self
    {
        if (!$this->fk_tags->contains($fkTag)) {
            $this->fk_tags[] = $fkTag;
        }

        return $this;
    }

    public function removeFkTag(Tag $fkTag): self
    {
        $this->fk_tags->removeElement($fkTag);

        return $this;
    }
}
