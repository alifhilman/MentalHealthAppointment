<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use App\User;
class Booking extends Model implements Auditable
{
  use AuditableTrait;
    protected $guarded =[];

  public function doctor()
  {
  	return $this->belongsTo(User::class);
  }
   public function user()
  {
  	return $this->belongsTo(User::class);
  }
 
}
