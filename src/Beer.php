<?php namespace PaulDam\BeersCli;

class Beer implements \JsonSerializable
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var LabelCollection $labels
     */
    private $labels;

    public function __construct($id, $name, $description, $labels)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->labels = $labels;
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'labels' => json_encode($this->getLabels()),
        ];
    }
}
