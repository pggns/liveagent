<?php declare(strict_types=1);

namespace Pggns\LiveAgent;

class Tag {
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $color;

    /**
     * @var string
     */
    public $background_color;

    /**
     * @var bool
     */
    public $is_public = true;

    /**
     * File constructor.
     *
     * @param string $name
     * @throws \RuntimeException
     */
    public function __construct(string $name) {
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return File
     */
    public function setId(string $id): self {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return File
     */
    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor(): string {
        return $this->color;
    }

    /**
     * @param string $color
     *
     * @return File
     */
    public function setColor(string $color): self {
        $this->color = $color;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string {
        return $this->background_color;
    }

    /**
     * @param string $background_color
     *
     * @return File
     */
    public function setBackgroundColor(string $background_color): self {
        $this->background_color = $background_color;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsPublic(): bool {
        return $this->is_public;
    }

    /**
     * @param string $is_public
     *
     * @return File
     */
    public function setIsPublic(bool $is_public): self {
        $this->is_public = $is_public;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array {
        $data = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'color' => $this->getColor(),
            'background_color' => $this->getBackgroundColor(),
            'is_public' => $this->getIsPublic() ? 'Y' : 'N',
        ];

        return $data;
    }
}
