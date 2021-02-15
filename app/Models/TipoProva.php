<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TipoProva extends Model
{
    protected $table = 'tipo_prova';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'tipo'
    ];

}
