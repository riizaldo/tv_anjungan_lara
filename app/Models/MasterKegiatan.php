<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKegiatan extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'master_kegiatans';
    protected $fillable =
    [
        'tipe',
        'kegiatan',
        'keterangan',
        'start_date',
        'end_date',
        'is_active',
    ];
}
