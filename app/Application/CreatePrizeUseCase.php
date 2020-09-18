<?php


namespace App\Application;


use App\Application\Commands\CreatePrizeCommand;
use App\Domain\Prize\PrizeFactory;
use App\Domain\Prize\Prize;
use App\Infrastructure\Repository\ArtistRepository;
use App\Infrastructure\Repository\PrizeRepository;

class CreatePrizeUseCase
{
    private $prizeRepository;
    private $artistRepository;
    private $createPrizeFactory;

    public function __construct(
        PrizeRepository $prizeRepository,
        PrizeFactory $createPrizeFactory,
        ArtistRepository $artistRepository)
    {
        $this->prizeRepository = $prizeRepository;
        $this->createPrizeFactory = $createPrizeFactory;
        $this->artistRepository = $artistRepository;
    }

    public function execute(CreatePrizeCommand $createPrizeCommand): Prize
    {
        $artist = $this->artistRepository->findById($createPrizeCommand->getArtistId());

        if (is_null($artist)) {
            throw new \Exception("ARTIST_NOT_FOUND");
        }

        $prize = $this->createPrizeFactory->create($createPrizeCommand);

        return $this->prizeRepository->save($prize);
    }
}
