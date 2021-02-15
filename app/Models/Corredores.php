<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Corredores extends Model
{
    protected $table = 'corredores';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'dt_nascimento'
    ];

    // public function provas()
    // {
    //     return $this->hasMany(Provas::class);
    // }

}
