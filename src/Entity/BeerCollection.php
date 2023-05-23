<?php

namespace PaulDam\BeersCli\Entity;

use PaulDam\BeersCli\Component\CollectionAbstract;

class BeerCollection extends CollectionAbstract
{
    protected string $elementType = Beer::class;
}
