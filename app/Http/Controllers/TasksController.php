<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Transformers\TaskTransformer;
use App\Http\Requests\StoreTaskRequest;

use App\Http\Requests;

class TasksController extends Controller
{
    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$tasks = $request->user()->tasks()->latest()->get();
        $tasks = Task::all();

        //return $this->response->array(['data' => $tasks], 200);
        return $this->collection($tasks, new TaskTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $request->user()->tasks()->create([
            'body' => $request->input('body'),
            'completed' => false,
        ]);

        if ($task){
            return $this->response->created();
        }
        return $this->response->errorBadRequest();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::where('id', $id)->first();

        if ($task) {
            return $this->item($task, new TaskTransformer);
        }

        return $this->response->errorNotFound();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->fill($request->all());
        return response()->json($task->save());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task) {
            $task->delete();
            return $this->response->noContent();
        }

        return $this->response->errorBadRequest();
    }
}
