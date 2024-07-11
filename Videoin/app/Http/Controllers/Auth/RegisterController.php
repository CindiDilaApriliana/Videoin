<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registrasi');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Gunakan 'name' sesuai dengan basis data
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $data['name'] = $request->name; // Gunakan 'name'
        $data['email'] = $request->email;
        $data['password'] = $request->password;

        $this->create($data);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'], // Gunakan 'name'
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'customer', // Set role directly here
        ]);
    }
}
