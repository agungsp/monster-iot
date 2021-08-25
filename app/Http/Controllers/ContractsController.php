<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
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
        $savedata = Contract::orderBy('id', 'DESC')->paginate(Contract::count());
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
        $savedata = Contract::all();
        return view('pages.contract.create')->with([
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
            'company_id' => 'required',
            'started_at' => 'required',
            'expired_at' => 'required',
        ], [
            'company_id.required' => 'Company ID tidak boleh kosong',
            'started_at.required' => 'Tanggal mulai tidak boleh kosong',
            'expired_at.required' => 'Tanggal berakhir tidak boleh kosong',
        ]);
        Contract::create([
            'company_id' => $request->company_id,
            'started_at' => $request->started_at,
            'expired_at' => $request->expired_at,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

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
        $contract = Contract::where('id', $id)->first();
        return view('pages.contract.edit')->with([
            'contract' => $contract
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
            'company_id' => 'required',
            'started_at' => 'required',
            'expired_at' => 'required',
        ], [
            'company_id.required' => 'Company ID tidak boleh kosong',
            'started_at.required' => 'Tanggal mulai tidak boleh kosong',
            'expired_at.required' => 'Tanggal berakhir tidak boleh kosong',
        ]);
        Contract::where('id', $id)->update([
            'company_id' => $request->company_id,
            'started_at' => $request->started_at,
            'expired_at' => $request->expired_at,
            'updated_by' => Auth::id(),
        ]);

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
}
