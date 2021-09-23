<?php

namespace App\Http\Controllers;

use App\Models\Contract_Device;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Contract;
use App\Models\Rfid;
use Illuminate\Support\Facades\Auth;

class Contract_DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $rfids =  Rfid::all()->pluck('uuid');
        $contract = Contract::find($id);
        // dd($contract);
        // $devices = $contract->devices;
        return view('pages.contract.assigndevice', compact('contract', 'rfids'));
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
            Device::where('uuid', $request->uuid[$i])->update([
                'alias' => $request->alias[$i] ?? ''
            ]);

            $rfid_limit = count($request->rfid_uuid[$request->uuid[$i]]);
            $k=0;
            // dd($arr_limit);
            for ($j=0; $j < $rfid_limit; $j++) { 
                // if (!is_null($request->rfid_uuid[$request->uuid[$i]][$j])) {
                //     Rfid::where('uuid', $request->rfid_uuid[$request->uuid[$i]][$j])->update([
                //         'brand' => $request->rfid_brand[$request->uuid[$i]][$j],
                //         'type' => $request->rfid_tipe[$request->uuid[$i]][$j],
                //         'sn' => $request->rfid_sn[$request->uuid[$i]][$j],
                //         'buy_at' => $request->rfid_buyat[$request->uuid[$i]][$j],
                //         'time_limit' => $request->rfid_timelimit[$request->uuid[$i]][$j],
                //         'kilometer_start' => $request->rfid_kmstart[$request->uuid[$i]][$j],
                //         'kilometer_end' => $request->rfid_kmend[$request->uuid[$i]][$j],
                //         'device_id' => $request->device_id[$i],
                //         'is_connect' => true,
                //         'updated_by' => Auth::id(),
                //     ]);
                // } else {
                //     continue;
                // }
                // dd(is_null($request->rfid_uuid[$request->uuid[$i]][$j]));
                
                if (is_null($request->rfid_uuid[$request->uuid[$i]][$j])) {
                    continue;
                } else {
                    Rfid::where('uuid', $request->rfid_uuid[$request->uuid[$i]][$j])->update([
                        'brand' => $request->rfid_brand[$request->uuid[$i]][$k] ?? null,
                        'type' => $request->rfid_tipe[$request->uuid[$i]][$k] ?? null,
                        'sn' => $request->rfid_sn[$request->uuid[$i]][$k] ?? null,
                        'buy_at' => $request->rfid_buyat[$request->uuid[$i]][$k] ?? null,
                        'time_limit' => $request->rfid_timelimit[$request->uuid[$i]][$k] ?? null,
                        'kilometer_start' => $request->rfid_kmstart[$request->uuid[$i]][$k] ?? null,
                        'kilometer_end' => $request->rfid_kmend[$request->uuid[$i]][$k] ?? null,
                        'device_id' => $request->device_id[$i],
                        'is_connect' => true,
                        'updated_by' => Auth::id(),
                    ]);
                    $k++;
                }
            }   
        }

        return redirect('contract/')->with('status', 'Data berhasil di update!');
    }
}
