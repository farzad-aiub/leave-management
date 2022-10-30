<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = ['username','email','password','role','is_active',
    'phone','oparetor_id','employee_id'];

    public function emp(){
    	return $this->belongsTo(Employee::class,'employee_id','id');
    }
    public function admin(){
    	return $this->belongsTo(Oparetor::class,'oparetor_id','id');
    }

}
