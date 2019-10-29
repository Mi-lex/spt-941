<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests\DeviceConnectionPost;
use App\Drivers\Spt_941;

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
        $connection['device_address'] = $device->device_address;

        return view('pages.monitoring', compact('connection'));
    }

    public function monitoring(DeviceConnectionPost $request)
    {
        $connection = $request->all();

        return view('pages.monitoring', compact('connection'));
    }

    public function device_params(DeviceConnectionPost $request)
    {
        $device = new Spt_941($request->all());

        $deviceParams = $device->collect_data();

        return $deviceParams;
    }

    public function test_params(Device $device)
    {
        $connection = [];

        $connection = [];
        $connection['ip'] = $device->ip;
        $connection['port'] = $device->port;
        $connection['connection_type'] = $device->connection_type;
        $connection['device_address'] = $device->device_address;

        $deviceConnection = new Spt_941($connection);

        $deviceParams = $deviceConnection->collect_data();

        dd($deviceParams);
    }
}