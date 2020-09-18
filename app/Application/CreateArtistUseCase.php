<?php


namespace App\Application;


use App\Application\Commands\CreateArtistCommand;
use App\Domain\Artist\ArtistFactory;
use App\Infrastructure\Repository\ArtistRepository;
use App\Domain\Artist\Artist;

class CreateArtistUseCase
{
    private $artistRepository;
    private $artistFactory;

    public function __construct(ArtistRepository $artistRepository, ArtistFactory $artistFactory)
    {
        $this->artistRepository = $artistRepository;
        $this->artistFactory = $artistFactory;
    }

    public function execute(CreateArtistCommand $createArtistCommand): Artist
    {
        $artist = $this->artistFactory->create($createArtistCommand);

        return $this->artistRepository->save($artist);
    }
}
