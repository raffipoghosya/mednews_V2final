<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclam extends Model
{
    protected $table = 'reclam';

    protected $fillable = [
        'href',
        'page',
        'position',
        'image',
    ];
}
