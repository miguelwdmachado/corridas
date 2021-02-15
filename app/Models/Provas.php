<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provas extends Model
{
    protected $table = 'provas';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'tipo_prova_id',
        'data'
    ];

    public function tipo_prova()
    {
        return $this->hasOne(TipoProva::class, 'id', 'tipo_prova_id');
    }

}
