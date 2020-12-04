<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->user->tasks()->get(["id", "title", "details", "statut", "created_by", "status"])->toArray();

        return $tasks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "title"=> "required",
            "details" => "",
        ]);


        $task = new Task();
        $task->title = $request->title;
        $task->details = $request->details;
        $task->statut = false;

        if($this->user->tasks()->save($task)){
            return response()->json([
                "message" => 'Enregistrement ok',
                "task" => $task,
            ],200);
        } else {
            return response()->json([
                "status"=>false,
                "message"=>"Impossible d'enregistrer la tache"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            "statut" => "required"
        ]);

        $task->statut = $request->statut;

        if($this->user->tasks()->save($task)){
            return response()->json([
                "status" => 'Mise a jour ok',
                "task" => $task,
            ]);
        } else {
            return response()->json([
                "task"=>$task,
                "message"=>"Impossible d'enregistrer la tache"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if($task->delete()) {
            return response()->json([
                "message"=>'Tache supprimée avec succes',
                "task"=> $task
            ],200);
        } else {
            return response()->json([
                "message"=>"impossible de supprimer la tache"
            ], 500);
        }
    }
}
