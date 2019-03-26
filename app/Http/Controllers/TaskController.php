<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Model\Projects;
use App\Model\Task;
use App\User;
use Illuminate\Http\Request;
use Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allTasks()
    {
        $project = Task::all();
        $data = $project->toArray();
        $response = $this->ResponseTask(true, $data, 'Peoject retrieved successfully.');
        return response()->json($response, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Cargar todos los proyectos
        $projects = Projects::all();
        //Cargar todos los usuarios que sean del rol Owner
        //TODO: Falta filtrar los usuarios por rol
        $userOwner = User::all();


        return view('tasks.create')
            ->with('userOwner', $userOwner)
            ->with('projects', $projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {

        //Obtener los datos
        $input = $request->all();

        //Validar los datos enviados
        $validator = Validator::make($input, [
            "type" => "required"
        ]);

        //Si es fallidos los datos, enviar error
        if ($validator->fails()) {
            $response = $this->ResponseTask(false, 'Validation Error.', $validator->errors());
            return response()->json($response, 404);
        }

        //Si no existe el error , entonces crear la tarea y enviar los datos
        $task = Task::create($input);
        $data = $task->toArray();
        $response = $this->ResponseTask(true, $data, 'Task stored successfully.');
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        $data = $task->toArray();

        if (is_null($task)) {
            $response = $this->ResponseTask(false, 'Empty', 'Task not found.');
            return response()->json($response, 404);
        }
        $response = $this->ResponseTask(true, $data, 'Task retrieved successfully.');
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            "type" => "required"
        ]);

        if ($validator->fails()) {
            $response = $this->ResponseTask(true, 'Validation Error.', $validator->errors());
            return response()->json($response, 404);
        }
        $task=Task::find($id);
        $task->type = $input['type'];
        $task->instruction = $input['instruction'];
        $task->attachment_url = $input['attachment_url'];
        $task->date_created_at = $input['date_created_at'];
        $task->date_completed_at = $input['date_completed_at'];
        $task->status = $input['status'];
        $task->id_project = $input['id_project'];
        $task->priority = $input['priority'];
        $task->id_owner_user = $input['id_owner_user'];
        $task->objectsAnnotate = $input['objectsAnnotate'];
        $task->callback_succeded = $input['callback_succeded'];
        $task->with_label = $input['with_label'];
        $task->actived = $input['actived'];
        $task->min_heigth = $input['min_heigth'];
        $task->min_width = $input['min_width'];
        $task->metadata = $input['metadata'];
        $task->label = $input['label'];
        $task->callback_url = $input['callback_url'];


        $task->save();
        $data = $task->toArray();
        $response = $this->ResponseTask(true, $data, 'Task updated successfully.');

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Task::find($id);
        $task->delete();
        $data = $task->toArray();
        $response = $this->ResponseTask(true, $data, 'Task deleted successfully.');

        return response()->json($response, 200);
    }

    private function ResponseTask($success, $data, $message)
    {
        return [
            'success' => $success,
            'data' => $data,
            'message' => $message
        ];

    }
}
