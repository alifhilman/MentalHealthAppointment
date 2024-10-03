<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Prescription extends Model implements Auditable
{
  use AuditableTrait;

  protected $fillable = [  'user_id',
  'doctor_id',
  'date',
  'name_of_disease',
  'symptoms',
  'procedure_to_use_medicine',
  'feedback',
  'file_path'];
  
    protected $guarded = [ ];
    
   public function doctor()
  {
  	return $this->belongsTo(User::class);
  }
   public function user()
  {
  	return $this->belongsTo(User::class);
  }

}
