<?php


namespace App\Http\Responses;


use App\Domain\Artist\Artist;

class CreateOrUpdateArtistResponse
{
    public static function convertToJson(Artist $artist): array
    {
        return [
            "id" => $artist->id,
            "name" => $artist->name,
            "email" => $artist->email,
            "password" => $artist->password,
            "created_at" => $artist->created_at,
            "updated_at" => $artist->updated_at,
        ];
    }
}
