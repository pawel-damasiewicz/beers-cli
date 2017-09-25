<?php namespace PaulDam\BeersCli;

abstract class RendererAbstract implements BeerRendererInterface
{
    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    public abstract function render(BeerCollection $beers): string;
}
