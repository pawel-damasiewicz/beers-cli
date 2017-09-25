<?php namespace PaulDam\BeersCli;

class FileWriter implements WriterInterface
{
    public function write(string $content): void
    {
        $filename = $this->getFileName();

        if (!$handle = fopen($filename, 'w')) {
            throw new \RuntimeException("Cannot open file '$filename'.");
        }

        if (fwrite($handle, $content) === false) {
            throw new \RuntimeException("Cannot write to file ($filename)");
        }

        fclose($handle);
    }

    public function withFilename(string $filename): WriterInterface
    {
        $copy = clone $this;
        $copy->filename = $filename;

        return $copy;
    }

    public function withStoragePath(string $path): WriterInterface
    {
        $copy = clone $this;
        $copy->path = $path;

        return $copy;
    }

    public function getFileName(): string
    {
        return $this->path . '/' . $this->filename;
    }
}
