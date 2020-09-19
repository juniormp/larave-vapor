<?php


namespace App\Application;


use App\Application\Commands\AskToPublishPrizeCommand;
use App\Application\Commands\ListPrizesByArtistCommand;
use App\Domain\Prize\Exceptions\PrizeAlreadyInReviewException;
use App\Domain\Prize\Prize;
use App\Infrastructure\Repository\PrizeRepository;

class ListPrizesByArtistUseCase
{
    private $prizeRepository;

    public function __construct(PrizeRepository $prizeRepository)
    {
        $this->prizeRepository = $prizeRepository;
    }

    public function execute(ListPrizesByArtistCommand $listPrizesByArtistCommand)
    {
        return $this->prizeRepository->findByArtist($listPrizesByArtistCommand->getId());
    }
}
