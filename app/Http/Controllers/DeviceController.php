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
    { }
}