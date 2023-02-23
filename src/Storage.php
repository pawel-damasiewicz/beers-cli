<?php

namespace PaulDam\BeersCli;

class Storage
{
    public function __construct(
        private readonly BeerRendererInterface $renderer,
        private readonly WriterInterface $writer
    ) {
    }

    public function save(BeerCollection $beers): void
    {
        $content = $this->renderer->render($beers);

        $this->writer->write($content);
    }
}
