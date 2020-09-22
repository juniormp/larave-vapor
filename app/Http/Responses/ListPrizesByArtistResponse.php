<?php


namespace App\Http\Responses;


use App\Domain\Prize\Prize;
use App\Http\Requests\CreatePrizeRequest;
use Illuminate\Support\Collection;


class ListPrizesByArtistResponse
{
    public static function convertToJson(Collection $prizes)
    {

        $t = UpdatePrizeResponse::convertToJson($prizes->first());

        return [[$t, $t]];
    }
}
