<?php

namespace PaulDam\BeersCli;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class StorageFactory
{
    const FORMATS = [
        'json',
        'xml',
        'html',
    ];

    public function __construct(
        private readonly RendererFactory $rendererFactory,
        private readonly WriterFactory $writerFactory
    ) {
    }

    public function build($format, $storagePath): AggregateStorage|Storage
    {
        if ($format === 'all') {
            $storages = [];
            $formats = self::FORMATS;
            foreach ($formats as $format) {
                $storages[] = $this->buildStorage($format, $storagePath);
            }

            return $this->buildAggregate($storages);
        }

        return $this->buildStorage($format, $storagePath);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function buildStorage($format, $storagePath): Storage
    {
        $renderer = $this->rendererFactory->build($format);
        $writer = $this->writerFactory->build($format, $storagePath);

        return new Storage($renderer, $writer);
    }

    private function buildAggregate(array $storages): AggregateStorage
    {
        return new AggregateStorage($storages);
    }
}
