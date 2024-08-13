<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenModel extends Model
{
    protected $fillable = [
        'Dokumen'
    ];
    public $table = "dokumen";
    use HasFactory;
}
