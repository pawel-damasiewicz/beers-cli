<?php

namespace PaulDam\BeersCli\Writer;

class WriterFactory
{
    public function build($format, $storagePath): FileWriter
    {
        $path = sprintf('%s/out.%s', $storagePath, $format);

        return new FileWriter($path);
    }
}
