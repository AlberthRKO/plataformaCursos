<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    //* Creamos constantes para los estados de los modelos

    const borrador = 1;
    const revision = 2;
    const publicado = 3;


    //* Relaciones entre cursos y usuarios

    //* Relacion uno a muchos

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    //* Relacion uno a muchos inversa

    //! si cambiamos a teacher debemos indicar que la llave foreana concreta porque eloquent buscaraa un teacher_id
    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    //otras propiedades
    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function price()
    {
        return $this->belongsTo('App\Models\Price');
    }

    //* Relacion muchos a muchos

    public function students()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
