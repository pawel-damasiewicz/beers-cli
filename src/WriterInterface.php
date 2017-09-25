<?php namespace PaulDam\BeersCli;

interface WriterInterface
{
    public function write(string $content): void;

    public function withFilename(string $filename): WriterInterface;

    public function withStoragePath(string $path): WriterInterface;

    public function getFileName(): string;
}
