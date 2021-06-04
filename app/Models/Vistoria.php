<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vistoria extends Model
{
    protected $table = "vistoria";
    protected $fillable = [
        'hasAudio',
        'nome',
        'createdAt',
        'updatedAt',
        'record_path',
        'criptografia'
    ];
    use HasFactory;
}
