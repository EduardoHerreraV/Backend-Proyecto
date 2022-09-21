<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $rowsPerPage = $request->input('rowsPerPage');
            $search = $request->input('search');
            $task = Task::search($search)->orderBy('created_at','desc')->paginate($rowsPerPage);
            return response()->json([
                'success' => true,
                'task' => $task,
			]);
        }catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessage()
			]);
        }
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
            $task= new Task();
            $task->user_id = Auth::user()->id;
            $task->fill($request->all());
            $task->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'task' => $task
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
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $task = Task::find($id);
            return response()->json([
                'success' => true,
                'task' => $task,
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
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        try {
            DB::beginTransaction();
            $task = Task::find($id);
            $task->fill($request->all());
            $task->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'task' => $task
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
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = Task::where('id', $id)->delete();
            DB::commit();
            return response()->json([
                'sucess' => true,
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ]);
        }
    }

    public function getUnasignatedTasks(Request $request)
    {
        try {

            $project = $request->input('project_id');
            $status = $request->input('status');
            //$data = $search;

            $tasks= Task::where(function ($query) use ($project) {
                return $query->where('project_id', 'like', '%' . $project . '%');
            })
            ->where(function ($query) use ($status) {
                return $query->where('cat_statuses_id', 'like', '%' . $status . '%');
            })
            ->get();



            return response()->json([
                'success' => true,
                'tasks' => $tasks
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ]);
        }
    }
}
