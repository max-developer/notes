<?php

namespace App\Support\Data\Types;

class Lists
{
    private array $value;

    public function __construct($value)
    {
        $this->value = $this->normalize($value);
    }

    public function has(): bool
    {
        return count($this->value) > 0;
    }

    public function getValue(): array
    {
        return $this->value;
    }

    private function normalize($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        $value = explode(',', $value);
        return array_values(array_filter($value, fn($v) => strlen($v) > 0));
    }
}



