<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // dd(User::all());
        return view('dashboard.user.index', [
            'users' => User::all(),
            'countUser' => User::all()->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'password' => 'required',
            'role' => 'required',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $role = strtolower($validatedData['role']);
        if ($role == 'pegawai') {
            $validatedData['is_admin'] = 0;
            $validatedData['is_atasan1'] = 0;
            $validatedData['is_atasan2'] = 0;
            $validatedData['is_driver'] = 0;
        } elseif ($role == 'atasan1') {
            $validatedData['is_atasan2'] = 0;
            $validatedData['is_admin'] = 0;
            $validatedData['is_driver'] = 0;
            $validatedData['is_pegawai'] = 0;
        } elseif ($role == 'atasan2') {
            $validatedData['is_atasan1'] = 0;
            $validatedData['is_admin'] = 0;
            $validatedData['is_driver'] = 0;
            $validatedData['is_pegawai'] = 0;
        } elseif ($role == 'admin') {
            $validatedData['is_atasan1'] = 0;
            $validatedData['is_atasan2'] = 0;
            $validatedData['is_driver'] = 0;
            $validatedData['is_pegawai'] = 0;
        } elseif ($role == 'driver') {
            $validatedData['is_atasan1'] = 0;
            $validatedData['is_atasan2'] = 0;
            $validatedData['is_admin'] = 0;
            $validatedData['is_pegawai'] = 0;
        }
        //email is not unique
        if (User::where('email', $validatedData['email'])->exists()) {
            return redirect('/dashboard')->with('error', 'Email pengguna sudah terdaftar');
        }
        //user name is not unique
        elseif (User::where('name', $validatedData['name'])->exists()) {
            return redirect('/dashboard')->with('error', 'Nama pengguna sudah terdaftar');
        }
        else{
            User::create($validatedData);
            Session::flash('success', 'User berhasil ditambahkan');
            return redirect('/dashboard');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'old_password' => '',
            'new_password' => '',
            'role' => '',
        ]);
        //check if role is changed
        $role = strtolower($validatedData['role']);
        //check old password == user password
        //decrypt user password

        if ($validatedData['old_password'] != null) {
            if (password_verify($validatedData['old_password'], $user->password)) {
                $validatedData['password'] = $validatedData['new_password'];
                $validatedData['password'] = bcrypt($validatedData['password']);
            }
            else {
                $user->update($validatedData);
                return redirect('/dashboard/user')->with('error', 'Password lama tidak sesuai');
            }
        }
        if ($validatedData['role'] != $user->role) {
            if ($role == 'pegawai') {
                $validatedData['is_pegawai'] = 1;
                $validatedData['is_admin'] = 0;
                $validatedData['is_atasan1'] = 0;
                $validatedData['is_atasan2'] = 0;
                $validatedData['is_driver'] = 0;
            } elseif ($role == 'atasan1') {
                $validatedData['is_atasan1'] = 1;
                $validatedData['is_atasan2'] = 0;
                $validatedData['is_admin'] = 0;
                $validatedData['is_driver'] = 0;
                $validatedData['is_pegawai'] = 0;
            } elseif ($role == 'atasan2') {
                $validatedData['is_atasan2'] = 1;
                $validatedData['is_atasan1'] = 0;
                $validatedData['is_admin'] = 0;
                $validatedData['is_driver'] = 0;
                $validatedData['is_pegawai'] = 0;
            } elseif ($role == 'admin') {
                $validatedData['is_admin'] = 1;
                $validatedData['is_atasan1'] = 0;
                $validatedData['is_atasan2'] = 0;
                $validatedData['is_driver'] = 0;
                $validatedData['is_pegawai'] = 0;
            } elseif ($role == 'driver') {
                $validatedData['is_driver'] = 1;
                $validatedData['is_atasan1'] = 0;
                $validatedData['is_atasan2'] = 0;
                $validatedData['is_admin'] = 0;
                $validatedData['is_pegawai'] = 0;
            }
            // dd($validatedData);
            $user->update($validatedData);
            return redirect('/dashboard/user')->with('success', 'User berhasil diupdate');
        }
        
            
    }


    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('success', 'User berhasil dihapus');
        return redirect('/dashboard/user');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
