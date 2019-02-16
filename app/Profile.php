<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
    	'prenom','nom','adresse','ville','zipcode','country','image','bio','stat_privacy','privacy','minecraft_link','discord_link','user_id',
    ];

    public function users()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

	public function scopePublic($query)
	{
		return $query->where('privacy', true);
	}

	public function scopeStatPublic($query)
	{

		return $query->where('stat_privacy', true);
	}

	public function scopePrivate($query)
	{
		return $query->where('privacy', false);
	}
	
	public function scopeStatPrivate($query)
	{

		return $query->where('stat_privacy', false);
	}
}
