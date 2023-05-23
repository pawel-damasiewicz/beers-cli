<?php

namespace PaulDam\BeersCli\Storage;

use PaulDam\BeersCli\Renderer\RendererFactory;
use PaulDam\BeersCli\Writer\WriterFactory;
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

    public function build(string $format, string $storagePath): StorageInterface
    {
        if ($format === 'all') {

            return $this->buildAggregate($storagePath);
        }

        return $this->buildStorage($format, $storagePath);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function buildStorage(string $format, string $storagePath): Storage
    {
        $renderer = $this->rendererFactory->build($format);
        $writer = $this->writerFactory->build($format, $storagePath);

        return new Storage($renderer, $writer);
    }

    private function buildAggregate(string $storagePath): AggregateStorage
    {
        $storages = new StorageCollection([]);
        $formats = self::FORMATS;
        foreach ($formats as $format) {
            $storages->append($this->buildStorage($format, $storagePath));
        }

        return new AggregateStorage($storages);
    }
}
