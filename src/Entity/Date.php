<?php

namespace App\Entity;

use App\Repository\DateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DateRepository::class)]
class Date
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $raw = null;

    #[ORM\Column(length: 255)]
    private ?string $parsed = null;

    #[ORM\Column]
    private ?int $parsed_count = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaw(): ?string
    {
        return $this->raw;
    }

    public function setRaw(string $raw): static
    {
        $this->raw = $raw;

        return $this;
    }

    public function getParsed(): ?string
    {
        return $this->parsed;
    }

    public function setParsed(string $parsed): static
    {
        $this->parsed = $parsed;

        return $this;
    }

    public function getParsedCount(): ?int
    {
        return $this->parsed_count;
    }

    public function setParsedCount(int $parsed_count): static
    {
        $this->parsed_count = $parsed_count;

        return $this;
    }
}
