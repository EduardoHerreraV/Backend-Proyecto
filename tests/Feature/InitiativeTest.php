<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Initiative;
use Illuminate\Support\Facades\Auth;

class InitiativeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public $path = '/api/initiative';
    public $token = '';

    public function login()
    {
        $user = User::where( 'username', 'marcosp' )->first();
        Auth::loginUsingId( $user->id );
        $this->token = $user->createToken( 'sci_session' )->accessToken;
    }

    /** @test **/
    public function initiative_index()
    {
        $this->login();
        $data = ['search' => '1'];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('GET', $this->path, $data);
        $response->assertStatus(200);
    }

    /** @test **/
    public function initiative_store()
    {
        $this->login();
        $data = [
            'repository' => [
                0 => [
                    'repository_name' => 'Repositorio1',
                    'url' => 'URL1',
                    'description' => 'Descripcion1'
                ]
            ],
            'knowledge' => [
                0 => [
                    'cat_knowledge_area_types_id' => 1,
                    'cat_specific_knowledge_id' => 1
                ]
            ],
            'project_id' => 1,
            'name' => 'Miky1'
        ];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('POST', $this->path, $data);
        $response->assertStatus(200);
    }

    /** @test **/
    public function initiative_edit()
    {
        $this->login();
        $initiative = Initiative::orderBy('created_at', 'desc')->limit(1)->first();
        $response = $this->withHeaders(['AUthorization' => 'Bearer '.$this->token])->json('GET', $this->path.'/'.$initiative->id.'/edit');
        $response->assertStatus(200);
    }

    /** @test **/
    public function initiative_update()
    {
        $this->login();
        $initiative = Initiative::orderBy('created_at', 'desc')->limit(1)->first();
        $data = [
            'repository' => [
                0 => [
                    'repository_name' => 'Repositorio2',
                    'url' => 'URL2',
                    'description' => 'Descripcion2'
                ]
            ],
            'knowledge' => [
                0 => [
                    'cat_knowledge_area_types_id' => 2,
                    'cat_specific_knowledge_id' => 2
                ]
            ],
            'project_id' => 1,
            'name' => 'Miky2'
        ];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('PUT', $this->path.'/'.$initiative->id, $data);
        $response->assertStatus(200);
    }

    /** @test **/
    public function initiative_destroy()
    {
        $this->login();

        $initiative = Initiative::orderBy('created_at', 'desc')->limit(1)->first();
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('DELETE', $this->path.'/'.$initiative->id);
        $response->assertStatus(200);
    }

}
