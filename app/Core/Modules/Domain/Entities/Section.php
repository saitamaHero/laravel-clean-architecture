<?php

namespace App\Core\Modules\Domain\Entities;

class Section
{
    const FIELD_TYPE = 'fields';

    const CUSTOM_TYPE = 'custom';

    /**
     * @var string
     */
    private string $type;

    /**
     * @var string
     */
    private ?string $id;

    /**
     * @var string
     */
    private ?string $name;

    /**
     * @var string|null
     */
    private ?string $label;

    /**
     * @var array<int, $fields>
     */
    private array $fields;

    // private $options;

    public function __construct(string $name, ?string $label = null, ?string $id = null, array $fields = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->fields = $fields;
        $this->type = self::FIELD_TYPE; // let this to be fields type section
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
