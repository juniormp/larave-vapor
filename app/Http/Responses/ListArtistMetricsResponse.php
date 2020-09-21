<?php


namespace App\Http\Responses;


use App\Domain\Artist\Artist;

/** @OA\Schema(title="List Artist Metrics Response") */
class ListArtistMetricsResponse
{

    /** @OA\Property(example="724")
     * @var int
     */
    private $followers_number;

    /** @OA\Property(example="7000000")
     * @var int
     */
    private $total_streams;

    /** @OA\Property(example="24.7%")
     * @var string
     */
    private $engagement;
}
