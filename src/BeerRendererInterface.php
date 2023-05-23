<?php

namespace PaulDam\BeersCli;

use PaulDam\BeersCli\Entity\BeerCollection;

interface BeerRendererInterface
{
    public function render(BeerCollection $beers): string;
}
