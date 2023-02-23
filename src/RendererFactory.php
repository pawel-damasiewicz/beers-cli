<?php

namespace PaulDam\BeersCli;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class RendererFactory
{
    const FORMATS = [
        'json' => JsonRenderer::class,
        'xml'  => 'renderer.xml',
        'html' => 'renderer.html',
    ];

    public function __construct(private readonly ContainerInterface $container)
    {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function build($format)
    {
        $formats = self::FORMATS;

        if ((!isset($formats[$format]))
            || !$this->container->has($formats[$format])
        ) {
            throw new \InvalidArgumentException('Unsupported format '.$format.'.');
        }

        return $this->container->get($formats[$format]);
    }
}
