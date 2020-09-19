<?php


namespace App\Application\Commands;


class DeletePrizeCommand
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
