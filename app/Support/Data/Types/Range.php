<?php

namespace App\Support\Data\Types;

class Range
{
    private const OPERATORS = [
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
    ];

    private array $compares = [];

    public function __construct($value)
    {
        $this->normalize($value);
    }

    public function has(): bool
    {
        return count($this->compares) > 0;
    }

    public function getCompares(): array
    {
        return $this->compares;
    }

    private function normalize($value): void
    {
        if (is_array($value)) {
            foreach (self::OPERATORS as $key => $operator) {
                if (array_key_exists($key, $value)) {
                    $this->compares[$operator] = $value[$key];
                }
            }
        }
    }
}
