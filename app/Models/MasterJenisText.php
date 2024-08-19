<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisText extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'master_text';
    protected $fillable =
    [
        'tipe',
        'keterangan'
    ];
}
