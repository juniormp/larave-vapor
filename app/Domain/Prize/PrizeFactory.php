<?php


namespace App\Domain\Prize;

use App\Application\Commands\CreatePrizeCommand;


class PrizeFactory
{
    public function create(CreatePrizeCommand $createPrizeCommand): Prize
    {
        $prize = new Prize();

        $prize->name = $createPrizeCommand->getName();
        $prize->category = $createPrizeCommand->getCategory();
        $prize->description = $createPrizeCommand->getDescription();
        $prize->image = $createPrizeCommand->getImage();
        $prize->status = PrizeStatus::OPEN;
        $prize->artist_id = $createPrizeCommand->getArtistId();

        return $prize;
    }
}
