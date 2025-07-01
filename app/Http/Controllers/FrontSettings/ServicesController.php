<?php
namespace App\Http\Controllers\FrontSettings;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FrontSettings\ServiceDetails;
use App\Models\GeneralSettings\FrontSettings\Service;
use App\Traits\FileUploadTrait;

class ServicesController extends Controller
{
    use FileUploadTrait;

    public $baseRoute = 'general-settings.front-settings.services.index';
    protected $imagePath = 'images/uploads/services';

    public function contact()
    {
        $data['contacts'] = Contact::get();
        return view('backEnd.generalSettings.contact', $data);
    }
     public function index()
    {
        $data['services'] = Service::with('serviceDetails')->get();
        return view('backEnd.generalSettings.services.index', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $request->merge(['image_file' => $this->uploadFile($request->file('image'), $this->imagePath)]);
            }

            $storeData = Service::create($this->formatData($request));

            foreach (gv($request, 'attributes') as $key => $value) {
                $serviceDetails = new ServiceDetails();
                $serviceDetails->service_id = $storeData->id;
                $serviceDetails->title = gv($value, 'name');
                $serviceDetails->description = gv($value, 'value');
                $serviceDetails->save();
            }

            return redirect()->route($this->baseRoute)->with('success', 'Services Created Successfully.');
        } catch (\Throwable $th) {
            return redirect()->route($this->baseRoute)->with('error', 'Something Went Wrong.');
        }
    }

    public function edit($id)
    {
        try {
            $data['editData'] = Service::with('serviceDetails')->where('uuid', $id)->first();
            if($data['editData']){
                $data['services'] = Service::with('serviceDetails')->get();
                return view('backEnd.generalSettings.services.index', $data);
            }else{
                return redirect()->route($this->baseRoute)->with('warning', 'Services Not Found.');
            }
        }catch (\Throwable $th) {
            return redirect()->route($this->baseRoute)->with('error', 'Something Went Wrong.');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $data = Service::where('uuid', $id)->first();
            if ($data) {
                if ($request->hasFile('image')) {
                    $request->merge(['image_file' => $this->updateFile($request->file('image'), $data->image, $this->imagePath)]);
                }
            
                $data->update($this->formatData($request));
            
                $existingDetails = ServiceDetails::where('service_id', $data->id)
                    ->pluck('id', 'title')
                    ->toArray();
            
                foreach (gv($request, 'attributes') as $key => $value) {
                    $title = gv($value, 'name');
                    $description = gv($value, 'value');
            
                    if (isset($existingDetails[$title])) {
                        ServiceDetails::where('id', $existingDetails[$title])
                            ->update([
                                'description' => $description
                            ]);
                        unset($existingDetails[$title]);
                    } else {
                        ServiceDetails::create([
                            'service_id' => $data->id,
                            'title' => $title,
                            'description' => $description
                        ]);
                    }
                }
                if (!empty($existingDetails)) {
                    ServiceDetails::whereIn('id', array_values($existingDetails))->delete();
                }
                return redirect()->route($this->baseRoute)->with('success', 'Services Updated Successfully.');
            } else {
                return redirect()->route($this->baseRoute)->with('warning', 'Services Not Found.');
            }
        } catch (\Throwable $th) {
            return redirect()->route($this->baseRoute)->with('error', 'Something Went Wrong.');
        }
    }

    public function delete(Request $request)
    {
        try {
            $service = Service::with('serviceDetails')->where('uuid', $request->id)->first();
            
            if ($service) {
                // Delete the image file if it exists
                if ($service->image && file_exists(public_path($service->image))) {
                    unlink(public_path($service->image));
                }

                // Delete all related service details
                ServiceDetails::where('service_id', $service->id)->delete();

                // Delete the service
                $service->delete();

                return response()->json(['success' => true, 'message' => 'Services Deleted Successfully.']);
            }

            return response()->json(['error' => true, 'message' => 'Service not found.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Something Went Wrong.']);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            Service::where('uuid', $request->id)->update(['status' => $request->status]);
            return response()->json(['success' => true, 'message' => 'Services Status Update Successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Something Went Wrong.']);
        }
    }

    protected function formatData($request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 1,
        ];

        // Only update image if a new one is uploaded
        if ($request->has('image_file')) {
            $data['image'] = $request->image_file;
        }

        return $data;
    }
}
