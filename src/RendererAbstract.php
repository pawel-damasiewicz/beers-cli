<?php namespace PaulDam\BeersCli;

abstract class RendererAbstract implements BeerRendererInterface
{
    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    abstract public function render(BeerCollection $beers): string;
}
