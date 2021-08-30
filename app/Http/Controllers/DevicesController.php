<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Support\Facades\Hash;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::all();
        // dd(User::all());
        return view('pages.devices.index')->with([
            'devices' => $devices
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
        $devices = Device::all();
        // dd(User::all());
        return view('pages.devices.create')->with([
            'devices' => $devices
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
            'uuid' => 'required',
            'alias' => 'required',
        ], [
            'uuid.required' => 'UUID tidak boleh kosong',
            'alias.required' => 'Alias tidak boleh kosong',
        ]);

        Device::create([
            'uuid' => $request->uuid,
            'alias' => $request->alias,
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,


        ]);
        return redirect('devices')->with('status', 'Device berhasil ditambah!');
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
        $devices = Device::where('id', $id)->first();
        return view('pages.devices.edit', compact('devices'));
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
            'uuid' => 'required',
            'alias' => 'required',
        ], [
            'uuid.required' => 'UUID tidak boleh kosong',
            'alias.required' => 'Alias tidak boleh kosong',
        ]);

        Device::where('id', $id)->update([
            'uuid' => $request->uuid,
            'alias' => $request->alias,
        ]);
        return redirect('devices')->with('status', 'Device berhasil di update!');
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
        $device = Device::find($id);
        $device->delete();
        return redirect('devices/')->with('status', 'Device berhasil dihapus!');
    }
}
