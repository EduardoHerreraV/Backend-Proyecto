<?php

namespace App\Http\Controllers;

use App\Models\CatSpecificKnowledge;
use App\Models\Initiative;
use App\Models\KnowledgeInitiative;
use App\Models\Project;
use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InitiativeController extends Controller
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
            $initiatives = Initiative::search($search)
            ->orderBy('initiatives.created_at','desc')->paginate($rowsPerPage);
            foreach($initiatives as $initiative){
                $initiative->repositories = Repository::where('initiative_id', $initiative->id)->get();
                $initiative->project = Project::where('id', $initiative->project_id)->get();
            }
            return response()->json([
                'success' => true,
                'initiative' => $initiatives,
			]);
        }catch (\Exception $e) {
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
            $initiative= new Initiative();
            $initiative->fill($request->all());
            $data = $request->all();
            $repository = $data['repository'];
            $knowledge = $data['knowledge'];
            $initiative->save();

            foreach ($repository as $repositoryData) {
                $repo = new Repository();
                $repo->initiative_id = $initiative->id;
                $repo->repository_name = $repositoryData['repository_name'];
                $repo->url = $repositoryData['url'];
                $repo->description = $repositoryData['description'];
                $repo->save();
            }

            foreach ($knowledge as $knowledgeData) {
                $know = new KnowledgeInitiative();
                $know->initiative_id = $initiative->id;
                $know->cat_knowledge_area_types_id = $knowledgeData['cat_knowledge_area_types_id'];
                $know->cat_specific_knowledge_id = $knowledgeData['cat_specific_knowledge_id'];
                $know->save();
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'initiative' => $initiative
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
     * @param  \App\Models\Initiative  $initiative
     * @return \Illuminate\Http\Response
     */
    public function show(Initiative $initiative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Initiative  $initiative
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $initiative = Initiative::with(['knowledge','repository' => function($q) {
                $q->orderBy('id', 'asc');
            }])->where('id',$id)->first();
            return response()->json([
                'success' => true,
                'initiative' => $initiative,
            ], 200);
        }   catch (\Exception $e) {
            DB::rollback();
            return response() ->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Initiative  $initiative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $initiative = Initiative::find($id);
            $initiative->fill($request->all());
            $initiative->save();

            foreach ($request->repository as $value) {

              if(!array_key_exists('id', $value)){
                  $repo = new Repository();
              }else{
                  $repo = Repository::find($value['id']);
              }
              $repo->initiative_id             = $initiative->id;
              $repo->repository_name           = $value["repository_name"];
              $repo->url                       = $value["url"];
              $repo->description               = $value["description"];
              $repo->save();
            }

            foreach ($request->knowledge as $value) {

                if(!array_key_exists('id', $value)){
                    $know = new KnowledgeInitiative();
                }else{
                    $know = KnowledgeInitiative::find($value['id']);
                }
                $know->initiative_id                   = $initiative->id;
                $know->cat_knowledge_area_types_id     = $value["cat_knowledge_area_types_id"];
                $know->cat_specific_knowledge_id       = $value["cat_specific_knowledge_id"];
                $know->save();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'initiative' => $initiative
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Initiative  $initiative
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $initiative = Initiative::where('id', $id)->with('repository')->first();
            // dd('Hola', $initiative);
            $initiative->delete();
            DB::commit();
            return response()->json([
                'sucess' => true,
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ],500);
        }
    }

    public function destroyRepository($id)
    {
        try {
            DB::beginTransaction();
            $data = Repository::where('id', $id)->delete();
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

    public function destroyKnowledge($id)
    {
        try {
            DB::beginTransaction();
            $data = KnowledgeInitiative::where('id', $id)->delete();
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


    public function getTecnology(Request $request)
    {
        try {

            $technologies  = $request->input('cat_knowledge_area_types_id');

            $technologies = CatSpecificKnowledge::where(function ($query) use ($technologies) {
                return $query->where('cat_knowledge_area_types_id', 'like', '%' . $technologies . '%');
            })
            ->get();



            return response()->json([
                'success' => true,
                'technologies' => $technologies
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ]);
        }
    }
}
