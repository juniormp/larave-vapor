<?php


namespace App\Application;


use App\Application\Commands\CreateOrUpdateArtistCommand;
use App\Domain\Artist\ArtistFactory;
use App\Infrastructure\Repository\ArtistRepository;
use App\Domain\Artist\Artist;

class CreateOrUpdateArtistUseCase
{
    private $artistRepository;
    private $artistFactory;

    public function __construct(ArtistRepository $artistRepository, ArtistFactory $artistFactory)
    {
        $this->artistRepository = $artistRepository;
        $this->artistFactory = $artistFactory;
    }

    public function execute(CreateOrUpdateArtistCommand $createOrUpdateCommand): Artist
    {
        return $this->artistRepository->save(
            $this->createOrUpdate($createOrUpdateCommand)
        );
    }

    private function createOrUpdate(CreateOrUpdateArtistCommand $createOrUpdateCommand): Artist
    {
        if (is_null($createOrUpdateCommand->getId())) {
            return $this->artistFactory->create($createOrUpdateCommand);
        }

        $artist = $this->artistRepository->findById($createOrUpdateCommand->getId());

        $artist->name = $createOrUpdateCommand->getName();
        $artist->email = $createOrUpdateCommand->getEmail();
        $artist->password = $createOrUpdateCommand->getPassword();

        return $artist;
    }
}
