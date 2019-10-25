<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function show()
    {
        $devices = Device::all();

        return view('devices', compact('devices'));
    }

    public function store(Request $request)
    {
        $customMessages = [
            'unique' => 'Данный :attribute и сетевой адресс уже были добавлены.'
        ];

        $validatedData = $request->validate([
            'ip' => 'required|ip|unique:devices,ip,NULL,NULL,device_address, ' . $request['device_address'],
            'port' => 'required|gt:0|max:65535',
            'device_address' => 'required|gte:0|max:99|unique:devices,device_address,NULL,NULL,ip, ' . $request['ip'],
            'connection_type' => 'required|in:UDP,TCP'
        ], $customMessages);

        $device = new Device($validatedData);
        $device->save();

        return redirect('/devices');
    }
}