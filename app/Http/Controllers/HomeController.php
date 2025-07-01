<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\GeneralSettings\FrontSettings\Faq;
use App\Models\GeneralSettings\FrontSettings\Service;
use App\Models\Package\Packages;
use App\Models\Solution;
use App\Models\SolutionCategory;
use Illuminate\Http\Request;
class HomeController extends Controller
{

    public function welcomePage()
    {
        $data['services'] = Service::where('status', 1)->get();
        return view('frontend.home_content', $data);
    }
    public function index()
    {
        return view('backEnd.content.dashboard_content');
    }

    public function component()
    {
        return view('backEnd.content.component_content');
    }

    public function aboutUs()
    {
        return view('frontend.about_us_content');
    }
    public function package()
    {
        $data['packages'] = Packages::with('packageDetails')->where('status', 1)->get();
        return view('frontend.package_content', $data);
    }

    public function solution()
    {
        $data['solutionCat'] = SolutionCategory::with('solutions')->where('status', 1)->get();
        return view('frontend.solution_content', $data);
    }

    public function faq()
    {
        $data['faqs'] = Faq::where('status', 1)->get();
        return view('frontend.faq_content', $data);
    }

    public function contact()
    {
        return view('frontend.contact_content');
    }
    public function services()
    {
        $data['services'] = Service::where('status', 1)->get();
        return view('frontend.services_content', $data);
    }
    public function serviceDetails($id)
    {
        $data['service'] = Service::with('serviceDetails')->where('uuid', $id)->first();
        return view('frontend.service_details_content', $data);
    }
     public function contactStore( Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);
        $contact = Contact::create($validatedData);
        return redirect()->route('contact')->with('success', 'Your message has been sent successfully.');
    }
}
