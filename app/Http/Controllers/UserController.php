<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('company')->orderBy('id', 'DESC')->paginate(User::count());
        return view('pages.user.index')->with([
            'users' => $users
        ]);
    }

    // public function getDataUser()
    // {
    //     return User::all();
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Company::all();
        $roles = Role::all();
        // dd(User::all());
        return view('pages.user.create')->with([
            'users' => $users,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required:3',
            'email' => 'required',
            'password' => 'required',
            'company_id' => 'required|integer|exists:companies,id',
            'role' => 'required|exists:roles,name',
            'avatar' => 'required|mimes:jpeg,bmp,png,jpg',
        ], [
            'name.required' => 'Username tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'company_id.required' => 'Company tidak boleh kosong',
            'role.required' => 'Role tidak boleh kosong',
            'avatar.required' => 'Avatar tidak boleh kosong',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => $request->company_id,
            'avatar' => $request->file('avatar')->store(
                'assets/avatar', 'public'
            ),
        ]);
        $user->assignRole($request->role);
        // User::create($request->all());
        return redirect('user/')->with('status', 'User berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $companies = Company::all();
        $roles = Role::all();
        $rolecurrent = str_replace(['["','"]'], '', $user->getRoleNames());

        return view('pages.user.edit', compact('user', 'companies', 'roles', 'rolecurrent'));
        // echo('tes');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required:3',
            'email' => 'required',
            'password' => 'required',
            // 'role' => 'required|exists:roles,name',
            'avatar' => 'required|mimes:jpeg,bmp,png,jpg',
        ], [
            'name.required' => 'Username tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            // 'role.required' => 'Role tidak boleh kosong',
            'avatar.required' => 'Avatar tidak boleh kosong',
        ]);

        // $user = User::where('id', $id)->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'avatar' => $request->file('avatar')->store(
        //         'assets/avatar', 'public'
        //     ),
        // ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->file('avatar')->store(
                'assets/avatar', 'public'
            ),
        ]);
        // $user->assignRole($request->role);

        return redirect('user/')->with('status', 'User berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect('user/')->with('status', 'User berhasil dihapus!');
    }
}
