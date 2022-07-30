<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store():JsonResponse
    {
        $attributes = $this->validateCategory();
        $category = Category::create($attributes);

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function update($id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $attributes = $this->validateCategory();
        $category->update($attributes);

        return response()->json('Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json('Category deleted successfully');

    }

    protected function validateCategory(): array {
        return request()->validate([
            'name' => ['required','string']
        ]);
    }
}
