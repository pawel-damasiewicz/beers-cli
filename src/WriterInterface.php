<?php namespace PaulDam\BeersCli;

interface WriterInterface
{
    public function write(string $content): void;
}
