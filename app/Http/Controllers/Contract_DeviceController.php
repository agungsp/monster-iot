<?php

namespace App\Http\Controllers;

use App\Models\Contract_Device;
use Illuminate\Http\Request;
use App\Models\Device;

class Contract_DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // foreach($request as $data) {
        $savedata = Contract_Device::with('devices')->where('contract_id', $id)->get();
            // dd($data);
        // }
        // $id = [];
        // dd($savedata);
        return view('pages.contract.assigndevice')->with([
            'savedata' => $savedata,
            'id' => $id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        if ($request->alias == null) {
            return redirect('contract/')->with('status', 'Data berhasil di update!');
        } else {
            // for ($i = 0; $i < $request->jumlahdevice; $i++) {
            //     // dd($id);
            // }
            Device::where('id', $id)->update([
                'alias' => $request->alias
            ]);
            return redirect('contract/')->with('status', 'Data berhasil di update!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
