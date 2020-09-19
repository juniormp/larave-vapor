<?php


namespace App\Domain\Artist;


use App\Application\Commands\CreateOrUpdateArtistCommand;

class ArtistFactory
{
    public function create(CreateOrUpdateArtistCommand $createArtistCommand): Artist
    {
        $artist = new Artist();
        $artist->id = $createArtistCommand->getId();
        $artist->name = $createArtistCommand->getName();
        $artist->email = $createArtistCommand->getEmail();
        $artist->password = $createArtistCommand->getPassword();

        return $artist;
    }
}
