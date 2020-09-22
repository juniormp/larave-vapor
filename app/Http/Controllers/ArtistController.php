<?php


namespace App\Http\Controllers;


use App\Application\Commands\CreateOrUpdateArtistCommand;
use App\Application\CreateOrUpdateArtistUseCase;
use App\Application\ListPrizesByArtistUseCase;
use App\Http\Requests\CreateArtistRequest;
use App\Http\Requests\ListArtistMetricsRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Http\Responses\CreateArtistResponse;
use App\Http\Responses\updateArtistResponse;
use Symfony\Component\HttpFoundation\Response;

class ArtistController extends Controller
{
    private $createOrUpdate;
    private $listPrizesByArtist;

    public function __construct(
        CreateOrUpdateArtistUseCase $createOrUpdate,
        ListPrizesByArtistUseCase $listPrizesByArtist
    )
    {
        $this->createOrUpdate = $createOrUpdate;
        $this->listPrizesByArtist = $listPrizesByArtist;
    }

    /**
     * @OA\Post(
     *      path="/api/artist",
     *      operationId="create",
     *      tags={"Artist"},
     *      summary="Create an Artist",
     *      description="Returns an Artist created",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateArtistRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CreateArtistResponse")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     * )
     * @param CreateArtistRequest $request
     * @return Response
     */
    public function create(CreateArtistRequest $request)
    {
        $createOrUpdateCommand = new CreateOrUpdateArtistCommand($request->getAttributes());
        $artist = $this->createOrUpdate->execute($createOrUpdateCommand);

        return $this->respondWithCreated(CreateArtistResponse::convertToJson($artist));
    }

    /**
     * @OA\Put(
     *      path="/api/artist",
     *      operationId="update",
     *      tags={"Artist"},
     *      summary="Update an Artist",
     *      description="Returns an Artist updated",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateArtistRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UpdateArtistResponse")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     * )
     * @param UpdateArtistRequest $request
     * @return Response
     */
    public function update(UpdateArtistRequest $request)
    {
        $createOrUpdateCommand = new CreateOrUpdateArtistCommand($request->getAttributes());
        $artist = $this->createOrUpdate->execute($createOrUpdateCommand);

        return $this->respondWithCreated(UpdateArtistResponse::convertToJson($artist));
    }

    /**
     * @OA\Get(
     *      path="/api/artists/{id}/metrics",
     *      operationId="metrics",
     *      tags={"Artist"},
     *      summary="List artist metrics",
     *      description="Returns list of metrics from an artist",
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
     *         @OA\JsonContent(ref="#/components/schemas/ListArtistMetricsResponse")
     *       )
     * )
     */
    public function listMetrics(ListArtistMetricsRequest $request)
    {
        return $this->respond([
            "followers_number" => "10000",
            "total_streams" => "7000000",
            "engagement" => "24.7%"
        ]);
    }
}
