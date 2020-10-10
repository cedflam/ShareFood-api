<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 * @ApiResource(
 *     attributes={
            "order"={
 *              "createdAt":"ASC"
 *          }
 *     },
 * )
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"users"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"users"})
     *
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"users"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=FoodProduct::class, inversedBy="messages")
     *
     */
    private $foodProduct;

    /**
     * @ORM\ManyToOne(targetEntity=Chat::class, inversedBy="messages")
     */
    private $chat;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(?Chat $chat): self
    {
        $this->chat = $chat;

        return $this;
    }
}
