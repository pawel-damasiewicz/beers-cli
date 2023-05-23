<?php

namespace PaulDam\BeersCli\Entity;

use PaulDam\BeersCli\Value\LabelCollection;

class Beer implements \JsonSerializable
{
    public function __construct(
        private string $id,
        private string $name,
        private string $description,
        private LabelCollection $labels
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLabels(): LabelCollection
    {
        return $this->labels;
    }

    public function equals(Beer $other): bool
    {
        return $this->getId() === $other->getId();
    }

    public function jsonSerialize(): array
    {
        return [
            'id'          => $this->getId(),
            'name'        => $this->getName(),
            'description' => $this->getDescription(),
            'labels'      => json_encode($this->getLabels()),
        ];
    }
}
