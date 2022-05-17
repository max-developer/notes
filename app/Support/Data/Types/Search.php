<?php

namespace App\Support\Data\Types;

class Search
{
    private array $words;

    public function __construct(?string $value)
    {
        $this->words = $this->parse($value);
    }

    public function getWords(): array
    {
        return $this->words;
    }

    public function has(): bool
    {
        return count($this->words) > 0;
    }

    private function parse(?string $value): array
    {
        $parsed = explode(' ', $value);
        $parsed = array_map('trim', $parsed);
        return array_filter($parsed, fn($v) => strlen($v) > 0);
    }
}
