<?php


namespace App\Http\Responses;


use App\Domain\Artist\Artist;

/** @OA\Schema(title="Update Artist Response") */
class UpdateArtistResponse
{
    /** @OA\Property(property="id", example="1") */
    /** @OA\Property(property="name", example="Frah") */
    /** @OA\Property(property="last_name", example="Quintale") */
    /** @OA\Property(property="bio", example="Bio description ...") */
    /** @OA\Property(property="email", example="frah.quintale@gmail.com")  */
    /** @OA\Property(property="created_at", example="2020-09-20T17:49:42.000000Z") */
    /** @OA\Property(property="updated_at", example="2020-09-20T17:49:42.000000Z") */

    public static function convertToJson(Artist $artist): array
    {
        return [
            "id" => $artist->id,
            "name" => $artist->name,
            "last_name" => $artist->lastName,
            "bio" => $artist->bio,
            "email" => $artist->email,
            "created_at" => $artist->created_at->toDateTimeString(),
            "updated_at" => $artist->updated_at->toDateTimeString(),
        ];
    }
}
