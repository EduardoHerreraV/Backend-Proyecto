<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Initiative;
use App\Models\Project;
use App\Models\StatusTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function modalDataTask(Request $request)
    {
        $task = $request->input("task");
        $data = DB::table('status_tasks')->where('task_id', $task)->whereIn('cat_status_id', [2, 3, 4, 5])
            ->join('cat_statuses', 'cat_statuses.id', '=', 'status_tasks.cat_status_id')
            ->select('status_tasks.id', 'cat_statuses.name', 'status_tasks.cat_status_id', 'status_tasks.cat_status_causes_id', 'status_tasks.created_at')->orderBy('status_tasks.created_at')
            ->get();
        $as = "";
        //return  $data=StatusTask::where('task_id', $task)->get();
        $totalMinutes = 0;
        $beginTime = Carbon::now()->timestamp;
        $endTime = Carbon::now()->timestamp;
        $interrupt=0;
        foreach ($data as $as => $taskUnique) {
            if ($taskUnique->cat_status_id == 2) {
                $taskUnique->time = null;
            }
            if ($taskUnique->cat_status_id == 3) {
                $beginTime = Carbon::createFromFormat('Y-m-d H:i:s', $taskUnique->created_at);
                $taskUnique->time = null;
            }

            if ($taskUnique->cat_status_id == 4 || $taskUnique->cat_status_id == 5) {
                $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $taskUnique->created_at);
                $quantityinMinutes = Carbon::parse($beginTime)->diffInMinutes(Carbon::parse($endTime));
                $totalMinutes = $totalMinutes + $quantityinMinutes;
                $taskUnique->time = $quantityinMinutes;
                if ($taskUnique->cat_status_id == 4)
                {
                    $interrupt=$interrupt+1;
                }
            }
            //$taskUnique->time=1;

        }
        //return $data;
        $task = Task::where('id', $task)->first();

        $project = Project::where('id', $task->project_id)->first();
        $nameProject = $project->name;
        if (isset($project->initiatives)) {
            $initiative = Initiative::where('id', $project->initiatives)->first();
            $nameIni = $initiative->name;
        } else {
            $nameIni = "Sin Registro";
        }

        $user = User::where('id', $task->user_id)->first();
        $userName = $user->name . " " . $user->last_name . " " . $user->second_last_name;
        $pmName = $userName;
        $employee = Employee::where('id', $task->employee_id)->first();
        $employeeName = $employee->name . " " . $employee->last_name . " " . $employee->second_last_name;
        $personAsign = $employeeName;
        $timeTotal = $totalMinutes/60;

        return response()->json([
            'success' => true,
            'project' => $nameProject,
            'initiative' => $nameIni,
            'pm' => $pmName,
            'interrupt'=>$interrupt,
            'asign' => $personAsign,
            'timeTotal' => $timeTotal,
            'data' => $data,
        ]);

        try {
            $rowsPerPage = $request->input('rowsPerPage');
            $search = $request->input('search');
            $project = Project::search($search)->orderBy('created_at', 'desc')->paginate($rowsPerPage);
            return response()->json([
                'success' => true,
                'project' => $project,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function index(Request $request)
    {
        try {
            $rowsPerPage = $request->input('rowsPerPage');
            $search = $request->input('search');
            $project = Project::join('employees', 'projects.psp_id', '=', 'employees.id')
                ->select('projects.id as id',
                    'projects.name as name',
                    'projects.contract_number as contract_number',
                    'projects.contract_start_date as contract_start_date',
                    'projects.contract_end_date as contract_end_date',
                    'employees.name as psp_name',
                    'employees.last_name as psp_last_name',
                    'employees.second_last_name as psp_second_last_name'
                )
                ->where(function ($query) use ($search) {
                    return $query->where('employees.name', 'like', '%' . $search . '%')
                                ->orWhere('projects.contract_number', 'like', '%' .$search. '%')
                                ->orWhere('projects.name', 'like', '%' . $search . '%');

                })
                ->orderBy('projects.created_at','desc')->paginate($rowsPerPage);
            return response()->json([
                'success' => true,
                'project' => $project,
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
        try {
            DB::beginTransaction();
            $project = new Project();
            $project->fill($request->all());
            $project->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'project' => $project
            ], 200);
        } catch (\Exception $e) {
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
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit($projectId)
    {
        try {
            // $employee=Employee::first();

            $project = Project::where('psp_id', $projectId)
            ->join('employees', 'projects.psp_id', '=', 'employees.id')
            ->select('projects.id as id',
            'projects.name as name',
            'projects.contract_number as contract_number',
            'projects.contract_start_date as contract_start_date',
            'projects.contract_end_date as contract_end_date',
            'employees.name as psp_name',
            'employees.last_name as psp_last_name',
            'employees.second_last_name as psp_second_last_name',
            DB::raw("concat(employees.name, ' ', employees.last_name, ' ', employees.second_last_name) as psp_name")
            )
            ->first();
            return response()->json([
                'success' => true,
                'project' => $project,
                // 'employee' => $employee->full_name,
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $project = Project::find($id);
            $project->fill($request->all());
            $project->save();
            DB::commit();
            return response()->json([
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
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
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = Project::where('id', $id)->delete();
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
}
