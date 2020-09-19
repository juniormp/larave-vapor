<?php


namespace App\Domain\Prize;

use App\Application\Commands\CreateOrUpdatePrizeCommand;


class PrizeFactory
{
    public function create(CreateOrUpdatePrizeCommand $createPrizeCommand): Prize
    {
        $prize = new Prize();

        $prize->id = $createPrizeCommand->getId();
        $prize->name = $createPrizeCommand->getName();
        $prize->category = $createPrizeCommand->getCategory();
        $prize->description = $createPrizeCommand->getDescription();
        $prize->image = $createPrizeCommand->getImage();
        $prize->status = PrizeStatus::OPEN;
        $prize->artist_id = $createPrizeCommand->getArtistId();

        return $prize;
    }
}
