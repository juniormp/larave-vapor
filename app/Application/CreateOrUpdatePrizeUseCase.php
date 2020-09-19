<?php


namespace App\Application;


use App\Application\Commands\CreateOrUpdatePrizeCommand;
use App\Domain\Prize\PrizeFactory;
use App\Domain\Prize\Prize;
use App\Infrastructure\Repository\ArtistRepository;
use App\Infrastructure\Repository\PrizeRepository;

class CreateOrUpdatePrizeUseCase
{
    private $prizeRepository;
    private $prizeFactory;

    public function __construct(PrizeRepository $prizeRepository, PrizeFactory $prizeFactory)
    {
        $this->prizeRepository = $prizeRepository;
        $this->prizeFactory = $prizeFactory;
    }

    public function execute(CreateOrUpdatePrizeCommand $createOrUpdateCommand): Prize
    {
        $prize = $this->createOrUpdate($createOrUpdateCommand);

        return $this->prizeRepository->save($prize);
    }

    private function createOrUpdate(CreateOrUpdatePrizeCommand $createOrUpdateCommand): Prize
    {
        if (is_null($createOrUpdateCommand->getId())) {
           return $this->prizeFactory->create($createOrUpdateCommand);
        }

        $prize = $this->prizeRepository->findById($createOrUpdateCommand->getId());

        $prize->name = $createOrUpdateCommand->getName();
        $prize->category = $createOrUpdateCommand->getCategory();
        $prize->description = $createOrUpdateCommand->getDescription();
        $prize->image = $createOrUpdateCommand->getImage();
        $prize->artist_id = $createOrUpdateCommand->getArtistId();

        return $prize;
    }
}
