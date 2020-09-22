<?php


namespace App\Http\Responses;


use App\Domain\Prize\Prize;

/** @OA\Schema(title="Create or Update Prize Response") */
class UpdatePrizeResponse
{
    /** @OA\Property(example="1")
     * @var string
     */
    private $id;

    /** @OA\Property(example="Ticket")
     * @var string
     */
    private $name;

    /** @OA\Property(example="FIRST")
     * @var string
     */
    private $category;

    /** @OA\Property(example="OPEN")
     * @var string
     */
    private $status;

    /** @OA\Property(example="1")
     * @var string
     */
    private $artist_id;

    /** @OA\Property(example="2020-09-20T17:49:42.000000Z")
     * @var string
     */
    private $created_at;

    /** @OA\Property(example="2020-09-20T17:49:42.000000Z")
     * @var string
     */
    private $updated_at;

    public static function convertToJson(Prize $prize): array
    {
        return [
            "id" => $prize->id,
            "name" => $prize->name,
            "category" => $prize->category,
            "description" => $prize->description,
            "status" => $prize->status,
            "artist_id" => $prize->getArtist()->id,
            "created_at" => $prize->created_at->toDateTimeString(),
            "updated_at" => $prize->updated_at->toDateTimeString(),
        ];
    }
}
