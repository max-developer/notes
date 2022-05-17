<?php

namespace App\Support\Data;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class Normalizer
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function make(array $data): self
    {
        return new static($data);
    }

    public function belongToMany(Builder $query, string $key): self
    {
        if ($this->exists($key)) {
            $modelKey = $query->getModel()->getKeyName();
            $records = $this->normalizeBelongToMany($this->data[$key], $modelKey);

            $models = $query->findMany(array_keys($records));
            $modelKeys = $models->pluck($modelKey)->all();

            $this->data[$key] = Arr::only($records, $modelKeys);
        }
        return $this;
    }

    public function belongTo(Builder $query, string $key): self
    {
        if ($this->exists($key)) {
            $model = $query->find($this->data[$key]);
            $this->data[$key] = $model ? $model->getKey() : null;
        }
        return $this;
    }

    public function all(): array
    {
        return $this->data;
    }

    protected function exists(string $key): bool
    {
        return array_key_exists($key, $this->data) && !is_null($this->data[$key]);
    }

    private function normalizeBelongToMany(array $data, string $keyName): array
    {
        if (array_is_list($data)) {
            if (is_array($data[0])) {
                return array_column($data, null, $keyName);
            } else {
                return array_fill_keys($data, []);
            }
        }
        return $data;
    }
}
