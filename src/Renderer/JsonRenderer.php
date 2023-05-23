<?php

namespace PaulDam\BeersCli\Renderer;

use PaulDam\BeersCli\Entity\BeerCollection;

class JsonRenderer implements BeerRendererInterface
{
    public function render(BeerCollection $beers): string
    {
        return json_encode($beers);
    }
}
