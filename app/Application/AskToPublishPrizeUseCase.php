<?php


namespace App\Application;


use App\Infrastructure\Repository\PrizeRepository;

class AskToPublishPrizeUseCase
{
    private $prizeRepository;

    public function __construct(PrizeRepository $prizeRepository)
    {
        $this->prizeRepository = $prizeRepository;
    }

    public function execute(int $id): void
    {
        $prize = $this->prizeRepository->findById($id);

        if (is_null($prize)) {
            throw new \Exception("PRIZE_NOT_FOUND");
        }

        $prize->askToPublish();

        $this->prizeRepository->save($prize);
    }
}