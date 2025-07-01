<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\CommonList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Helpdesk\HelpdeskCategory;

class HelpdeskCategoryController extends Controller
{
    public $getAllList;

    public function __construct(CommonList $allList){
        $this->getAllList = $allList;
    }

    public function index()
    {
        $data['helpdesk_categories'] = HelpdeskCategory::get(['id', 'helpdesk_category_name', 'status']);
        return view('backEnd.helpdesk.helpdesk_category.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'helpdesk_category_name' => 'required|string|max:50',
            ]);
            $helpdesk_category = new HelpdeskCategory();
            $helpdesk_category->helpdesk_category_name = $request->helpdesk_category_name;
            $helpdesk_category->save();
            
            return redirect()->route('helpdesk.helpdesk-categories.index')->with('success', 'Helpdesk Category Created Successfully.');
        }catch (Exception $e) {
            return redirect()->route('helpdesk.helpdesk-categories.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function edit(string $id)
    {
        $data['helpdesk_categories'] = HelpdeskCategory::get(['id', 'helpdesk_category_name', 'status']);
        $data['editData'] = HelpdeskCategory::find($id);
        return view('backEnd.helpdesk.helpdesk_category.index', $data);
    }

    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'helpdesk_category_name' => 'required|string|max:50',
            ]);
            $helpdesk_category = HelpdeskCategory::find($id);
            $helpdesk_category->helpdesk_category_name = $request->helpdesk_category_name;
            $helpdesk_category->update();

            return redirect()->route('helpdesk.helpdesk-categories.index')->with('success', 'Helpdesk Category Updated Successfully.');
        }catch (Exception $e) {
            return redirect()->route('helpdesk.helpdesk-categories.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $helpdesk_category = HelpdeskCategory::where('id', $request->id)->first();
            $helpdesk_category->delete();
            return response()->json(['success' => true, 'message' => 'Helpdesk Category Deleted Successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Something Went Wrong.']);
        }
    }

    public function changeStatus (Request $request)
    {
        try {
            HelpdeskCategory::where('id', $request->id)->update(['status' => $request->status]);
            return response()->json(['success' => true, 'message' => 'Helpdesk Category Change Successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something Went Wrong.']);
        }
    }
}
