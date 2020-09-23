<?php


namespace App\Http\Responses;


use App\Domain\Prize\Prize;

/** @OA\Schema(title="Create Prize Response") */
class CreatePrizeResponse
{

    /** @OA\Property(property="id", example="1") */
    /** @OA\Property(property="name", example="Ticket") */
    /** @OA\Property(property="category", example="FIRST") */
    /** @OA\Property(property="description", type="string", example="Show tickets for the first in monthly rank") */
    /** @OA\Property(property="status", example="OPEN") */
    /** @OA\Property(property="artist_id", example="1")  */
    /** @OA\Property(property="created_at", example="2020-09-20T17:49:42.000000Z") */
    /** @OA\Property(property="updated_at", example="2020-09-20T17:49:42.000000Z") */

    public static function convertToJson(Prize $prize): array
    {
        return [
            "id" => $prize->id,
            "name" => $prize->name,
            "category" => $prize->category,
            "description" => $prize->description,
            "status" => $prize->status,
            "artist_id" => $prize->artist->id,
            "created_at" => $prize->created_at->toDateTimeString(),
            "updated_at" => $prize->updated_at->toDateTimeString(),
        ];
    }
}
