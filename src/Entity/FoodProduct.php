<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FoodProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=FoodProductRepository::class)
 * @ApiResource(
 *     normalizationContext={
            "groups"={"foodProducts"}
 *     },
 *     attributes={
            "order"={
 *              "expiratedAt":"ASC"
 *          }
 *     },
 * )
 */
class FoodProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"foodProducts", "chats"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users", "chats", "foodProducts"})
     */
    private $productName;

    /**
     * @ORM\Column(type="text")
     * @Groups({"users", "chats", "foodProducts"})
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"users", "foodProducts"})
     */
    private $expiratedAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"users", "foodProducts"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"users", "foodProducts"})
     */
    private $available;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users", "foodProducts"})
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users", "foodProducts"})
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="foodProducts")
     * @Groups({"foodProducts"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="foodProduct")
     * @Groups({"users", "foodProducts"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="foodProduct")
     * @Groups({"users", "foodProducts"})
     */
    private $messages;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getExpiratedAt(): ?\DateTimeInterface
    {
        return $this->expiratedAt;
    }

    public function setExpiratedAt(\DateTimeInterface $expiratedAt): self
    {
        $this->expiratedAt = $expiratedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setFoodProduct($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getFoodProduct() === $this) {
                $image->setFoodProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setFoodProduct($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getFoodProduct() === $this) {
                $message->setFoodProduct(null);
            }
        }

        return $this;
    }
}
