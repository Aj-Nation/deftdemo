<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'file_name'
    ];
}
