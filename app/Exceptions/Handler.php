<?php

namespace App\Exceptions;

use App\Http\ApiCode;
use App\Http\HttpCode;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof BusinessRuleValidation) {
            return $this->respondWithBusinessValidation($exception);
        }

        if ($exception instanceof ValidationException) {
            return $this->respondWithValidationError($exception);
        }

        return parent::render($request, $exception);
    }

    private function respondWithValidationError(Throwable $exception)
    {
        return ResponseBuilder::asError(ApiCode::VALIDATION_ERROR)
            ->withData($exception->errors())
            ->withHttpCode(HttpCode::UNPROCESSABLE_ENTITY)
            ->build();
    }

    private function respondWithBusinessValidation(Throwable $exception)
    {
        return ResponseBuilder::asError(ApiCode::BUSINESS_RULE_VALIDATION)
            ->withData($exception->errors())
            ->withHttpCode(HttpCode::INTERNAL_SERVER_ERROR)
            ->build();
    }
}
