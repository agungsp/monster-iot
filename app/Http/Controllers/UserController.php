<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Crypt;
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
        if ($request->avatar == null) {
            $request->validate([
                'name' => 'required:3',
                'email' => 'required',
                'password' => 'required',
                'company_id' => 'required|integer|exists:companies,id',
            ], [
                'name.required' => 'Username tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
                'company_id.required' => 'Company tidak boleh kosong',
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'company_id' => $request->company_id,
            ]);
        } else {
            $request->validate([
                'name' => 'required:3',
                'email' => 'required',
                'password' => 'required',
                'company_id' => 'required|integer|exists:companies,id',
                'avatar' => 'required|mimes:jpeg,bmp,png,jpg',
            ], [
                'name.required' => 'Username tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
                'company_id.required' => 'Company tidak boleh kosong',
                'avatar.required' => 'File harus images',
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
        }

        $user->assignRole($request->role);

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
        $id = Crypt::decrypt($id);
        $user = User::where('id', $id)->first();
        $companies = Company::all();
        $roles = Role::all();
        $rolecurrent = str_replace(['["','"]', ","], '', $user->getRoleNames());

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
            'company_id' => 'required|integer|exists:companies,id',
        ], [
            'name.required' => 'Username tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'company_id.required' => 'Company tidak boleh kosong',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
        ]);

        if ($request->avatar == null) {

        } else {
            $request->validate([
                'avatar' => 'required|mimes:jpeg,bmp,png,jpg',
            ], [
                'avatar.required' => 'File harus images',
            ]);

            User::where('id', $id)->update([
                'avatar' => $request->file('avatar')->store(
                    'assets/avatar', 'public'
                ),
            ]);
        }

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
