<?php

namespace PaulDam\BeersCli\Storage;

use PaulDam\BeersCli\Entity\BeerCollection;

interface StorageInterface
{
    public function save(BeerCollection $beers): void;
}
