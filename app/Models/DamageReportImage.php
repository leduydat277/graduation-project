<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamageReportImage extends Model
{
    use HasFactory;
    protected $table = 'damage_reports_image';

    public function damageReport()
    {
        return $this->belongsTo(DamageReport::class, 'damage_reports_id');
    }
}
