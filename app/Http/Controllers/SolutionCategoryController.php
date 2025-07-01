<?php

namespace App\Http\Controllers;

use App\Models\SolutionCategory;
use App\Http\Requests\SolutionCategoryRequest;
use Illuminate\Http\Request;

class SolutionCategoryController extends Controller
{
    public function index()
    {
        $categories = SolutionCategory::latest()->get();
        return view('backEnd.general-settings.front-settings.solution-category.index', compact('categories'));
    }

    public function store(SolutionCategoryRequest $request)
    {
        SolutionCategory::create($request->validated());
        return redirect()->back()->with('success', 'Solution Category created successfully');
    }

    public function update(SolutionCategoryRequest $request, SolutionCategory $category)
    {
        $category->update($request->validated());
        return redirect()->back()->with('success', 'Solution Category updated successfully');
    }

    public function destroy(SolutionCategory $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Solution Category deleted successfully');
    }
}
