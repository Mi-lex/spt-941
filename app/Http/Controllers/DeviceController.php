<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests\DeviceConnectionPost;

class DeviceController extends Controller
{
    public function show()
    {
        $devices = Device::orderByDesc('created_at')->get();

        return view('pages.devices', compact('devices'));
    }

    public function store(DeviceConnectionPost $request)
    {
        Device::create($request->all());

        return redirect('/devices');
    }

    public function monitoring()
    {
        return view('pages.monitoring');
    }
}