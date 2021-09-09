<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Rfid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use DateTime;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

class RfidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $savedata = Rfid::orderBy('id', 'DESC')->paginate(Rfid::count());

        // // dd($savedata);

        // // $saveexpired = Rfid::get();
        // // foreach($saveexpired as $apply) {
        // //     $tmp = $apply->expired_at;
        // // }
        // // dd($tmp);
        // // dd($saveexpired->expired_at);

        // // $expired_at = Carbon::subDays(7)->toDateString();
        // // dd($expired_at);
        // return view('pages.rfid.index')->with([
        //     'savedata' => $savedata,
        //     // 'expired_at' => $expired_at,
        // ]);
        return view('pages.rfid.index');
    }

    public function getRfid()
    {
        $rfid = Rfid::all();
        return DataTables::of($rfid)
        ->editColumn('expired_at', function($rfid){
            $diff = abs(strtotime($rfid->expired_at) - strtotime(date('Y-m-d H:i:s')));
            $days = floor($diff/ (60*60*24)) + 1;
            if($rfid->expired_at <= date('Y-m-d H:i:s')){
                return '<span style="color:red;border: 3px solid red;padding: 2px 10px;border-radius: 50px;">'.$rfid->expired_at.'</span>';
            } elseif($rfid->expired_at > date('Y-m-d H:i:s') && $days <= 7) {
                return '<span style="color:orange;border: 3px solid orange;padding: 2px 10px;border-radius: 50px;">'.$rfid->expired_at.'</span>';
            } else {
                return $rfid->expired_at;
            }
        })
        ->addColumn('created_at', function ($rfid) {
            return $rfid->created_at;
        })
        ->addColumn('updated_at', function ($rfid) {
            return $rfid->updated_at;
        })
        ->addColumn('action', function($rfid) {
            $action = '<a href="rfid/edit/'.Crypt::encrypt($rfid->id).'" class="btn btn-primary btn-sm me-2" title="Edit"><i class="fas fa-edit"></i></a>';
            $action .= '<button class="btn btn-danger deletebtn btn-sm" value="'.$rfid->id.'" title="Delete"><i class="fa fa-trash"></i></button>';
            return $action;
        })
        ->rawColumns(['expired_at', 'action'])
        ->make(true);
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
        if (Rfid::where('uuid', $request->uuid)->exists()) {
            return redirect()->back()->withInput()->with('error', 'UUID Rfid sudah terdaftar');
        } else {
            $request->validate([
                'uuid' => 'required:3',
                'brand' => 'required',
                'type' => 'required',
                'sn' => 'required',
                'buy_at' => 'required',
                'expired_at' => 'required',
                'kilometer_start' => 'required',
                'kilometer_end' => 'required',
                'is_broken' => 'required',
            ], [
                'uuid.required' => 'uuid tidak boleh kosong',
                'brand.required' => 'Brand tidak boleh kosong',
                'type.required' => 'Tipe tidak boleh kosong',
                'sn.required' => 'Serial tidak boleh kosong',
                'buy_at.required' => 'Kolom tidak boleh kosong',
                'expired_at.required' => 'Expired at tidak boleh kosong',
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
                'expired_at' => $request->expired_at,
                'kilometer_start' => str_replace(".", "", $request->kilometer_start),
                'kilometer_end' => str_replace(".", "", $request->kilometer_end),
                'is_broken' => $request->is_broken,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]);

            return redirect('rfid/')->with('status', 'RFID berhasil ditambah!');
        }
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
        try {
            $request->validate([
                'brand' => 'required',
                'type' => 'required',
                'sn' => 'required',
                'buy_at' => 'required',
                'expired_at' => 'required',
                'kilometer_start' => 'required',
                'kilometer_end' => 'required',
                'is_broken' => 'required',
            ], [
                'brand.required' => 'Brand tidak boleh kosong',
                'type.required' => 'Tipe tidak boleh kosong',
                'sn.required' => 'Serial tidak boleh kosong',
                'buy_at.required' => 'Kolom tidak boleh kosong',
                'expired_at.required' => 'Expired at tidak boleh kosong',
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
                'expired_at' => $request->expired_at,
                'kilometer_start' => str_replace(".", "", $request->kilometer_start),
                'kilometer_end' => str_replace(".", "", $request->kilometer_end),
                'is_broken' => $request->is_broken,
                'updated_by' => Auth::id(),
            ]);

            return redirect('rfid/')->with('status', 'RFID berhasil di update!');
        } catch (\Illuminate\Database\QueryException) {
            return redirect()->back()->withInput()->with('error', 'UUID Device sudah terdaftar');
        }

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
        $rfid = Rfid::find($id);
        $rfid->delete();
        return redirect('rfid/')->with('status', 'RFID berhasil dihapus!');
    }
}
