<?php

namespace PaulDam\BeersCli;

abstract class LabelAbstract implements \JsonSerializable
{
    public function __construct(private $url) { }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function jsonSerialize(): array
    {
        return [
            'url' => $this->getUrl(),
        ];
    }
}
