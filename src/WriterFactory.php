<?php

namespace PaulDam\BeersCli;

class WriterFactory
{
    public function build($format, $storagePath)
    {
        $path = sprintf('%s/out.%s', $storagePath, $format);

        return new FileWriter($path);
    }
}
