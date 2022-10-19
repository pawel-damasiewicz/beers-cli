<?php

namespace PaulDam\BeersCli;

class Storage
{
    public function __construct(
        BeerRendererInterface $renderer,
        WriterInterface $writer
    ) {
        $this->renderer = $renderer;
        $this->writer = $writer;
    }

    public function save(BeerCollection $beers)
    {
        $content = $this->renderer->render($beers);

        $this->writer->write($content);
    }
}
