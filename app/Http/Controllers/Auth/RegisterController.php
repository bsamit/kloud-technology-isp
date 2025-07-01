<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PotentialCustomer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $otpData = $this->generateOTP();

        $pData = PotentialCustomer::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'password' => $request->password,
            'is_active' => 1,
            'otp' => $otpData,
        ]);

        $data = [
            'id' => $pData->uuid,
            'otp' => $otpData
        ];

        return view('auth.otp_page', $data);
    }
    protected function verifyCustomer(Request $request)
    {
        Validator::make($request->all(), [
            'otp' => ['required', 'number'],
        ]);

        $potentialC= PotentialCustomer::where('uuid', $request->id)->first();
        if ($potentialC->otp == $request->otp) {
            $userData = User::where('mobile', $potentialC->mobile)->OrWhere('email', $potentialC->email)->first();
            if($userData){
                return redirect('/login')->with('warning', 'Existing User , If getting any Eerror Please Contact Admin');
            }else{
                $potentialC->otp = NULL;
                $potentialC->is_active = 2;
                $potentialC->save();
                return redirect('/login')->with('success', 'OTP Verified Successfully Please Check Your Email Wait For Details');
            }
        }else{
            $data = [
                'id' => $request->id,
                'otp' => $potentialC->otp
            ];
            return view('auth.otp_page', $data)->with('warning', 'Wrong OTP');
        }
    }

    protected function validator(array $data)
    {
        $dataExists = PotentialCustomer::where('mobile', $data['mobile'])->OrWhere('email', $data['email'])->first();
        if($dataExists){
            $dataExists->delete();
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:potential_customers'],
            'mobile' => ['required', 'string', 'max:11', 'unique:potential_customers'],
            'address' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);
    }

    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    function generateOTP() {
        return sprintf("%06d", mt_rand(0, 999999));
    }
}
