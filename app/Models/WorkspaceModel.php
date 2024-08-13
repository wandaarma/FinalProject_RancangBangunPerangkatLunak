<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkspaceModel extends Model
{
    use HasFactory;

    protected $table = "data_kelompok";
    protected $fillable = [
        'title', 'description', 'deadline', 'profil_image', 'leader', 'priority', 'status', 'kode'
    ];
}
