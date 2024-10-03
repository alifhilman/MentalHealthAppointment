<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Time;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Appointment extends Model implements Auditable
{
	use AuditableTrait;
	protected $guarded = [];

	public function doctor(){
		return $this->belongsTo(User::class,'user_id','id');
	}
	public function times(){
    	return $this->hasMany(Time::class);
    }


	
}
