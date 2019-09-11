<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    
	use Sluggable;
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'type', 'title', 'content','like','active','user_id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User', 'foreign_key');
    }

    public function getFamousAttribute()
    {
    	if($this->attributes['like'] > 10)
    	{
    		return true;
    	}
    	return false;
    }
}
