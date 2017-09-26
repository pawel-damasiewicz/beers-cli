
<?php namespace PaulDam\BeersCli;

class FileWriter implements WriterInterface
{
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function write(string $content): void
    {
        if (!$handle = fopen($this->path, 'w')) {
            throw new \RuntimeException("Cannot open file '$this->path'.");
        }

        if (fwrite($handle, $content) === false) {
            throw new \RuntimeException("Cannot write to file ($path)");
        }

        fclose($handle);
    }
}
