<?php

namespace PaulDam\BeersCli\Component;

abstract class CollectionAbstract extends \ArrayIterator implements \JsonSerializable
{
    protected string $elementType = \stdClass::class;

    public function __construct(array $items, $flags = 0)
    {
        $type = $this->elementType;
        foreach ($items as $item) {
            if (!($item instanceof $type)) {
                throw new \InvalidArgumentException(sprintf(
                    '%s can only contain %s objects.',
                    get_class($this),
                    $type
                ));
            }

            parent::__construct($items, $flags);
        }
    }

    public function jsonSerialize(): array
    {
        return $this->getArrayCopy();
    }
}
