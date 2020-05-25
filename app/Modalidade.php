<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    protected $table = 'modalidades';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['nome', 'horario'];

    public function professores()
    {
        return $this->belongsToMany('App\Professor', "modalidades_professores", "modalidade_id", "professor_id");
    }

}
