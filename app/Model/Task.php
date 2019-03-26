<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $table = "tasks";

    public $fillable = [
        "type",
        "instruction",
        "attachment_url",
        "date_created_at",
        "date_completed_at",
        "status",
        "id_project",
        "priority",
        "id_owner_user",
        "objectsAnnotate",
        "callback_succeded",
        "with_label",
        "actived",
        "min_heigth",
        "min_width",
        "metadata",
        "label",
        "callback_url"
    ];



    public static $rules = [
        "type" => "required"
    ];
    public static $mesajeCreate = [

    ];

    /***
     * Mensaje para un los con valores validados cuando se actualiza el modelo
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
     * Devuelve el proyecto a la que se asocia la tarea
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getProject()
    {
        return $this->belongsTo('App\Model\Projects', 'id_project');
    }
    public function getOwner()
    {
        return $this->belongsTo('App\User', 'id_owner_user');
    }
}
