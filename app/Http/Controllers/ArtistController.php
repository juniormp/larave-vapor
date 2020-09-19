<?php


namespace App\Http\Controllers;


use App\Application\Commands\CreateOrUpdateArtistCommand;
use App\Application\CreateOrUpdateArtistUseCase;
use App\Http\Requests\CreateOrUpdateArtistRequest;
use App\Http\Requests\ListPrizesByArtistRequest;
use App\Http\Responses\CreateOrUpdateArtistResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArtistController extends Controller
{
    private $createOrUpdate;

    public function __construct(CreateOrUpdateArtistUseCase $createOrUpdate)
    {
        $this->createOrUpdate = $createOrUpdate;
    }

    /**
     * @OA\Post(
     *      path="/api/artist",
     *      operationId="createOrUpdate",
     *      tags={"Artist"},
     *      summary="Create or Update an Artist",
     *      description="Returns an Artist created or updated",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateOrUpdateArtistRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CreateOrUpdateArtistResponse")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *      ),
     * )
     * @param CreateOrUpdateArtistRequest $request
     * @return Response
     */
    public function createOrUpdate(CreateOrUpdateArtistRequest $request)
    {
        $createOrUpdateCommand = new CreateOrUpdateArtistCommand($request->getAttributes());
        $artist = $this->createOrUpdate->execute($createOrUpdateCommand);

        return $this->respond(CreateOrUpdateArtistResponse::convertToJson($artist));
    }

    /**
     * @OA\Get(
     *      path="/api/artist/{id}/metrics",
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
     *          @OA\JsonContent()
     *       )
     * )
     * @param Request $request
     */
    public function metrics(Request $request)
    {
    }
}
