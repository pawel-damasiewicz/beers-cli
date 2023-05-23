<?php

namespace PaulDam\BeersCli\Renderer;

use PaulDam\BeersCli\Entity\BeerCollection;

interface BeerRendererInterface
{
    public function render(BeerCollection $beers): string;
}
