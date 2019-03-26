<?php

namespace App\Http\Controllers;


use App\Model\Projects;

use Illuminate\Http\Request;
use Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allProject()
    {
        $project = Projects::all();
        $data = $project->toArray();
        $response = $this->ResponseProject(true, $data, 'Peoject retrieved successfully.');
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Creaaterequest
     *     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Obtener los datos
        $input = $request->all();

        //Validar los datos enviados
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);

        //Si es fallidos los datos, enviar error
        if ($validator->fails()) {
            $response = $this->ResponseProject(false, 'Validation Error.', $validator->errors());
            return response()->json($response, 404);
        }

        //Si no existe el error , entonces crear el proyecto y enviar los datos
        $project = Projects::create($input);
        $data = $project->toArray();
        $response = $this->ResponseProject(true, $data,'Peoject stored successfully.');
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
        $project = Projects::find($id);
        $data = $project->toArray();

        if (is_null($project)) {
            $response = $this->ResponseProject(true, 'Empty',  'Project not found.');
            return response()->json($response, 404);
        }
        $response = $this->ResponseProject(true, $data, 'Project retrieved successfully.');
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
        $project = Projects::find($id);

        if (empty($project)) {

            return redirect(route('projects.index'));
        }
        return view('projects.edit')->with('project', $project);
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
            'name' => 'required'
        ]);

        if ($validator->fails()) {

            $response = $this->ResponseProject(true, 'Validation Error.', $validator->errors());
            return response()->json($response, 404);
        }
        $project =Projects::find($id);
        $project->name = $input['name'];
        $project->save();
        $data = $project->toArray();
        $response = $this->ResponseProject(true, $data, 'Project updated successfully.');

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
        $project =Projects::find($id);
        $project->delete();
        $data = $project->toArray();
        $response = $this->ResponseProject(true, $data, 'Project deleted successfully.');

        return response()->json($response, 200);
    }

    private function ResponseProject($success, $data, $message)
    {
        return [
            'success' => $success,
            'data' => $data,
            'message' => $message
        ];
    }

}
