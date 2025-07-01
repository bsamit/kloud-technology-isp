<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use App\Models\SolutionCategory;
use App\Http\Requests\SolutionRequest;
use Illuminate\Support\Facades\Storage;

class SolutionController extends Controller
{
    public function index()
    {
        $solutions = Solution::with('category')->latest()->get();
        $categories = SolutionCategory::where('status', true)->get();
        return view('backEnd.general-settings.front-settings.solution.index', compact('solutions', 'categories'));
    }

    public function store(SolutionRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/solutions'), $imageName);
            $data['image'] = 'uploads/solutions/' . $imageName;
        }

        Solution::create($data);
        
        return redirect()->back()->with('success', 'Solution created successfully');
    }

    public function update(SolutionRequest $request, Solution $solution)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($solution->image && file_exists(public_path($solution->image))) {
                unlink(public_path($solution->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/solutions'), $imageName);
            $data['image'] = 'uploads/solutions/' . $imageName;
        }

        $solution->update($data);
        
        return redirect()->back()->with('success', 'Solution updated successfully');
    }

    public function destroy(Solution $solution)
    {
        if ($solution->image && file_exists(public_path($solution->image))) {
            unlink(public_path($solution->image));
        }
        
        $solution->delete();
        return redirect()->back()->with('success', 'Solution deleted successfully');
    }
}
