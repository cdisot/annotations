<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Rutas para los proyectos

//All project
$router->get('projects', ['uses' => 'ProjectController@allProject']);

//get one Project
$router->get('projects/{id}', ['uses' => 'ProjectController@show']);

//create project
$router->post('projects', ['uses' => 'ProjectController@store']);

//delete project
$router->delete('projects/{id}', ['uses' => 'ProjectController@destroy']);

//Update project
$router->put('projects/{id}', ['uses' => 'ProjectController@update']);



//Rutas para las tareas

//All tasks
$router->get('tasks', ['uses' => 'TaskController@allTasks']);

//get one task
$router->get('tasks/{id}', ['uses' => 'TaskController@show']);

//create task
$router->post('tasks', ['uses' => 'TaskController@store']);

//delete task
$router->delete('tasks/{id}', ['uses' => 'TaskController@destroy']);

//Update task
$router->put('tasks/{id}', ['uses' => 'TaskController@update']);