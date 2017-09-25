<?php namespace PaulDam\BeersCli;

interface BeerRendererInterface
{
    public function render(BeerCollection $beers): string;
}
