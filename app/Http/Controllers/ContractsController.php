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
        $savedata = Contract::with('company')->orderBy('id', 'DESC')->paginate(Contract::count());
        return view('pages.contract.index')->with([
            'savedata' => $savedata
        ]);
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
            $contract->removeDevice($device);
            foreach ($users as $user) {
                $user->removeDevice($device);
            }
        }

        $contract->update([
            'company_id' => $request->company_id,
            'started_at' => $request->started_at,
            'expired_at' => $request->expired_at,
            'updated_by' => Auth::id(),
        ]);

        $devices = Device::where('is_available', true)->limit($request->jumlah)->get();
        $contract->updateDevice($devices, $company);
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
    public function destroy($id)
    {
        Contract::where('id', $id)->delete();
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
