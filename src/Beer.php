<?php

namespace PaulDam\BeersCli;

class Beer implements \JsonSerializable
{
    public function __construct(
        private $id,
        private $name,
        private $description,
        private $labels
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
