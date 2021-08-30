<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }

    public function getDevices()
    {
        $devices = auth()->user()->devices;
        return view('includes.dashboard-tbody-devices', compact('devices'))->render();
    }

    public function getDevice(Request $request)
    {
        $device = Device::find($request->id);
        return view('includes.dashboard-tbody-state', compact('device'))->render();
    }
}
