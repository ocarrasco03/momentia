<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    */

    'paths' => ['api/*', 'up', 'sanctum/csrf-cookie'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Methods
    |--------------------------------------------------------------------------
    | Here you may specify the HTTP methods that are allowed for cross-origin
    | requests. You can use ['*'] to allow all methods.
    |
    */

    'allowed_methods' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins
    |--------------------------------------------------------------------------
    | Here you may specify the origins that are allowed to make cross-origin
    | requests. You can use ['*'] to allow all origins. Origin patterns can
    | also be specified. E.g.: ['*.mydomain.com', 'localhost:3000'].
    |
    */

    'allowed_origins' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origin Patterns
    |--------------------------------------------------------------------------
    | Here you may specify origin patterns that are allowed to make cross-origin
    | requests. This is useful when you want to allow subdomains or specific
    | patterns. E.g.: ['*.mydomain.com', 'localhost:3000'].
    |
    */

    'allowed_origins_patterns' => [],

    /*
    |--------------------------------------------------------------------------
    | Allowed Headers
    |--------------------------------------------------------------------------
    | Here you may specify the headers that are allowed for cross-origin
    | requests. You can use ['*'] to allow all headers.
    |
    */

    'allowed_headers' => [
        'Content-Type',
        'X-Requested-With',
        'Authorization',
        'Accept',
        'Origin',
    ],

    /*
    |--------------------------------------------------------------------------
    | Exposed Headers
    |--------------------------------------------------------------------------
    | Here you may specify the headers that are exposed to the browser.
    |
    */

    'exposed_headers' => [],

    /*
    |--------------------------------------------------------------------------
    | Max Age
    |--------------------------------------------------------------------------
    | Here you may specify how long the results of a preflight request can be
    | cached by the browser.
    |
    */

    'max_age' => 0,

    /*
    |--------------------------------------------------------------------------
    | Supports Credentials
    |--------------------------------------------------------------------------
    | Here you may specify whether or not the response to the request can be
    | exposed when the credentials flag is true. When used as part of a
    | response to a preflight request, this indicates whether or not the
    | actual request can be made using credentials.
    |
    */

    'supports_credentials' => true,
    
];
