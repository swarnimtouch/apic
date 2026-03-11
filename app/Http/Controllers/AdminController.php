<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;

class AdminController extends Controller
{
    public function login()
    {
        if (session('admin_logged_in')) {
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && \Hash::check($request->password, $user->password)) {
            session([
                'admin_logged_in' => true,
                'admin_name'      => $user->name,
                'admin_email'     => $user->email,
            ]);
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome back, ' . $user->name . '!');        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin/login');
        }

        $totalDoctors    = Doctor::count();
        $recentDoctors   = Doctor::latest()->take(5)->get();
        $citiesCount     = Doctor::distinct('city')->count('city');
        $specialities    = Doctor::distinct('speciality')->count('speciality');

        return view('admin.dashboard', compact(
            'totalDoctors',
            'recentDoctors',
            'citiesCount',
            'specialities'
        ));
    }

    public function doctors()
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin/login');
        }

        $doctors = Doctor::latest()->paginate(10);
        return view('admin.doctors', compact('doctors'));
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_name', 'admin_email']);
        return redirect('/admin/login')->with('success', 'Logged out successfully.');
    }
}
