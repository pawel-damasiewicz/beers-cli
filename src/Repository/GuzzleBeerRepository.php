<?php

namespace PaulDam\BeersCli\Repository;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PaulDam\BeersCli\Entity\BeerCollection;
use PaulDam\BeersCli\Entity\BeerCollectionBuilder as Builder;

class GuzzleBeerRepository implements BeerRepositoryInterface
{
    public function __construct(
        private readonly Client $httpClient,
        private readonly Builder $builder,
        private array $config = []
    ) {
        $defaultConfig = [
            'request_options' => [
                'query' => [
                    'glasswareId' => [],
                ],
            ],
        ];

        $this->config = array_replace_recursive($defaultConfig, $config);
    }

    /**
     * @throws GuzzleException
     */
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
