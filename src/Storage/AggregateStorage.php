<?php

namespace PaulDam\BeersCli\Storage;

use PaulDam\BeersCli\Entity\BeerCollection;

class AggregateStorage
{
    public function __construct(private $storages)
    {
    }

    public function save(BeerCollection $beers): void
    {
        foreach ($this->storages as $storage) {
            $storage->save($beers);
        }
    }
}
