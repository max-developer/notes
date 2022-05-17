<?php

namespace App\Support\Data\Types;

use DateTimeImmutable;
use DateTimeInterface;

class Date
{
    private ?DateTimeInterface $after;
    private ?DateTimeInterface $before;

    public function __construct($value)
    {
        if (is_array($value)) {
            $this->after = $this->parse($value['after'] ?? null);
            $this->before = $this->parse($value['before'] ?? null);
        }
    }

    public function hasAfter(): bool
    {
        return !is_null($this->after);
    }

    public function hasBefore(): bool
    {
        return !is_null($this->before);
    }

    public function getAfter(): ?DateTimeInterface
    {
        return $this->after;
    }

    public function getBefore(): ?DateTimeInterface
    {
        return $this->before;
    }

    private function parse(?string $value): ?DateTimeInterface
    {
        return is_string($value) && strlen($value) > 0 ? new DateTimeImmutable($value) : null;
    }
}
