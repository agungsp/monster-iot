<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $userCompany = Auth::user()->company_id;
        // if(Auth::user()->hasRole('admin')){
        //     $users = User::with('company')->role(['admin', 'user'])->where('company_id', $userCompany)->orderBy('id', 'DESC')->paginate(User::count());
        // } else {
        //     $users = User::with('company')->orderBy('id', 'DESC')->paginate(User::count());
        // }
        // $users1 = $users;
        // return view('pages.user.index')->with([
        //     'users' => $users1,
        // ]);
        return view('pages.user.index');
    }

    public function getDataUser()
    {
        $userCompany = Auth::user()->company_id;
        if(Auth::user()->hasRole('admin')){
            $getusers = User::with('company')->role(['admin', 'user'])->where('company_id', $userCompany);
        } else {
            $getusers = User::with('company');
        }
        $users = $getusers;
        // $rolecurrent = str_replace(['["','"]', ","], '', $user->getRoleNames());
        return DataTables::of($users)
        ->addColumn('company', function ($users) {
            if(empty($users->company_id)){
                return '';
            } else {
                return $users->company->name;
            }
        })
        ->addColumn('role', function($users){
            if($users->hasRole('superadmin')){
                return '<span class="name badge bg-primary">'.str_replace(['["','"]', ","], '',$users->getRoleNames()).'</span>';
            } elseif($users->hasRole('admin')){
                return '<span class="name badge bg-warning">'.str_replace(['["','"]', ","], '',$users->getRoleNames()).'</span>';
            } elseif($users->hasRole('user')){
                return '<span class="name badge bg-danger">'.str_replace(['["','"]', ","], '',$users->getRoleNames()).'</span>';
            } else {
                return '';
            }
        })
        ->addColumn('avatar', function ($users) {
            if(empty($users->avatar)){
                return '<img src="https://ui-avatars.com/api/?name='.$users->name.'" class="img-thumbnail rounded-circle">';
            } else {
                return '<img src="asset("storage/"'.$users->avatar.')" class="img-thumbnail rounded-circle">';
            }
        })
        ->addColumn('is_active', function ($users) {
            if($users->is_active == 1){
                return '<span class="name badge bg-success">Aktif</span>';
            } else {
                return '<span class="name badge bg-danger">Tidak Aktif</span>';
            }
        })
        ->addColumn('action', function ($users) {
            $action = '<a href="user/edit/'.Crypt::encrypt($users->id).'" class="btn btn-primary btn-sm me-2" title="Edit"><i class="fas fa-edit"></i></a>';
            $action .= '<button class="btn btn-danger deletebtn btn-sm" value="'. $users->id. '" title="Delete"><i class="fa fa-trash"></i></button>';
            return $action;
        })
        ->rawColumns(['role', 'avatar', 'is_active', 'action'])
        ->make(true);
    }

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
                'email' => 'unique:users|email|:rfc,dns',
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
                'is_active' => $request->is_active,
            ]);
        } else {
            $request->validate([
                'name' => 'required:3',
                'email' => 'unique:users|email:rfc,dns',
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
                'is_active' => $request->is_active,
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
            'email' => 'email:rfc,dns',
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
            'is_active' => $request->is_activeVal,
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
        $user = User::find($id);
        $user->removeRole($request->rolecurrent);
        $user->assignRole($request->role);

        return redirect('user/')->with('status', 'User berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('DeleteData_ByID');
        $user = User::find($id);
        $user->delete();
        return redirect('user/')->with('status', 'User berhasil dihapus!');
    }

    public function trash()
    {
        $users = User::with('company')->onlyTrashed()->paginate(User::onlyTrashed()->count());
        // dd($users);
        return view('pages.user.trash')->with([
            'users' => $users
        ]);
    }

    public function restore(Request $request)
    {
        $id = $request->input('restoredata_byid');
        $user = User::with('company')->onlyTrashed()->find($id)->restore();
        return redirect('user/')->with('status', 'User berhasil di restore!');
    }
}
