<?php


namespace App\Http\Responses;


use App\Domain\Prize\Prize;

class CreateOrUpdatePrizeResponse
{
    public static function convertToJson(Prize $prize): array
    {
        return [
            "id" => $prize->id,
            "name" => $prize->name,
            "category" => $prize->category,
            "description" => $prize->description,
            "status" => $prize->status,
            "artist" => [
                "id" => $prize->getArtist()->id,
                "name" => $prize->getArtist()->name,
            ],
            "created_at" => $prize->created_at,
            "updated_at" => $prize->updated_at,
        ];
    }
}