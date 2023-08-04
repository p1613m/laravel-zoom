<?php

return [
    'access_token' => env('ZOOM_CLIENT_ACCESS_TOKEN'),
    'refresh_token' => env('ZOOM_CLIENT_REFRESH_TOKEN'),
    'base_url' => 'https://api.zoom.us/v2/',
    'token_life' => 60 * 60 * 24 * 7, // In seconds, default 1 week
    'authentication_method' => 'oauth2',
    'max_api_calls_per_request' => '5' // how many times can we hit the api to return results for an all() request
];
