<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @ApiResource()
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users", "foodProducts"})
     */
    private $filename;

    /**
     * @ORM\ManyToOne(targetEntity=FoodProduct::class, inversedBy="images")
     */
    private $foodProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFoodProduct(): ?FoodProduct
    {
        return $this->foodProduct;
    }

    public function setFoodProduct(?FoodProduct $foodProduct): self
    {
        $this->foodProduct = $foodProduct;

        return $this;
    }
}
