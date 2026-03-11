<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email','password'))) {

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success','Welcome back, '.Auth::user()->name.'!');
        }

        return back()
            ->withErrors(['email'=>'Invalid email or password'])
            ->withInput();
    }

    public function index()
    {
        $totalDoctors  = Doctor::count();
        $recentDoctors = Doctor::latest()->take(5)->get();
        $citiesCount   = Doctor::distinct('city')->count('city');
        $specialities  = Doctor::distinct('speciality')->count('speciality');

        return view('admin.dashboard', compact(
            'totalDoctors',
            'recentDoctors',
            'citiesCount',
            'specialities'
        ));
    }

    public function doctors()
    {
        $doctors = Doctor::latest()->paginate(10);

        return view('admin.doctors', compact('doctors'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('success','Logged out successfully.');
    }
}
