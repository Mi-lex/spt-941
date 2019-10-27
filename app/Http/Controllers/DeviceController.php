<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests\DeviceConnectionPost;

class DeviceController extends Controller
{
    public function show()
    {
        $devices = Device::orderByDesc('created_at')->get();

        return view('devices', compact('devices'));
    }

    public function store(DeviceConnectionPost $request)
    {
        $device = new Device($request->all());
        $device->save();

        return redirect('/devices');
    }
}