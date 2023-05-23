<?php

namespace PaulDam\BeersCli\Storage;

use PaulDam\BeersCli\Entity\BeerCollection;

class AggregateStorage implements StorageInterface
{
    public function __construct(private StorageCollection $storages)
    {
    }

    public function save(BeerCollection $beers): void
    {
        foreach ($this->storages as $storage) {
            $storage->save($beers);
        }
    }
}
