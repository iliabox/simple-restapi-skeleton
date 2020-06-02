<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 */
class ClassRoom
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=63)
     */
    private string $name;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isActive = true;

    protected function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = new \DateTimeImmutable();
    }

    public static function create(string $name, ?string $id = null): self
    {
        return new static($id ?: Uuid::uuid4(), $name);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function enable(): void
    {
        $this->isActive = true;
    }

    public function disable(): void
    {
        $this->isActive = false;
    }
}
