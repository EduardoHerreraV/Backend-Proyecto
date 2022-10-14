<?php

namespace app\Http\Controllers\Admin\Catalogs;


use App\Models\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
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
            $groups = Groups::search($search)->orderBy('created_at','desc')->paginate($rowsPerPage);
            return response()->json([
                      'success' => true,
                      'groups' => $groups,
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
            $groups = new Groups();
            $groups->fill($request->all());
            $groups->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'groups' => $groups
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
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function show(Groups $groups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $groups = Groups::find($id);
            return response()->json([
              'success' => true,
              'groups' => $groups,
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
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $groups = Groups::find($id);
            $groups->fill($request->all());
            $groups->save();
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
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $groups = Groups::where('id', $id)->delete();
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
