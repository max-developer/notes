<?php

namespace App\Support\Data;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Throwable;

class Writer
{
    /**
     * @return mixed
     */
    public function write(Model $model, array $data): Model
    {
        $model->fill($data);

        $relations = Arr::except($data, $model->getFillable());
        [$before, $after] = [new Pipeline(), new Pipeline()];

        foreach ($relations as $name => $relData) {
            if (Str::endsWith($name, '_id')) {
                $name = Str::replaceLast('_id', '', $name);
                $name = Str::camel($name);
            }

            if (!$model->isRelation($name)) {
                continue;
            }

            $relation = $model->$name();

            if ($relation instanceof BelongsTo) {
                $before->pipe(fn() => $relation->associate($relData));
                continue;
            }

            if ($relation instanceof BelongsToMany) {
                $after->pipe(fn() => $relation->sync($relData));
            }
        }

        $pipeline = new Pipeline($before, fn() => $model->save(), $after);
        $pipeline->process();

        return $model;
    }

    /**
     * @throws Throwable
     * @return mixed
     */
    public function transactionWrite(Model $model, array $data): Model
    {
        return $model->getConnection()
            ->transaction(fn() => $this->write($model, $data));
    }
}
