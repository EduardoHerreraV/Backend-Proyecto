<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
            $user = User::search($search)->orderBy('created_at','desc')->paginate($rowsPerPage);
            return response()->json([
                      'success' => true,
                      'user' => $user,
                  ]);
            }catch (\Exception $e) {
              error_log($e->getMessage());
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
