<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $companies = Company::with('contracts')->orderBy('id', 'DESC')->paginate(Company::count());
        // return view('pages.company.index')->with([
        //     'companies' => $companies
        // ]);
        return view('pages.company.index');
    }

    public function getCompany()
    {
        $company = Company::all();
        return DataTables::of($company)
        ->addIndexColumn()
        ->addColumn('website', function ($company) {
            return '<span class="name"> <a href="'.$company->website.'" target="_blank"> ' .$company->website. ' </a></span>';
        })
        ->addColumn('created_at', function ($company) {
            return $company->created_at;
        })
        ->addColumn('updated_at', function ($company) {
            return $company->updated_at;
        })
        ->addColumn('action', function ($company) {
            $contract = Contract::all();
            $user = User::all();
            $action = '<a href="company/edit/'.Crypt::encrypt($company->id).'" class="btn btn-primary btn-sm me-2" title="Edit"><i class="fas fa-edit"></i></a>';
            // dd(Contract::where('company_id', '=', Company::get('id'))->exists());
            if (Contract::where('company_id', $company->id)->exists() || User::where('company_id', $company->id)->exists()) {
                // dd(true);
                $action .= '<button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i></button>';
            } else {
                // dd(false);
                $action .= '<button class="btn btn-danger deletebtn btn-sm" value="'. $company->id. '" title="Delete"><i class="fa fa-trash"></i></button>';
            }
            return $action;
        })->rawColumns(['DT_Row_Index', 'website', 'created_at', 'action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        // echo("halo");
        return view('pages.company.create')->with([
            'companies' => $companies
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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'phone' => 'required',
            'website' => 'required|regex:'.$regex,
            'address' => 'required',
        ], [
            'name.required' => 'Name tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'phone.required' => 'Phone Number tidak boleh kosong',
            'website.required' => 'Website tidak boleh kosong',
            'address.required' => 'Address tidak boleh kosong',
        ]);
        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect('company/')->with('status', 'Company berhasil ditambah!');
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
        $companies = Company::where('id', $id)->first();
        return view('pages.company.edit')->with([
            'companies' => $companies
        ]);
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
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'phone' => 'required',
            'website' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Name tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'phone.required' => 'Phone Number tidak boleh kosong',
            'website.required' => 'Website tidak boleh kosong',
            'address.required' => 'Address tidak boleh kosong',
        ]);
        Company::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'updated_by' => Auth::id(),
        ]);

        return redirect('company/')->with('status', 'Company berhasil di update!');
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
        $company = Company::find($id);
        $company->delete();
        return redirect('company/')->with('status', 'Company berhasil dihapus!');
    }
}
