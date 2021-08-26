<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rfid;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class RfidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $savedata = Rfid::orderBy('id', 'DESC')->paginate(Rfid::count());
        return view('pages.rfid.index')->with([
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
        $savedata = Rfid::all();
        return view('pages.rfid.create')->with([
            'savedata' => $savedata
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
            'uuid' => 'required:3',
            'brand' => 'required',
            'type' => 'required',
            'sn' => 'required',
            'buy_at' => 'required',
            'kilometer_start' => 'required',
            'kilometer_end' => 'required',
            'is_broken' => 'required',
        ], [
            'uuid.required' => 'uuid tidak boleh kosong',
            'brand.required' => 'Brand tidak boleh kosong',
            'type.required' => 'Tipe tidak boleh kosong',
            'sn.required' => 'Serial tidak boleh kosong',
            'buy_at.required' => 'Kolom tidak boleh kosong',
            'kilometer_start.required' => 'kilometer_start tidak boleh kosong',
            'kilometer_end.required' => 'kilometer_end tidak boleh kosong',
            'is_broken.required' => 'is_broken tidak boleh kosong',
        ]);

        Rfid::create([
            'uuid' => $request->uuid,
            'brand' => $request->brand,
            'type' => $request->type,
            'sn' => $request->sn,
            'buy_at' => $request->buy_at,
            'kilometer_start' => $request->kilometer_start,
            'kilometer_end' => $request->kilometer_end,
            'is_broken' => $request->is_broken,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect('rfid/')->with('status', 'RFID berhasil ditambah!');
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
        $rfid = Rfid::where('id', $id)->first();
        return view('pages.rfid.edit')->with([
            'rfid' => $rfid
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
            'brand' => 'required',
            'type' => 'required',
            'sn' => 'required',
            'buy_at' => 'required',
            'kilometer_start' => 'required',
            'kilometer_end' => 'required',
            'is_broken' => 'required',
        ], [
            'brand.required' => 'Brand tidak boleh kosong',
            'type.required' => 'Tipe tidak boleh kosong',
            'sn.required' => 'Serial tidak boleh kosong',
            'buy_at.required' => 'Kolom tidak boleh kosong',
            'kilometer_start.required' => 'kilometer_start tidak boleh kosong',
            'kilometer_end.required' => 'kilometer_end tidak boleh kosong',
            'is_broken.required' => 'is_broken tidak boleh kosong',
        ]);

        Rfid::where('id', $id)->update([
            'uuid' => $request->uuid,
            'brand' => $request->brand,
            'type' => $request->type,
            'sn' => $request->sn,
            'buy_at' => $request->buy_at,
            'kilometer_start' => $request->kilometer_start,
            'kilometer_end' => $request->kilometer_end,
            'is_broken' => $request->is_broken,
            'updated_by' => Auth::id(),
        ]);

        return redirect('rfid/')->with('status', 'RFID berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rfid::where('id', $id)->delete();
        return redirect('rfid/')->with('status', 'RFID berhasil dihapus!');
    }
}
