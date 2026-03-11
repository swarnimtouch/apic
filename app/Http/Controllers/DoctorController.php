<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
class DoctorController extends Controller
{
    //
    public function index(){
    return view('front.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|min:3',
            'emailAddress' => 'required|email|unique:doctors,email',
            'mobileNumber' => 'required|digits_between:10,15',
            'speciality' => 'required',
            'clinicName' => 'required',
            'city' => 'required'
        ]);

        Doctor::create([
            'name' => $request->fullName,
            'email' => $request->emailAddress,
            'phone' => $request->mobileNumber,
            'speciality' => $request->speciality,
            'hospital_name' => $request->clinicName,
            'city' => $request->city
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful'
        ]);
    }

}
