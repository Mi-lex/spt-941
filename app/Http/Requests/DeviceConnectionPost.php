<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceConnectionPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ip' => 'required|ip|unique:devices,ip,NULL,NULL,device_address, ' . $this['device_address'],
            'port' => 'required|gt:0|max:65535',
            'device_address' => 'required|gte:0|max:99|unique:devices,device_address,NULL,NULL,ip, ' . $this['ip'],
            'connection_type' => 'required|in:UDP,TCP'
        ];
    }

    public function messages()
    {
        return [
            'unique' => 'Данный :attribute и сетевой адресс уже были добавлены.'
        ];
    }
}