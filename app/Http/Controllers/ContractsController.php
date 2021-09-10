<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Company;
use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use App\Models\Contract_Device;
use App\Models\Rfid;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $devices = Device::all();
        // $savedata = Contract::with('company')->orderBy('id', 'DESC')->paginate(Contract::count());
        // return view('pages.contract.index')->with([
        //     'savedata' => $savedata
        // ]);
        return view('pages.contract.index');
    }

    public function getContract()
    {
        // if ($request->ajax()) {
        //     $model = Contract::with('company')->with('devices');
        //         return DataTables::eloquent($model)
        //         ->addColumn('company', function(Contract $contract){
        //             return $contract->company->name;
        //         })
        //         ->toJson();
        // }
        // $devices = Device::all();
        $userCompany = Auth::user()->company_id;
        if(Auth::user()->hasRole('admin')){
            $getcontract = Contract::all()->where('company_id', $userCompany);
        } else {
            $getcontract = Contract::all();
        }
        $contract = $getcontract;
        // $contract = Contract::all();
        // dd($contract->devices->count());
        return DataTables::of($contract)
        ->addIndexColumn()
        ->addColumn('company', function($contract) {
            if (empty($contract->company_id)) {
                return '';
            } else {
                return $contract->company->name;
            }
        })
        ->addColumn('jumlahdevice', function($contract) {
            if (empty($contract->devices->count())) {
                return 0;
            } else {
                return $contract->devices->count();
            }
        })
        ->addColumn('created_at', function ($contract) {
            return $contract->created_at;
        })
        ->addColumn('updated_at', function ($contract) {
            return $contract->updated_at;
        })
        ->addColumn('action', function ($contract) {
            if(Auth::user()->hasRole('superadmin')){
                if ($contract->devices->count() == null) {
                    $action = '<button class="btn btn-success btn-sm me-2" disabled><i class="fas fa-eye"></i></button>';
                } else {
                    $action = '<a href="contract/assigndevice/'.$contract->id.'" class="btn btn-success btn-sm me-2" title="Assign Device"><i class="fas fa-eye"></i></a>';
                }
                $action .= '<a href="contract/edit/'.Crypt::encrypt($contract->id).'" class="btn btn-primary btn-sm me-2" title="Edit"><i class="fas fa-edit"></i></a>';
                if ($contract->devices->count() != null) {
                    $action .= '<button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i></button>';
                } else {
                    $action .= '<button class="btn btn-danger deletebtn btn-sm" value="'. $contract->id. '" title="Delete"><i class="fa fa-trash"></i></button>';
                }
            } else {
                $action = '';
            }

            return $action;
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contract = Company::all();
        return view('pages.contract.create')->with([
            'contract' => $contract
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
            'company_id' => 'required',
            'started_at' => 'required|date',
            'expired_at' => 'required|date|after:started_at',
            'jumlah' => 'required',
        ], [
            'company_id.required' => 'Company ID tidak boleh kosong',
            'started_at.required' => 'Tanggal mulai tidak boleh kosong',
            'expired_at.required' => 'Tanggal berakhir tidak boleh kosong',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
        ]);

        $company = Company::find($request->company_id);
        $users = $company->users;

        $devices = Device::where('is_available', true)->limit($request->jumlah)->get();

        if ($devices->count() < $request->jumlah) {
            return redirect()->back()->withInput()->with('error', 'Maaf, device tidak cukup');
        }

        $contract = Contract::create([
            'company_id' => $request->company_id,
            'started_at' => $request->started_at,
            'expired_at' => $request->expired_at,
            'note' => $request->keterangan,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        $contract->updateDevice($devices);

        foreach ($devices as $device) {
            $device->updateUser($users);
            $device->is_available = false;
            $device->save();
        }

        return redirect('contract/')->with('status', 'Contract berhasil ditambah!');
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
        $contract = Contract::where('id', $id)->first();
        $company = Company::all();
        // dd($contract->devices->count());
        return view('pages.contract.edit', compact('contract', 'company'));
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
            'company_id' => 'required',
            'started_at' => 'required|date',
            'expired_at' => 'required|date|after:started_at',
            'jumlah' => 'required',
        ], [
            'company_id.required' => 'Company ID tidak boleh kosong',
            'started_at.required' => 'Tanggal mulai tidak boleh kosong',
            'expired_at.required' => 'Tanggal berakhir tidak boleh kosong',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
        ]);

        $contract = Contract::find($id);
        $company = Company::find($contract->company_id);
        $users = $company->users;

        $devices = Device::where('is_available', true)->get();

        if ( ($devices->count() + $contract->devices->count() ) < $request->jumlah) {
            return redirect()->back()->withInput()->with('error', 'Maaf, device tidak cukup');
        }

        // Remove device
        foreach ($contract->devices as $device) {
            $device->update(['is_available' => true]);
            // $contract->removeDevice($device);
            // foreach ($users as $user) {
            //     $user->removeDevice($device);
            // }
        }

        $contract->update([
            'company_id' => $request->company_id,
            'note' => $request->keterangan,
            'started_at' => $request->started_at,
            'expired_at' => $request->expired_at,
            'updated_by' => Auth::id(),
        ]);

        $devices = Device::where('is_available', true)->limit($request->jumlah)->get();

        $contract->updateDevice($devices);
        foreach ($company->users as $user) {
            $user->updateDevice($devices);
        }

        Device::whereIn('id', $devices->pluck('id'))->update(['is_available' => false]);
        return redirect('contract/')->with('status', 'Contract berhasil di update!');
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
        $contract = Contract::find($id);
        $contract->delete();
        return redirect('contract/')->with('status', 'Contract berhasil dihapus!');
    }

    public function assigndevice(Request $request, $id) {
        // $savedata = Contract::with('company')->orderBy('id', 'DESC')->paginate(Contract::count());
        // $devices = Contract::with('device')->orderBy('id', 'DESC')->paginate(Device::count());
        $contractdevice = Rfid::all();
        dd($contractdevice);
        // return view('pages.contract.assigndevice')->with([
        //     'savedata' => $savedata,
        //     'devices' => $devices,
        // ]);
    }
}
