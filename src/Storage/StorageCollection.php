<?php

namespace PaulDam\BeersCli\Storage;

use PaulDam\BeersCli\Component\CollectionAbstract;

class StorageCollection extends CollectionAbstract
{
    protected string $elementType = StorageInterface::class;
}