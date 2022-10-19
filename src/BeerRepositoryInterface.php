<?php

namespace PaulDam\BeersCli;

interface BeerRepositoryInterface
{
    /**
     * Get collection of Beers.
     *
     * @return BeerCollection
     */
    public function getBeers(): BeerCollection;

    /**
     * Set filter for glasswareId.
     *
     * @param int $glasswareId
     *
     * @return BeerRepositoryInterface
     */
    public function filterByGlasswareId(int $glasswareId): BeerRepositoryInterface;
}
