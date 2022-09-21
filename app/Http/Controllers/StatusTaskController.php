<?php

namespace App\Http\Controllers;

use App\Models\StatusTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class StatusTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            DB::beginTransaction();

            $status_task = new StatusTask();
            // $status_task->task_id = $request->input('task_id');
            // $status_task->cat_status_id = $request->input('cat_status_id');
            // $status_task->comment = $request->input('comment');
            $status_task->fill($request->all());
            $status_task->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'status_task' => $status_task
            ], 200);
        } catch (\Exception $e){

            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusTask  $statusTask
     * @return \Illuminate\Http\Response
     */
    public function show(StatusTask $statusTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusTask  $statusTask
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $status = StatusTask::find($id);
            return response()->json([
                'success' => true,
                'status' => $status,
            ], 200);
        }   catch (\Exception $e) {
            DB::rollback();
            return response() ->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatusTask  $statusTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $status_task = StatusTask::findOrFail($id);
            $status_task->fill($request->all());
            $status_task->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'status_task' => $status_task
            ], 200);

        } catch (\Exception $e){

            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusTask  $statusTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusTask $statusTask)
    {
        //
    }

    public function getStatus($id) {
        try{
            $status = Task::where('id', $id)->get();
            return response()->json([
                'success' => true,
                'status' => $status,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'mesaage' => $e ->getMessage()
            ]);
        }
    }
}
