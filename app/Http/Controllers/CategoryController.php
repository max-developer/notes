<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public const ROUTE_INDEX = 'categories.index';

    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->search();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        $category = new Category();
        return view('category.create', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $this->categoryService->create($data);

        $request->session()->flash('success', 'Category created');

        return redirect()->route(self::ROUTE_INDEX);
    }

    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $this->categoryService->update($category, $data);

        $request->session()->flash('success', 'Category updated');

        return redirect()->route(self::ROUTE_INDEX);
    }

    public function destroy(Request $request, Category $category)
    {
        $deleted = $this->categoryService->destroy($category);

        if ($deleted) {
            $request->session()->flash('success', 'Category deleted');
        } else {
            $request->session()->flash('failed', 'Category delete failed');
        }

        return redirect()->route(self::ROUTE_INDEX);
    }
}
