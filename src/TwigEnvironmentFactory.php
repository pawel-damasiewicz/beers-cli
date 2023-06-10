<?php

namespace PaulDam\BeersCli;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigEnvironmentFactory
{
    private $cache;

    public function __construct(private array $config)
    {
        $this->cache = $config['cache'];
    }

    public function disableCompileCache(): self
    {
        $this->cache = false;

        return $this;
    }

    public function makeEnvironment(): Environment
    {
        $loader = new FilesystemLoader($this->config['templatesPath']);

        return new Environment($loader, [
            'cache' => $this->cache,
        ]);
    }
}
