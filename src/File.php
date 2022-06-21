<?php declare(strict_types=1);

namespace Pggns\LiveAgent;

class File {
    /**
     * @var
     */
    public $path;
    /**
     * @var
     */
    public $extension;
    /**
     * @var
     */
    public $mimeType;
    /**
     * @var
     */
    public $name;

    /**
     * File constructor.
     *
     * @param string $path
     * @throws \RuntimeException
     */
    public function __construct(string $path) {
        if(file_exists($path) === false) {
            throw new \RuntimeException(sprintf('The target file is not found. Path: %s', $path));
        }

        $this->setPath($path);
        $this->initDefaultValues();
    }

    /**
     * @return File
     */
    protected function initDefaultValues(): self {
        $this->extension = pathinfo($this->getPath(), PATHINFO_EXTENSION);
        $this->mimeType = mime_content_type($this->getPath());
        $this->name = pathinfo($this->getPath(), PATHINFO_BASENAME);

        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return File
     */
    public function setPath(string $path): self {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtension(): string {
        return $this->extension;
    }

    /**
     * @param string $extension
     *
     * @return File
     */
    public function setExtension(string $extension): self {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType(): string {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     *
     * @return File
     */
    public function setMimeType(string $mimeType): self {
        $this->mimeType = $mimeType;

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
     * @return array
     */
    public function toArray(): array {
        return [
            'file' => new \CURLFile($this->getPath(), $this->getMimeType(), $this->getName()),
        ];
    }
}
