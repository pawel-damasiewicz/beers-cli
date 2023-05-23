<?php

namespace PaulDam\BeersCli;

use PaulDam\BeersCli\Entity\Beer;

class BeerCollection extends CollectionAbstract
{
    protected string $elementType = Beer::class;
}
