<?php

namespace App\Entity;

use App\Repository\FeedbackRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FeedbackRepository::class)
 */
class Feedback
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $raiting;

    /**
     * @ORM\Column(type="text") }
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="feedback")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    public function __toString()
    {
        return $this->raiting;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaiting(): ?int
    {
        return $this->raiting;
    }

    public function setRaiting(int $raiting): self
    {
        if($raiting < 0)
            return null;
        $this->raiting = $raiting;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
