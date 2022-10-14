<?php

namespace App\Http\Controllers\Admin\Catalogs;

use App\Models\Matter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MatterController extends Controller
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
            $matter = Matter::search($search)->orderBy('created_at','desc')->paginate($rowsPerPage);
            return response()->json([
                      'success' => true,
                      'matter' => $matter,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $matter = new Matter();
            $matter->fill($request->all());
            $matter->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'matter' => $matter
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
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $matter = Matter::find($id);
            return response()->json([
              'success' => true,
              'matter' => $matter,
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matter  $matter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $matter = Matter::find($id);
            $matter->fill($request->all());
            $matter->save();
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
     * @param  \App\Models\Matter  $matter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $matter = Matter::where('id', $id)->delete();
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
