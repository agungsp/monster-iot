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
        $jsonData = collect();
        foreach ($devices as $device) {
            $jsonData->push([
                'uuid' => $device->uuid,
                'latlng' => [$device->latitude, $device->longitude],
                'selected' => false
            ]);
        }
        return response()->json([
            'html' => view('includes.dashboard-tbody-devices', compact('devices'))->render(),
            'json' => $jsonData,
        ]);
    }

    public function getDevice(Request $request)
    {
        $device = Device::find($request->id);
        return view('includes.dashboard-tbody-state', compact('device'))->render();
    }
}
