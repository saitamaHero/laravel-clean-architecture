<?php

namespace App\Core\Modules\Domain\Entities;

class Module
{
    /**
     * Minimum slug length
     */
    const MIN_SLUG_LEN = 3;

    /**
     * @var string
     */
    private string $slug;

    /**
     * @var string
     */
    private string $label;

    /**
     * @var string
     */
    private string $singularLabel;

    /**
     * @var array<int,Field>
     */
    private array $fields;

    public function __construct(string $slug, string $label, string $singularLabel)
    {
        $this->setSlug($slug);

        $this->label = $label;
        $this->singularLabel = $singularLabel;
        $this->fields = [];
    }

    protected function setSlug(string $slug) {
        if (empty($slug) || strlen($slug) < self::MIN_SLUG_LEN) {
            throw new \Exception("Slug is to short", 1);
        }

        $this->slug = $slug;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getSingularLabel(): string
    {
        return $this->singularLabel;
    }

    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }
}
