<?php


namespace App\Domain\Artist;


use App\Application\Commands\CreateArtistCommand;

class ArtistFactory
{
    public function create(CreateArtistCommand $createArtistCommand): Artist
    {
        $artist = new Artist();

        $artist->name = $createArtistCommand->getName();
        $artist->email = $createArtistCommand->getEmail();
        $artist->password = $createArtistCommand->getPassword();

        return $artist;
    }
}
