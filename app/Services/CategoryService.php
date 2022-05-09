<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /** @return Category[] */
    public function search(array $filter = [])
    {
        $query = Category::query();
        return $query->get();
    }

    public function create(array $data): Category
    {
        $category = new Category($data);
        $category->save();

        return $category;
    }

    public function update(Category $category, array $data): Category
    {
        $category->fill($data);
        $category->save();

        return $category;
    }

    public function destroy(Category $category): bool
    {
        if ($category->notes()->count() > 0) {
            return false;
        }

        return $category->delete();
    }

    public function listOptions(): array
    {
        return Category::query()
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id')
            ->all();
    }

    public function getAllWithCount(): iterable
    {
        return Category::query()
            ->withCount('notes')
            ->orderBy('name')
            ->get();
    }
}
