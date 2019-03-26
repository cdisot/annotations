<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = ['name', 'actived'];


    /****
     * Reglas para validar ;los valores
     * @var array
     */
    public static $rules = [
        "name" => "required"
    ];
    public static $mesajeCreate = [

    ];

    /***
     * Mensaje para un los c\valores validados cuando se actualiza el modelo
     * @var array
     */
    public static $mesajeUpdate = [

    ];

    /**
     * Validar el tipo de dato
     * @var array
     */
    protected $casts = [
        "name" => "string"
    ];

    /****
     * Devuelve la lista de tareas pertenecientes al proyecto
     * @return mixed
     */
    public function getTasks()
    {
        return $this->hasMany('App\Model\Task', 'id_project');

    }

}
