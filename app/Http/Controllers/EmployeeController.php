<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $employees = Employee::all();

            return response()->json([
                'success' => true,
                'employees' => $employees
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $employee = new Employee();
            $employee->name = $request->input('name');
            $employee->last_name = $request->input('lastname');
            $employee->second_last_name = $request->input('second_lastname');
            $employee->rfc = $request->input('rfc');
            $employee->curp = $request->input('curp');
            $employee->gender = 'XXXX';
            $employee->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'employee' => $employee
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function checkPSPExistence(Request $request)
    {

        try {

            $search = $request->input('search');
            $existence = false;
             //makes an random string with 20 characters
            //select all tokens in the User model where token = $token and count it
            $check_existence = Employee::where('rfc', $search)->count(); //laravel returns an integer

            if ($check_existence == 0) {
                $existence;
                $employee = 'No employee found';
            } else {
                $existence = true;
                $employee = Employee::where('rfc',$search)->first();
            }

            return response()->json([
                'success' => true,
                'existence' => $existence,
                'psp' => $employee
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function searchByRFC(Request $request)
    {
        try {
            $employee = Employee::with('employee')->where('rfc', $request->input('rfc'))->first();

            return response()->json([
                'success' => true,
                'employee' => $employee,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ]);
        }
    }

    public function getTask($id){
        try{
            $task=Task::where('id', $id)->first();
        return response()->json([
            'success'=> true,
            'task'=>$task,
        ]);
        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage()
            ]);
        }

    }

    public function getFullNameAttribute(){
        return $this->psp_name . ' '. $this->psp_last_name. ' '. $this->psp_second_last_name;
    }
}
