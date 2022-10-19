<?php

namespace PaulDam\BeersCli;

use Twig_Environment;

class TemplateRenderer implements BeerRendererInterface
{
    public function __construct(
        Twig_Environment $twig
    ) {
        $this->twig = $twig;
    }

    public function render(BeerCollection $beers): string
    {
        $template = $this->twig->load($this->template);

        return $template->render(['beers' => $beers]);
    }

    public function withTemplate(string $template): BeerRendererInterface
    {
        $copy = clone $this;
        $copy->template = $template;

        return $copy;
    }
}
