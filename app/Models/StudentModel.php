<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
     protected $fillable = [
          'name',
          'last_name',
          'address',
          'phone',
      ];
    use HasFactory;
}