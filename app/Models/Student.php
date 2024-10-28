<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'gender',
        'tel',
        'address',
        'image',
        "class_id"
    ];
   // Một học sinh thuộc về một lớp
   public function class()
   {
       return $this->belongsTo(ClassModel::class, 'class_id', 'id');
   }
    public $timestamps = false; 
}
