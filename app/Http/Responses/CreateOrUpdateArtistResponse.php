<?php


namespace App\Http\Responses;


use App\Domain\Artist\Artist;

/** @OA\Schema(title="Create or Update Artist Response") */
class CreateOrUpdateArtistResponse
{

    /** @OA\Property(example="1")
     * @var string
     */
    private $id;

    /** @OA\Property(example="Frah Quintale")
     * @var string
     */
    private $name;

    /** @OA\Property(example="frah.quintale@gmail.com")
     * @var string
     */
    private $email;

    /** @OA\Property(example="2020-09-20T17:49:42.000000Z")
     * @var string
     */
    private $created_at;

    /** @OA\Property(example="2020-09-20T17:49:42.000000Z")
     * @var string
     */
    private $updated_at;

    public static function convertToJson(Artist $artist): array
    {
        return [
            "id" => $artist->id,
            "name" => $artist->name,
            "email" => $artist->email,
            "created_at" => $artist->created_at->toDateTimeString(),
            "updated_at" => $artist->updated_at->toDateTimeString(),
        ];
    }
}
