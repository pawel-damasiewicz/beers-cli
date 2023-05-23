<?php

namespace PaulDam\BeersCli\Component;

interface WriterInterface
{
    public function write(string $content): void;
}
