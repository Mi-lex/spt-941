<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests\DeviceConnectionPost;
use Symfony\Component\HttpFoundation\Request;

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

    public function delete(Device $device)
    {
        $device->delete();    
    }

    public function monitoringSavedDevice(Device $device)
    {
        $connection = [];
        $connection['ip'] = $device->ip;
        $connection['port'] = $device->port;
        $connection['connection_type'] = $device->connection_type;

        return view('pages.monitoring', compact('connection'));
    }

    public function monitoring(DeviceConnectionPost $request)
    {
        $connection = $request->all();

        return view('pages.monitoring', compact('connection'));
    }
}