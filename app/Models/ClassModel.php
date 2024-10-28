<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';

    protected $fillable = [
        'name',
    ];
    // Một lớp có nhiều học sinh
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }
    public $timestamps = false; 
}
