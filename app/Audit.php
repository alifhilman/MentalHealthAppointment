<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    // protected $fillable = [
    //     'user_type','user_id', 'event', 'auditable_type', 'auditable_id', 'old_values', 
    //     'new_values', 'url', 'ip_address', 'user_agent', 'tags' ,'created_at', 'updated_at'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}





