<?php


namespace App\Http\Controllers;


use App\Application\AskToPublishPrizeUseCase;
use App\Application\Commands\CreateOrUpdatePrizeCommand;
use App\Application\Commands\DeletePrizeCommand;
use App\Application\CreateOrUpdatePrizeUseCase;
use App\Application\DeletePrizeUseCase;
use App\Http\Requests\CreateOrUpdatePrizeRequest;
use App\Http\Requests\DeletePrizeRequest;
use App\Http\Responses\CreateOrUpdatePrizeResponse;


class PrizeController extends Controller
{
    private $createOrUpdate;
    private $deletePrize;
    private $askToPublishPrizeUseCase;

    public function __construct(
        CreateOrUpdatePrizeUseCase $createOrUpdate,
        DeletePrizeUseCase $deletePrize,
        AskToPublishPrizeUseCase $askToPublishPrizeUseCase)
    {
        $this->createOrUpdate = $createOrUpdate;
        $this->deletePrize = $deletePrize;
        $this->askToPublishPrizeUseCase = $askToPublishPrizeUseCase;
    }

    public function createOrUpdate(CreateOrUpdatePrizeRequest $request)
    {
        $createOrUpdateCommand = new CreateOrUpdatePrizeCommand($request->getAttributes());
        $prize = $this->createOrUpdate->execute($createOrUpdateCommand);

        return $this->respond(CreateOrUpdatePrizeResponse::convertToJson($prize));
    }

    public function delete(DeletePrizeRequest $request, int $id)
    {
        $deleteCommand = new DeletePrizeCommand($id);
        $this->deletePrize->execute($deleteCommand);

        return $this->respond([]);
    }

    public function publish(int $id)
    {
        try {
            $this->askToPublishPrizeUseCase->execute($id);

            return response()->json([], 204);
        } catch (\Exception $e) {
            return response()->json([
                "code" => $e->getMessage(),
                "message" => "Some issue occurred when asking to be published",
            ]);
        }
    }
}
