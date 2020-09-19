<?php


namespace App\Application;


use App\Application\Commands\AskToPublishPrizeCommand;
use App\Domain\Prize\Exceptions\PrizeAlreadyInReviewException;
use App\Domain\Prize\Prize;
use App\Infrastructure\Repository\PrizeRepository;

class AskToPublishPrizeUseCase
{
    private $prizeRepository;

    public function __construct(PrizeRepository $prizeRepository)
    {
        $this->prizeRepository = $prizeRepository;
    }

    public function execute(AskToPublishPrizeCommand $askToPublishCommand): Prize
    {
        $prize = $this->prizeRepository->findById($askToPublishCommand->getId());

        try {
            $prize->askToPublish();
        } catch (PrizeAlreadyInReviewException $exception) {
            throw $exception->validationException();
        }

        return $this->prizeRepository->save($prize);
    }
}
