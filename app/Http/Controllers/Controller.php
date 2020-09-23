<?php

namespace App\Http\Controllers;

use App\Http\HttpCode;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

/**
 * @OA\Info(
 *      version="0.0.0",
 *      title="Mydly Artist Demo API",
 *      description="Features for alpha version",
 *      @OA\Contact(
 *          email="mauricio@mydly.it"
 *      )
 * )
 *
 *
 * @OA\Tag(
 *     name="Artist",
 *     description="API Endpoints of Artist"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function respond($data, $message = null)
    {
        return ResponseBuilder::asSuccess()->withData($data)->withMessage($message)->build();
    }

    public function respondWithCreated($data, $message = null)
    {
        return ResponseBuilder::asSuccess()->withData($data)->withMessage($message)
            ->withHttpCode(HttpCode::CREATED)->build();
    }

    public function respondWithNoContent($message = null)
    {
        return ResponseBuilder::asSuccess()->withMessage($message)
            ->withHttpCode(HttpCode::NO_CONTENT)->build();
    }

    public function respondWithMessage($message)
    {
        return ResponseBuilder::asSuccess()->withMessage($message)->build();
    }

    public function respondWithError($apiCode, $httpCode)
    {
        return ResponseBuilder::asError($apiCode)->withHttpCode($httpCode)->build();
    }

    public function respondBadRequest($apiCode)
    {
        return $this->respondWithError($apiCode, HttpCode::BAD_REQUEST);
    }

    public function respondUnAuthenticated($apiCode)
    {
        return $this->respondWithError($apiCode, HttpCode::UNAUTHORIZED);
    }

    public function respondNotFound($apiCode)
    {
        return $this->respondWithError($apiCode, HttpCode::NOT_FOUND);
    }
}
