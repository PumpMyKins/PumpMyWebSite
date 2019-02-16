<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candidature extends Model
{
    protected $table = 'candidature';

    protected $fillable = [
        'type', 'prenom', 'name', 'age','user_id','horaire','motivation','anciennete','presentation','sanction','slug','rules','upvote','downvote'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeStatus($query)
    {
    	return $query->where('status', false);
    }
    public function scopeStatusAccepted($query)
    {
    	return $query->where('status', true);
    }
}
