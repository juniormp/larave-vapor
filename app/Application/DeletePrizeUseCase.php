<?php


namespace App\Application;


use App\Application\Commands\DeletePrizeCommand;
use App\Infrastructure\Repository\PrizeRepository;

class DeletePrizeUseCase
{
    private $prizeRepository;

    public function __construct(PrizeRepository $prizeRepository)
    {
        $this->prizeRepository = $prizeRepository;
    }

    public function execute(DeletePrizeCommand $deletePrizeCommand): void
    {
        $prize = $this->prizeRepository->findById($deletePrizeCommand->getId());
        $this->prizeRepository->delete($prize);
    }
}
