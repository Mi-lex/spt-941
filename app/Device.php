<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function path()
    {
        return "monitoring/$this->id";
    }
}