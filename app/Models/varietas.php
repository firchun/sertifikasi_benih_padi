<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class varietas extends Model
{
    use HasFactory;
    protected $table = 'varietas';
    protected $fillable = [
        'name',
        'description',
    ];
}
