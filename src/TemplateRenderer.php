<?php

namespace PaulDam\BeersCli;

use PaulDam\BeersCli\Entity\BeerCollection;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TemplateRenderer implements BeerRendererInterface
{
    private string $template;

    public function __construct(private readonly Environment $twig)
    {
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
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
