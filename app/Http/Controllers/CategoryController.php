<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function store(CategoryRequest $request)
    {
        $newCategory = new Category();
        $newCategory->fill($request->validated());
        $newCategory->save();
        return new CategoryResource($newCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //todo
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $categoryId
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $categoryId)
    {
        $updateCategory = Category::find($categoryId);
        if (!$updateCategory) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
        $updateCategory->fill($request->validated());
        $updateCategory->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $categoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryId)
    {
        $updateCategory = Category::find($categoryId);
        if (!$updateCategory) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
        $updateCategory->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
