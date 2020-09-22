<?php


namespace App\Http\Responses;


use Illuminate\Support\Collection;

/** @OA\Schema(title="List Artist Metrics Response") */
class ListArtistMetricsResponse
{

    /** @OA\Property(property="followers_number", example="724") */
    /** @OA\Property(property="total_streams", example="7000000") */
    /** @OA\Property(property="engagement", example="24.7%") */

    public static function convertToJson(Collection $prizes): array
    {
        return $prizes->toArray();
    }
}
