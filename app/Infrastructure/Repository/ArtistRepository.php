<?php


namespace App\Infrastructure\Repository;


use App\Domain\Artist\Artist;

class ArtistRepository
{
    public function save(Artist $artist): Artist
    {
        $artist->save();
        return $artist->refresh();
    }

    public function findById(int $id): ?Artist
    {
        return Artist::find($id);
    }

}
