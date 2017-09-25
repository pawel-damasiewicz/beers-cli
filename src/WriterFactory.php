<?php namespace PaulDam\BeersCli;

class WriterFactory
{
    public function build($format, $storagePath)
    {
        return (new FileWriter())
            ->withFilename('out.' . $format)
            ->withStoragePath($storagePath);
    }
}
