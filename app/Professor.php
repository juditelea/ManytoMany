<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = 'professores';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['nome', 'email'];

    public function modalidades()
    {
        return $this->belongsToMany('App\Modalidade', "modalidades_professores", "professor_id", "modalidade_id");
    }

    public function modalidadeArray()
    {
        foreach ($this->modalidades as $m)
        {
            $modalidades[] = $m->id;
        }
        return $modalidades;
    }
}

