<?php

namespace App\Http\Controllers\FrontSettings;

use App\Http\CommonList;
use Illuminate\Http\Request;
use App\Models\Package\Packages;
use App\Http\Controllers\Controller;
use App\Models\Package\PackageDetails;
use App\Models\GeneralSettings\FrontSettings\Faq;

class FaqController extends Controller
{
    public $getAllList;
    
    public function __construct(CommonList $allList){
        $this->getAllList = $allList;
    }

    public function index()
    {
        $data['faqs'] = Faq::get();
        return view('backEnd.generalSettings.faq.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $faqStore = new Faq();
            $faqStore->title = $request->title;
            $faqStore->description = $request->description;
            $faqStore->status = $request->status ?? 0;
            $faqStore->save();
            return redirect()->route('general-settings.front-settings.faq.index')->with('success', 'FAQ Created Successfully.');
        }catch (\Throwable $th) {
            dd($th);
        }
    }
  public function edit($id)
    {
        $data['faqs'] = Faq::get();
        $data['editData'] = Faq::where('uuid', $id)->first();
        if (!$data['editData']) {
             return view('backEnd.generalSettings.faq.index')->with('error', 'FAQ not found.');
            
        }
        return view('backEnd.generalSettings.faq.index', $data);
    }

    public function update(Request $request,$id)
    {
         ;
        try {
            $staff = Faq::where('uuid', $id)->firstOrFail();
            $staff->update($request->all());

            return redirect()->route('general-settings.front-settings.faq.index')->with('success', 'FAQ updated successfully.');
        } catch (Exception $e) {
            dd($e);
            return redirect()->route('general-settings.front-settings.faq.index')->with('error', 'Something Went Wrong.');
        }
    }

    public function formatData($payload){
        return [
            'id' => $payload->id,
            'title' => $payload->title,
            'description' => $payload->description,
            'status' => $payload->status == 1? 'Active' : 'Inactive',
        ];
    }

        public function delete ($id)
    {
    
        try{
            $faq = Faq::where('uuid', $id)->first();
            if ($faq) {
                $faq->delete();
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false], 400);
        } catch (Exception $e) {
            return response()->json(['success' => false], 400);
        }
    }

    public function changeStatus (Request $request)
    {
        try {
            Faq::where('uuid', $request->id)->update(['status' => $request->status]);
            return response()->json(['success' => true, 'message' => 'Faq Status Change Successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Something Went Wrong.']);
        }
    }

}
