<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;


class DevicesController extends Controller
{
    //
    public function index()
    {
        $devices = Device::latest()->paginate(5);;
        return view('pages.devices', compact('devices'))->with('i', (request()->input('page', 1) - 1) * 5);;
    }
}
