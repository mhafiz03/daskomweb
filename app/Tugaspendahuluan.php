<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugaspendahuluan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modul_id', 'pembahasan',
    ];
}
