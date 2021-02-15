<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CorredoresProvas extends Model
{
    protected $table = 'corredores_provas';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'corredor_id',
        'grupo',
        'prova_id',
        'data',
		'h_inicio',
		'h_fim',
		'tempo'
    ];

    public function corredor()
    {
        return $this->hasOne(Corredores::class, 'id', 'corredor_id');
    }

    public function prova()
    {
        return $this->hasOne(Provas::class, 'id', 'prova_id');
    }
}
