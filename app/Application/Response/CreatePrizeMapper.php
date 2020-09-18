<?php


namespace App\Application\Response;


use App\Domain\Prize\Prize;

class CreatePrizeMapper
{
    public static function convertToJson(Prize $prize): array
    {
        return [
            "id" => $prize->getId(),
            "name" => $prize->getName(),
            "category" => $prize->getCategory(),
            "description" => $prize->getDescription(),
            "status" => $prize->getStatus(),
            "artist" => [
                "id" => $prize->getArtist()->getId(),
                "name" => $prize->getArtist()->getName(),
            ],
            "created_at" => $prize->created_at,
            "updated_at" => $prize->updated_at,
        ];
    }
}
