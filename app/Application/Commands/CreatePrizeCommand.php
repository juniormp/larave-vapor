<?php


namespace App\Application\Commands;


class CreatePrizeCommand
{
    private $name;
    private $category;
    private $description;
    private $image;
    private $artistId;

    public function __construct(string $name, string $category, string $description, string $image, int $artistId)
    {
        $this->name = $name;
        $this->category = $category;
        $this->description = $description;
        $this->image = $image;
        $this->artistId = $artistId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getArtistId(): int
    {
        return $this->artistId;
    }
}
