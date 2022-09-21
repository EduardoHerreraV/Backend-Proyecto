<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\CatExperience;
use App\Models\CatPhase;
use App\Models\CatSize;
use App\Models\CatStatus;
use App\Models\CatSpecificKnowledge;
use App\Models\CatKnowledgeAreaType;

class CatalogsController extends Controller
{
    public function index(Request $request)
    {
        // if($error = $this->can(['catalogs-view'])){return $error;}
        try {
            $catalogs = [];

            if($request->has('project') && $request->input('project') == true) {
                $catalogs['project'] = Project::select(['id', 'name'])->get();
            }
            if($request->has('tasks') && $request->input('tasks') == true) {
                $catalogs['tasks'] = Task::select(['id', 'name'])->get();
            }
            if($request->has('cat_knowledge_area_types') && $request->input('cat_knowledge_area_types') == true) {
                $catalogs['cat_knowledge_area_types'] = CatKnowledgeAreaType::select(['id', 'name'])->get();
            }
            if($request->has('cat_specific_knowledge') && $request->input('cat_specific_knowledge') == true) {
                $catalogs['cat_specific_knowledge'] = CatSpecificKnowledge::select(['id', 'name', 'cat_knowledge_area_types_id'])->get();
            }
            if($request->has('cat_experiences') && $request->input('cat_experiences') == true) {
                $catalogs['cat_experiences'] = CatExperience::select(['id', 'name'])->get();
            }
            if($request->has('cat_phases') && $request->input('cat_phases') == true) {
                $catalogs['cat_phases'] = CatPhase::select(['id', 'name'])->get();
            }
            if($request->has('cat_sizes') && $request->input('cat_sizes') == true) {
                $catalogs['cat_sizes'] = CatSize::select(['id', 'name'])->get();
            }
            if($request->has('cat_statuses') && $request->input('cat_statuses') == true) {
                $catalogs['cat_statuses'] = CatStatus::select(['id', 'name'])->get();
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
