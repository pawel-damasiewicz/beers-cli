<?php namespace PaulDam\BeersCli;

class RendererFactory
{
    const FORMATS = [
        'json' => JsonRenderer::class,
        'xml' => 'renderer.xml',
        'html' => 'renderer.html',
    ];

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function build($format)
    {
        $formats = self::FORMATS;

        if ((!isset($formats[$format]))
            || !$this->container->has($formats[$format])
        ) {
            throw new \InvalidArgumentException('Unsupported format ' . $format . '.');
        }

        return $this->container->get($formats[$format]);
    }
}
