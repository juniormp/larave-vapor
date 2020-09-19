<?php


namespace App\Http\Controllers;


use App\Application\Commands\CreateOrUpdateArtistCommand;
use App\Application\CreateOrUpdateArtistUseCase;
use App\Http\Requests\CreateOrUpdateArtistRequest;
use App\Http\Responses\CreateOrUpdateArtistResponse;

class ArtistController extends Controller
{
    private $createOrUpdate;

    public function __construct(CreateOrUpdateArtistUseCase $createOrUpdate)
    {
        $this->createOrUpdate = $createOrUpdate;
    }

    public function createOrUpdate(CreateOrUpdateArtistRequest $request)
    {
        $createOrUpdateCommand = new CreateOrUpdateArtistCommand($request->getAttributes());
        $artist = $this->createOrUpdate->execute($createOrUpdateCommand);

        return $this->respond(CreateOrUpdateArtistResponse::convertToJson($artist));
    }
}
