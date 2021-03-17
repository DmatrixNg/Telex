<?php

return [

    'telex' => [
        'id' => env('TELEX_ORGANIZATION_ID'),
        'key' => env('TELEX_ORGANIZATION_KEY'),
        'from' => env('TELEX_FROM','Telex'),
        'email' => env('TELEX_EMAIL'),
        'template' => env('TELEX_TEMPLATE_ID'),
        'placeholders' => env('TELEX_PLACEHOLDER_ID'),
        'type' => env('TELEX_PROVIDER_TYPE','email'),
        'endpoint' => env('TELEX_ENDPOINT','https://telex.im/api/send-message'),
    ],

];
