<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Server extends Model
{
    protected $fillable = [
        'name', 'short_description', 'ip','image','description','open_date','slug'
    ];

    public function scopeOpen($query)
    {
        return $query->whereDate('open_date', '<=', Carbon::today()->toDateString())		 ->where('close', false);
    }

    public function scopeNotYetOpen($query)
    {
        return $query->whereDate('open_date', '>', Carbon::today()->toDateString())
                     ->where('close', false);
    }

    public function scopeClose($query)
    {
    	return $query->where('close', true);
    }

    public function scopeCloseOrNotYetOpen($query)
    {
        return $query->whereDate('open_date', '>=', Carbon::today()->toDateString())
        			 ->orWhere('close', true);
    }
}