<?php


namespace App\Infrastructure\Repository;


use App\Domain\Artist\Artist;
use App\Domain\Prize\Prize;

class ArtistRepository
{
    public function save(Artist $artist): Artist
    {
        try {
            $artist->save();
        } catch (\Exception $e){
            throw new \Exception("ERROR_WHEN_SAVING_ARTIST");
        }

        return $artist->refresh();
    }

    public function findById(int $id): ?Artist
    {
        try {
            $artist = Artist::find($id);
        } catch (\Exception $e) {
            throw new \Exception("ERROR_WHEN_FINDING_ARTIST");
        }

        return $artist;
    }

}
