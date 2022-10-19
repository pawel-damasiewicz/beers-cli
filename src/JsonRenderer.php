<?php

namespace PaulDam\BeersCli;

class JsonRenderer implements BeerRendererInterface
{
    public function render(BeerCollection $beers): string
    {
        return json_encode($beers);
    }
}
