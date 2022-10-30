<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oparetor extends Model
{
    use HasFactory;
     protected $table = 'oparetors';


     protected $fillable = ['first_name','branch',
     'phone','department','password','role','is_active'];



}
