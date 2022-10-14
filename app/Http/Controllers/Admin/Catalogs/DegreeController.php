<?php

namespace App\Http\Controllers\Admin\Catalogs;

use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller; 

class DegreeController extends Controller
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
            $degree = Degree::search($search)->orderBy('created_at','desc')->paginate($rowsPerPage);
            return response()->json([
                      'success' => true,
                      'degree' => $degree,
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
            $degree = new Degree();
            $degree->fill($request->all());
            $degree->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'degree' => $degree
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
     * @param \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $degree = Degree::find($id);
            return response()->json([
              'success' => true,
              'degree' => $degree,
            ]);
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $degree = Degree::find($id);
            $degree->fill($request->all());
            $degree->save();
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
     * @param \App\Models\degree $degree
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $degree = Degree::where('id', $id)->delete();
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
