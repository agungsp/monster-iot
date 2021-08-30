<?php

namespace App\Http\Controllers;

use App\Models\Contract_Device;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Contract;

class Contract_DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $contract = Contract::find($id);
        // $devices = $contract->devices;

        return view('pages.contract.assigndevice', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatedevice(Request $request, $id)
    {
        // dd($request);
        for ($i = 0; $i < count($request->uuid); $i++) {
            # code...
            // if ($request->alias[$i]) {
                Device::where('uuid', $request->uuid[$i])->update([
                    'alias' => $request->alias[$i] ?? ''
                ]);
            // }
        }

        return redirect('contract/')->with('status', 'Data berhasil di update!');

        // if ($request->alias == null) {
        //     return redirect('contract/')->with('status', 'Data berhasil di update!');
        // } else {
        //     // for ($i = 0; $i < $request->jumlahdevice; $i++) {
        //     //     // dd($id);
        //     // }
        //     Device::where('id', $id)->update([
        //         'alias' => $request->alias
        //     ]);
        //     return redirect('contract/')->with('status', 'Data berhasil di update!');
        // }
    }
}
