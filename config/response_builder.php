<?php

return [
    /*
    |-----------------------------------------------------------------------------------------------------------
    | Code range settings
    |-----------------------------------------------------------------------------------------------------------
    */
    'min_code' => 100,
    'max_code' => 20024,

    /*
    |-----------------------------------------------------------------------------------------------------------
    | Error code to message mapping
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'map' => [
        \App\Http\ApiCode::INVALID_CREDENTIALS        => 'api.invalid_credentials',
        \App\Http\ApiCode::VALIDATION_ERROR           => 'api.validation_error',
        \App\Http\ApiCode::PRIZE_ALREADY_IN_REVIEW    => 'api.prize_already_in_review',
        \App\Http\ApiCode::BUSINESS_RULE_VALIDATION   => 'api.business_rule_validation'
    ],
];
