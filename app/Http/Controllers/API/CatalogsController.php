<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Groups;
use App\Models\Matter;
use App\Models\Profiles;

class CatalogsController extends Controller
{
    public function index(Request $request)
    {
        // if($error = $this->can(['catalogs-view'])){return $error;}
        try {
            $catalogs = [];

            if($request->has('degrees') && $request->input('degrees') == true) {
                $catalogs['degrees'] = Degree::select(['id', 'name'])->get();
            }
            if($request->has('groups') && $request->input('groups') == true) {
                $catalogs['groups'] = Groups::select(['id', 'name'])->get();
            }
            if($request->has('matters') && $request->input('matters') == true) {
                $catalogs['matters'] = Matter::select(['id', 'name'])->get();
            }
            if($request->has('profiles') && $request->input('profiles') == true) {
                $catalogs['profiles'] = Profiles::select(['id', 'name'])->get();
            }

            return response()->json([
                'status' => 200,
                'success' => true,
                'catalogs' => $catalogs
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => 400,
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
