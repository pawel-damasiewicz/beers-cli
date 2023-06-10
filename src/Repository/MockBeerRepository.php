<?php

namespace PaulDam\BeersCli\Repository;

use PaulDam\BeersCli\Entity\BeerCollection;
use PaulDam\BeersCli\Entity\BeerCollectionBuilder;
use Symfony\Component\Yaml\Yaml;

class MockBeerRepository implements BeerRepositoryInterface
{
    public function __construct(private readonly BeerCollectionBuilder $builder)
    {
    }

    public function getBeers(): BeerCollection
    {
        $data = Yaml::parseFile(__DIR__.'/../../storage/mocks/mockData.yaml');

        return $this->builder->fromData($data);
    }

    public function filterByGlasswareId(int $glasswareId): BeerRepositoryInterface
    {
        return $this;
    }
}
