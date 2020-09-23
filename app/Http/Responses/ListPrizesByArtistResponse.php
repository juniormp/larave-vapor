<?php


namespace App\Http\Responses;


use Illuminate\Support\Collection;


class ListPrizesByArtistResponse
{
    public static function convertToJson(Collection $prizes)
    {
        return [
            "items" => $prizes->toArray()
        ];
    }
}
