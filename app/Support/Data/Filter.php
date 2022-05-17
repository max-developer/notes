<?php

namespace App\Support\Data;

use App\Support\Data\Types\Date;
use App\Support\Data\Types\Lists;
use App\Support\Data\Types\Range;
use App\Support\Data\Types\Search;
use Illuminate\Database\Eloquent\Builder;

class Filter
{
    private Builder $query;
    private array $data;

    public function __construct(Builder $query, array $data)
    {
        $this->query = $query;
        $this->data = $data;
    }

    public static function make(Builder $query, array $data): self
    {
        return new static($query, $data);
    }

    public function eq(string $column): self
    {
        return $this->compare($column, '=');
    }

    public function lt(string $column): self
    {
        return $this->compare($column, '<');
    }

    public function gt(string $column): self
    {
        return $this->compare($column, '>');
    }

    public function lte(string $column): self
    {
        return $this->compare($column, '<=');
    }

    public function gte(string $column): self
    {
        return $this->compare($column, '>=');
    }

    public function ne(string $column): self
    {
        return $this->compare($column, '<>');
    }

    public function date(string $column): self
    {
        $date = $this->makeType($column, Date::class);

        if ($date->hasAfter()) {
            $this->query = $this->query->whereDate($column, '>=', $date->getAfter());
        }
        if ($date->hasBefore()) {
            $this->query = $this->query->whereDate($column, '<=', $date->getBefore());
        }
        return $this;
    }

    public function in(string $column): self
    {
        $lists = $this->makeType($column, Lists::class);

        if ($lists->has()) {
            $this->query = $this->query->whereIn($column, $lists->getValue());
        }
        return $this;
    }

    public function search(string $parameter, string ...$columns): self
    {
        $value = $this->makeType($parameter, Search::class);

        if ($value->has()) {
            if (count($columns) === 0) {
                $columns = [$parameter];
            }

            $search = implode('%', $value->getWords());

            $this->query = $this->query->where(function (Builder $query) use ($columns, $search) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }
        return $this;
    }

    public function range(string $column): self
    {
        $range = $this->makeType($column, Range::class);

        if ($range->has()) {
            $this->query = $this->query->where(function (Builder $query) use ($column, $range) {
                foreach ($range->getCompares() as $operator => $value) {
                    $query->where($column, $operator, $value);
                }
            });
        }
        return $this;
    }

    public function custom(string $column, callable $callback): self
    {
        $value = $this->get($column);

        if ($value) {
            $result = $callback($this->query, $value);
            if ($result instanceof Builder) {
                $this->query = $result;
            }
        }

        return $this;
    }

    public function order(string $column, string $defaultDirection = null, $parameter = 'order'): self
    {
        $direction = $this->data[$parameter][$column] ?? $defaultDirection;

        if (in_array(strtolower($direction), ['asc', 'desc'])) {
            $this->query = $this->query->orderBy($column, $direction);
        }

        return $this;
    }

    protected function compare(string $column, string $operator): self
    {
        $value = $this->get($column);

        if (!is_null($value) || (is_string($value) && mb_strlen($value) > 0)) {
            $this->query = $this->query->where($column, $operator, $value);
        }

        return $this;
    }

    public function getQuery(): Builder
    {
        return $this->query;
    }

    /**
     * @template T
     * @param string $parameter
     * @param class-string<T> $type
     * @return T
     */
    protected function makeType(string $parameter, string $type)
    {
        return new $type($this->get($parameter));
    }

    protected function get(string $parameter)
    {
        return $this->data[$parameter] ?? null;
    }
}
