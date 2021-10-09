<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;


    /**
     * @ORM\ManyToOne(targetEntity=color::class, inversedBy="stocks")
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=size::class, inversedBy="stocks")
     */
    private $size;

    public function __construct()
    {
        $this->reference = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getColor(): ?color
    {
        return $this->color;
    }

    public function setColor(?color $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getSize(): ?size
    {
        return $this->size;
    }

    public function setSize(?size $size): self
    {
        $this->size = $size;

        return $this;
    }
}
