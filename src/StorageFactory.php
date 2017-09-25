<?php namespace PaulDam\BeersCli;

class StorageFactory
{
    const FORMATS = [
        'json',
        'xml',
        'html',
    ];

    public function __construct(
        RendererFactory $rendererFactory,
        WriterFactory $writerFactory
    ) {
        $this->rendererFactory = $rendererFactory;
        $this->writerFactory = $writerFactory;
    }

    public function build($format, $storagePath)
    {
        if ($format === 'all') {
            $storages = [];
            $formats = self::FORMATS;
            foreach ($formats as $format) {
                $storages[] = $this->buildStorage($format, $storagePath);
            }

            return $this->buildAgregate($storages);
        }

        return $this->buildStorage($format, $storagePath);
    }

    private function buildStorage($format, $storagePath)
    {
        $renderer = $this->rendererFactory->build($format);
        $writer = $this->writerFactory->build($format, $storagePath);

        return new Storage($renderer, $writer);
    }

    private function buildAgregate(array $storages)
    {
        return new AgregateStorage($storages);
    }
}
