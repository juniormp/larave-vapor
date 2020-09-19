<?php


namespace App\Application\Commands;


class CreateOrUpdatePrizeCommand
{
    private $id;
    private $name;
    private $category;
    private $description;
    private $image;
    private $artistId;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;;
        $this->name = $data['name'];
        $this->category = $data['category'];
        $this->description = $data['description'];
        $this->image = $data['image'];
        $this->artistId = $data['artist_id'];
    }

    public function getId(): ?int
    {
        return $this->id;
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
