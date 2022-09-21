<?php

namespace App\Http\Controllers;

use App\Models\CatStatus;
use App\Models\CatStatusCause;
use App\Models\Task;
use App\Models\TaskAsigment;
use Illuminate\Http\Request;

class TaskAsigmentController extends Controller
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
            $taskAssignment = Task::join('employees', 'tasks.employee_id', '=', 'employees.id')
                ->join('projects', 'projects.id', '=', 'tasks.project_id')
                ->join('cat_statuses', 'cat_statuses.id', '=', 'tasks.cat_statuses_id')
                ->select('projects.name as project_name',
                    'tasks.id as task_number',
                    'employees.name as psp_name',
                    'employees.last_name as psp_last_name',
                    'employees.second_last_name as psp_second_last_name',
                    'cat_statuses.name as status'
                )
                ->where(function ($query) use ($search) {
                    return $query->where('projects.name', 'like', '%' . $search . '%')
                                ->orWhere('tasks.id', 'like', '%' .$search. '%')
                                ->orWhere('employees.name', 'like', '%' . $search . '%');
                })
                ->orderBy('tasks.created_at', 'asc')
                ->where('tasks.cat_statuses_id', 2)
                ->paginate($rowsPerPage);
            $catStatus = CatStatus::all();
            $catStatusCause = CatStatusCause::all();


            return response()->json([
                'success' => true,
                'taskAssignments' => $taskAssignment,
                'catStatus' => $catStatus,
                'catStatusCause' => $catStatusCause,
            ]);
        } catch (\Exception $e) {
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
        //
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
}
