<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customers;

class CustomersController extends Controller
{
    // Menampilkan daftar customer dan admin
    public function index()
    {
        $users = User::all();
        return view('admin.customers.index', compact('users'));
    }

    // Menampilkan form untuk menambah customer/admin
    public function tambah()
    {
        return view('admin.customers.tambah');
    }

    // Menyimpan data customer/admin baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit customer/admin
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.customers.edit', compact('user'));
    }

    // Mengupdate data customer/admin
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.customers.index')->with('success', 'Data berhasil diupdate.');
    }


    public function hapus($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }

    public function updateAksesVideo(Request $request, $id)
    {
        $customer = Customers::findOrFail($id);
        $customer->aksesvideo = $request->input('aksesvideo');
        $customer->save();

        return redirect()->route('admin.customers.index')->with('success', 'Video access updated successfully.');
    }

    public function requestAccess($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->request_access = true;
        $customer->save();

        return back()->with('message', 'Video access request sent to admin.');
    }

    public function approveAccess($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->aksesvideo = true;
        $customer->request_access = false;
        $customer->save();

        return back()->with('message', 'Access approved for customer.');
    }
    public function customers()
    {
        return view('tampilan'); // Ensure you have this view file created
    }
}
