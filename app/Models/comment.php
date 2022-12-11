<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    public function getDateAsCarbonAttribute()
    {
        return Carbon::parse($this->created_at);
    }
}
