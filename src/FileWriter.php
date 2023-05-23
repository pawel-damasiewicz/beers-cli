<?php

namespace PaulDam\BeersCli;

use RuntimeException;
use PaulDam\BeersCli\Component\WriterInterface;

/**
 * @TODO: Replace STD function calls to OOP
 */
class FileWriter implements WriterInterface
{
    public function __construct(private readonly string $path)
    {
    }

    public function write(string $content): void
    {
        if (!$handle = fopen($this->path, 'w')) {
            throw new RuntimeException("Cannot open file '$this->path'.");
        }

        if (fwrite($handle, $content) === false) {
            throw new RuntimeException("Cannot write to file ($this->path)");
        }

        fclose($handle);
    }
}
