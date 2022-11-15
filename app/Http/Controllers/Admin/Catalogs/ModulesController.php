<?php

namespace App\Http\Controllers\Admin\Catalogs;

use App\Models\Modules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\GeneralResponse;

class ModulesController extends Controller
{
    use GeneralResponse;

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request [page, rowsPerPage, search]
     * @return \Illuminate\Http\JsonResponse [code, obj, message, action]
     */

    public function index(Request $request)
    {
        try {
            $rowsPerPage = $request->input('rowsPerPage');
            $search = $request->input('search');
            $module = Modules::with('permissions')->orderBy('created_at','desc')->get();
            $items = Modules::with('permissions')->orderBy('created_at','desc')->get();
            $this->genResponse(200, $items, null, 'show-modules-list');
            //return  $module;
            return response()->json([
                      'success' => true,
                      'modules' => $module,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function show(Modules $modules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
