<?php

namespace PaulDam\BeersCli;

class AgregateStorage
{
    public function __construct($storages)
    {
        $this->storages = $storages;
    }

    public function save(BeerCollection $beers): void
    {
        foreach ($this->storages as $storage) {
            $storage->save($beers);
        }
    }
}
