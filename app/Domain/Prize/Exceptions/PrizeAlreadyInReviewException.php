<?php


namespace App\Domain\Prize\Exceptions;


use App\Exceptions\BusinessRuleValidation;
use App\Http\ApiCode;


class PrizeAlreadyInReviewException extends \Exception
{
    public function validationException()
    {
        return BusinessRuleValidation::withMessages([
            ApiCode::PRIZE_ALREADY_IN_REVIEW => trans('api.prize_already_in_review')
        ]);
    }
}
