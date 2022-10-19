<?php

namespace PaulDam\BeersCli;

abstract class LabelAbstract implements \JsonSerializable
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function jsonSerialize()
    {
        return [
            'url' => $this->getUrl(),
        ];
    }
}
