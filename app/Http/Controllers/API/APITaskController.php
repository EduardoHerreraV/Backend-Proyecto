<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CatStatus;
use App\Models\CatStatusCause;
use App\Models\StatusTask;
use App\Models\Task;
use App\Models\TaskAsigment;
use App\Models\User;
use Illuminate\Http\Request;

class APITaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTasksByPSP($search)
    {

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TaskAsigment $taskAsigment
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TaskAsigment $taskAsigment
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TaskAsigment $taskAsigment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('cat_status_id');
            $status_cause = $request->input('cat_status_causes_id');

            $taskAsignment = Task::findOrFail($id);
            if($taskAsignment->cat_statuses_id!=$status)
            {
                $taskAsignment->cat_statuses_id = $status;

                $statusTask = new StatusTask();
                $statusTask->task_id = $id;
                $statusTask->cat_status_id = $status;
                $statusTask->cat_status_causes_id = $status_cause;
                $taskAsignment->save();
                $statusTask->save();
            }


            return response()->json([
                'success' => true,
                'task' => $taskAsignment,
                'status_task' => $statusTask
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TaskAsigment $taskAsigment
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    public function listTask(Request $request)
    {
        try {

            $search = $request->input('search');
            //$data = $search;

            $data = Task::join('employees', 'tasks.employee_id', '=', 'employees.id')
                ->join('cat_statuses', 'cat_statuses.id', '=', 'tasks.cat_statuses_id')
                ->join('projects', 'projects.id', '=', 'tasks.project_id')
                ->select(
                    'tasks.id',
                    'tasks.name',
                    'tasks.description',
                    'projects.name as project',
                    'employees.rfc as psp_rfc',
                    'cat_statuses.name as status'
                )
                ->where(function ($query) use ($search) {
                    return $query->where('employees.rfc', 'like', '%' . $search . '%');
                })
                ->whereIn('tasks.cat_statuses_id', [2,3,4])
                ->get();
            $catStatus = CatStatus::whereIn('id', [3,4,5])->get();

            $catStatusCause = CatStatusCause::all();
            return response()->json([
                'success' => true,
                'data' => $data,
                'catStatus' => $catStatus,
                'catStatusCause' => $catStatusCause,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        //
    }
}
