<?php

namespace App\Http\Controllers\Admin\Catalogs;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
     /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request [page, rowsPerPage, search]
     * @return \Illuminate\Http\JsonResponse [code, obj, message, action]
     */
    public function index(Request $request)
    {
        //if($error = $this->can(['permissions-view'])){return $error;} //validation

        try {
            $rowsPerPage = $request->rowsPerPage;
            $search = $request->search;
            $items = Permission::select('name', 'key')->search($search)->orderBy('created_at','desc')->paginate($rowsPerPage);

            return $this->genResponse(200, $items, null, 'show-permissions-list');
        }
        catch (Exception $e) {
            return $this->genResponse(400, null, $e->getMessage());
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
                $permission = new Permission();
                $permission->fill($request->all());
                $permission->save();
            DB::commit();
            return $this->genResponse(200, null, 'Permiso creado');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->genResponse(500, null, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $profiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profiles  $profiles
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
     * @param  \App\Models\profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
                $permission = Permission::find($id);
                $permission->fill($request->all());
                $permission->save();

            DB::commit();
            return $this->genResponse(200, null, 'Permiso actualizado');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->genResponse(500, null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # code...
    }
}
