<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingGambar extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'setting_gambars';
    protected $fillable =
    [
        'tipe',
        'name',
        'path'
    ];
}
