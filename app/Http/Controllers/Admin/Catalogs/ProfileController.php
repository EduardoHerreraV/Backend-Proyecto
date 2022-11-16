<?php

namespace App\Http\Controllers\Admin\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\RoleHasPermission;
use App\Models\UserProfile;
use App\Traits\GeneralResponse;
use App\Traits\ProfileVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
  use GeneralResponse, ProfileVerify;

  /**
   * Display a listing of the resource.
   * @param \Illuminate\Http\Request [page, rowsPerPage, search]
   * @return \Illuminate\Http\JsonResponse [code, obj, message, action]
   */
  public function index(Request $request)
  {
    try {
      $rowsPerPage = $request->rowsPerPage;
      $search = $request->search;
      $items = UserProfile::with('permissions')->search($search)->orderBy('created_at', 'desc')->paginate($rowsPerPage);

      return $this->genResponse(200, $items, null, 'show-roles-list');
    } catch (Exception $e) {
      return $this->genResponse(400, null, $e->getMessage());
    }
  }


  /**
   * @param \Illuminate\Http\Request [name, key]
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request)
  {
    try {
      DB::beginTransaction();
      $user_profile = new UserProfile();
      $user_profile->fill($request->all());
      $user_profile->save();
      $user_profile->permissions()->sync($request->permissions);
      DB::commit();
      return $this->genResponse(200, null, 'Perfil creado');

    } catch (\Exception $e) {
      DB::rollback();
      return $this->genResponse(500, null, $e->getMessage());
    }

  }

  /**
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function edit($id)
  {

    try {
      $user_profile = UserProfile::with('permissions')->where('id', $id)->first();
      return $this->genResponse(200, ['profile' => $user_profile], 'Perfil');

    } catch (\Exception $e) {
      DB::rollback();
      return $this->genResponse(500, null, $e->getMessage());
    }
  }

  /**
   * @param \Illuminate\Http\Request
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, $id)
  {
    try {

      DB::beginTransaction();
      $user_profile = UserProfile::find($id);
      $user_profile->fill($request->all());
      $user_profile->save();
      $user_profile->permissions()->sync($request->permissions);
      DB::commit();
      return $this->genResponse(200, null, 'Perfil Actualizado');

    } catch (\Exception $e) {
      DB::rollback();
      return $this->genResponse(500, null, $e->getMessage());
    }
  }

  /**
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy($id)
  {
    try {
      DB::beginTransaction();
      $rolHasPermission=RoleHasPermission::where('profile_id', $id)->delete();
      $profile = UserProfile::where('id', $id)->delete();
      DB::commit();
      return response()->json([
        'success' => $profile,
        'message' => '',
      ], 200);
    } catch (\Exception $e) {
      DB::rollback();
      return response()->json([
        'success' => false,
        'message' => 'Ha ocurrido un error' . $e
      ]);
    }
  }
}
