<?php

namespace PaulDam\BeersCli;

class LabelFactory
{
    const LABEL_LARGE = 'large';

    const LABEL_TYPES = [
        self::LABEL_LARGE => LargeLabel::class,
    ];

    public function build($name, $url)
    {
        $types = self::LABEL_TYPES;

        if (isset($types[$name])) {
            $class = $types[$name];

            return new $class($url);
        }

        throw new \Exception('Unsupported label type.');
    }
}
