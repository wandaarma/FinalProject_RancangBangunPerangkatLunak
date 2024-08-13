<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyTaskModel extends Model
{
    use HasFactory;

    protected $table = "data_individu";
    protected $fillable = [
        'title', 'description', 'subtask', 'deadline', 'status'
    ];
}
