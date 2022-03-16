<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{
    protected $tasks;
    public function __construct()
    {
        $this->middleware('auth');
       

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::get();
        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title'       => 'required',
            ]);
            $data = Task::create([
                "title" => $request->title,
                "description" => $request->description,
                'status'=> $request->status,
                'user_id'=> $request->user_id,
            ]);
            return response()->json([
                'data' => $data
            ]);
         }
        catch (ValidationException $exception) {
            return response()->json([
                'result'         => null,
                'result_message' => [
                    'title'   => 'Form Error',
                    'message' => implode("\n", collect($exception->errors())->values()->flatten()->toArray()),
                    'type'    => 'error',
                ],

            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    { 
        try {
            $todo = Task::find($id);

            return response()->json([
                'data' => $todo
            ]);
        } catch (err $e) {
            return response()->json([
                'error' => 'Todo is not found.',
                'code' => $e->getCode()
            ], $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $article = Task::find($id);
        $article->update($request->all());

        return response()->json([
            'data' => $article
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        $todo = Task::find($id)->first();

        if(!is_null($todo)) {
            $todo->delete();
        }

        return 200;
    }



}
