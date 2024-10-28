<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamageReportsImage extends Model
{
    use HasFactory;

    protected $table = 'damage_reports_image';

    protected $fillable = [
        'damage_reports_id',
        'image_url',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function damageReport()
    {
        return $this->belongsTo(DamageReport::class, 'damage_reports_id');
    }
}
