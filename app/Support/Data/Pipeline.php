<?php

namespace App\Support\Data;

class Pipeline
{
    private array $callbacks;

    public function __construct(callable ...$callbacks)
    {
        $this->callbacks = $callbacks;
    }

    public function pipe(callable $callback): self
    {
        $this->callbacks[] = $callback;
        return $this;
    }

    public function process(): void
    {
        foreach ($this->callbacks as $callback) {
            $callback(...func_get_args());
        }
    }

    public function __invoke(): void
    {
        $this->process(...func_get_args());
    }
}
