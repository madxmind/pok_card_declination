<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=ProductDeclination::class, mappedBy="product")
     */
    private $productDeclinations;

    /**
     * @ORM\Column(type="smallint")
     */
    private $quantity;

    public function __construct()
    {
        $this->productDeclinations = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|ProductDeclination[]
     */
    public function getProductDeclinations(): Collection
    {
        return $this->productDeclinations;
    }

    public function addProductDeclination(ProductDeclination $productDeclination): self
    {
        if (!$this->productDeclinations->contains($productDeclination)) {
            $this->productDeclinations[] = $productDeclination;
            $productDeclination->addProduct($this);
        }

        return $this;
    }

    public function removeProductDeclination(ProductDeclination $productDeclination): self
    {
        if ($this->productDeclinations->contains($productDeclination)) {
            $this->productDeclinations->removeElement($productDeclination);
            $productDeclination->removeProduct($this);
        }

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}