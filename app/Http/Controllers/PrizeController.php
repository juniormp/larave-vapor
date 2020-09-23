<?php


namespace App\Http\Controllers;


use App\Application\AskToPublishPrizeUseCase;
use App\Application\Commands\AskToPublishPrizeCommand;
use App\Application\Commands\CreateOrUpdatePrizeCommand;
use App\Application\Commands\DeletePrizeCommand;
use App\Application\Commands\ListPrizesByArtistCommand;
use App\Application\CreateOrUpdatePrizeUseCase;
use App\Application\DeletePrizeUseCase;
use App\Application\ListPrizesByArtistUseCase;
use App\Exceptions\BusinessRuleValidation;
use App\Http\Requests\AskToPublishPrizeRequest;
use App\Http\Requests\CreatePrizeRequest;
use App\Http\Requests\DeletePrizeRequest;
use App\Http\Requests\ListPrizesByArtistRequest;
use App\Http\Requests\UpdatePrizeRequest;
use App\Http\Responses\AskToPublishPrizeResponse;
use App\Http\Responses\CreatePrizeResponse;
use App\Http\Responses\UpdatePrizeResponse;
use App\Http\Responses\ListArtistMetricsResponse;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Symfony\Component\HttpFoundation\Response;


class PrizeController extends Controller
{
    private $createOrUpdate;
    private $deletePrize;
    private $askToPublishPrize;
    private $listPrizesByArtist;

    public function __construct(
        CreateOrUpdatePrizeUseCase $createOrUpdate,
        DeletePrizeUseCase $deletePrize,
        AskToPublishPrizeUseCase $askToPublishPrize,
        ListPrizesByArtistUseCase $listPrizesByArtist)
    {
        $this->createOrUpdate = $createOrUpdate;
        $this->deletePrize = $deletePrize;
        $this->askToPublishPrize = $askToPublishPrize;
        $this->listPrizesByArtist = $listPrizesByArtist;
    }

    /**
     * @OA\Post(
     *      path="/api/prizes",
     *      operationId="create",
     *      tags={"Prize"},
     *      summary="Create Prize",
     *      description="Returns a Prize created",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreatePrizeRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CreatePrizeResponse")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     * )
     * @param CreatePrizeRequest $request
     * @return Response
     */
    public function create(CreatePrizeRequest $request)
    {
        $createOrUpdateCommand = new CreateOrUpdatePrizeCommand($request->getAttributes());
        $prize = $this->createOrUpdate->execute($createOrUpdateCommand);

        return $this->respondWithCreated(CreatePrizeResponse::convertToJson($prize));
    }

    /**
     * @OA\Put(
     *      path="/api/prizes",
     *      operationId="update",
     *      tags={"Prize"},
     *      summary="Update Prize",
     *      description="Returns a Prize Updated",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePrizeRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePrizeResponse")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     * )
     * @param CreatePrizeRequest $request
     * @return Response
     */
    public function update(UpdatePrizeRequest $request)
    {
        $createOrUpdateCommand = new CreateOrUpdatePrizeCommand($request->getAttributes());
        $prize = $this->createOrUpdate->execute($createOrUpdateCommand);

        return $this->respondWithCreated(UpdatePrizeResponse::convertToJson($prize));
    }

    /**
     * @OA\Delete(
     *      path="/api/prize/{id}",
     *      operationId="delete",
     *      tags={"Prize"},
     *      summary="Delete existing prize",
     *      description="Deletes a prize and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          example="1",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      )
     * )
     * @param DeletePrizeRequest $request
     * @param int $id
     * @return Response
     */
    public function delete(DeletePrizeRequest $request, int $id)
    {
        $deleteCommand = new DeletePrizeCommand($id);
        $this->deletePrize->execute($deleteCommand);

        return $this->respond([]);
    }

    /**
     * @OA\Patch(
     *      path="/api/prize/{id}/publish",
     *      operationId="publish",
     *      tags={"Prize"},
     *      summary="Publish Prize to be reviwed by staff team",
     *      description="Publishes a Prize so can be reviwed by staff team",
     *      @OA\Parameter(
     *          name="id",
     *          example="1",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Business rule failed validation",
     *      )
     * )
     * @param AskToPublishPrizeRequest $request
     * @param int $id
     * @return Response
     * @throws BusinessRuleValidation
     */
    public function publish(AskToPublishPrizeRequest $request, int $id)
    {
        $askToPublishCommand = new AskToPublishPrizeCommand($id);
        $prize = $this->askToPublishPrize->execute($askToPublishCommand);

        return $this->respond(AskToPublishPrizeResponse::convertToJson($prize));
    }

    /**
     * @OA\Get(
     *      path="/api/artist/{id}/prizes",
     *      operationId="listPrizesByArtist",
     *      tags={"Prize"},
     *      summary="List artist prizes",
     *      description="Returns list of prizes from an artist",
     *      @OA\Parameter(
     *          name="id",
     *          example="1",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     * )
     * @param ListPrizesByArtistRequest $request
     * @param int $id
     * @return Response
     */
    public function listPrizesByArtist(ListPrizesByArtistRequest $request, int $id)
    {
        $listPrizesByArtistCommand = new ListPrizesByArtistCommand($id);
        $prizes = $this->listPrizesByArtist->execute($listPrizesByArtistCommand);

        return ResponseBuilder::success($prizes);

        $listPrizesByArtistCommand = new ListPrizesByArtistCommand($request->id);
        $prizes = $this->listPrizesByArtist->execute($listPrizesByArtistCommand);

        dd(
            ListArtistMetricsResponse::convertToJson($prizes)
        );
    }
}
