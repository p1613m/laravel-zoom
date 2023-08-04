<?php

namespace MacsiDigital\Zoom\Support;

use MacsiDigital\API\Support\Authentication\JWT;
use MacsiDigital\API\Support\Entry as ApiEntry;
use MacsiDigital\Zoom\Facades\Client;

class Entry extends ApiEntry
{
    protected $modelNamespace = '\MacsiDigital\Zoom\\';

    protected $pageField = 'page_number';

    protected $maxQueries = '5';

    protected $apiKey = null;

    protected $apiSecret = null;

    protected $tokenLife = null;

    protected $baseUrl = null;

    // Amount of pagination results per page by default, leave blank if should not paginate
    // Without pagination rate limits could be hit
    protected $defaultPaginationRecords = '30';

    // Max and Min pagination records per page, will vary by API server
    protected $maxPaginationRecords = '300';

    protected $resultsPageField = 'page_number';
    protected $resultsTotalPagesField = 'page_count';
    protected $resultsPageSizeField = 'page_size';
    protected $resultsTotalRecordsField = 'total_records';

    protected $allowedOperands = ['='];

    /**
     * Entry constructor.
     * @param $apiKey
     * @param $apiSecret
     * @param $tokenLife
     * @param $maxQueries
     * @param $baseUrl
     */
    public function __construct($accessToken = null, $refreshToken = null, $tokenLife = null, $maxQueries = null, $baseUrl = null)
    {
        $this->apiKey = $accessToken ?? config('zoom.access_token');
        $this->apiSecret = $refreshToken ??  config('zoom.refresh_token');
        $this->tokenLife = $tokenLife ??  config('zoom.token_life');
        $this->maxQueries = $maxQueries ?? (config('zoom.max_api_calls_per_request') ? config('zoom.max_api_calls_per_request') : $this->maxQueries);
        $this->baseUrl = $baseUrl ?? config('zoom.base_url');
    }

    public function newRequest()
    {
        return Client::baseUrl($this->baseUrl)->withToken($this->apiKey);
    }
}
