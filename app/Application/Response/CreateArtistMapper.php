<?php


namespace App\Application\Response;


use App\Domain\Artist\Artist;

class CreateArtistMapper
{
    public static function convertToJson(Artist $artist): array
    {
        return [
            "id" => $artist->getId(),
            "name" => $artist->getName(),
            "email" => $artist->getEmail(),
            "password" => $artist->getPassword(),
            "created_at" => $artist->created_at,
            "updated_at" => $artist->updated_at,
        ];
    }
}
