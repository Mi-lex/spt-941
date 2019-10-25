<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "monitoring/$this->id";
    }
}