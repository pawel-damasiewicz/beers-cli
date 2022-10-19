<?php

namespace PaulDam\BeersCli;

use GuzzleHttp\Client;
use PaulDam\BeersCli\BeerCollectionBuilder as Builder;

class GuzzleBeerRepository implements BeerRepositoryInterface
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var array
     */
    private $config = [
        'request_options' => [
            'query' => [
                'glasswareId' => [],
            ],
        ],
    ];

    /**
     * Inject http client as collaborator and config.
     *
     * @param Client $httpClient
     * @param array  $config
     */
    public function __construct(
        Client $httpClient,
        Builder $builder,
        array $config = []
    ) {
        $this->httpClient = $httpClient;
        $this->builder = $builder;
        $this->config = array_replace_recursive($this->config, $config);
    }

    public function getBeers(): BeerCollection
    {
        $response = $this->httpClient->request(
            'GET',
            'beers',
            $this->config['request_options']
        );

        $data = json_decode($response->getBody()->getContents(), true);

        return $this->builder->fromData($data);
    }

    public function filterByGlasswareId(int $glasswareId): BeerRepositoryInterface
    {
        $glasswareIds = $this->config['request_options']['query']['glasswareId'];
        $glasswareIds[] = $glasswareId;

        $this->config['request_options']['query']['glasswareId'] = $glasswareIds;

        return $this;
    }
}
