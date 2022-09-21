<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public $path = '/api/project';
    public $token = '';

    public function login()
    {
        $user = User::where( 'username', 'marcosp' )->first();
        Auth::loginUsingId( $user->id );
        $this->token = $user->createToken( 'sci_session' )->accessToken;
    }

    /** @test **/
    public function project_index()
    {
        $this->login();
        $data = ['search' => '1'];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('GET', $this->path, $data);
        $response->assertStatus(200);
    }

    /** @test **/
    public function project_store()
    {
        $this->login();
        $data = [
            'psp_id' => 'Kitsia Liliana Acosta Camacho',
            'name' => 'Proyecto',
            'contract_number' => '003',
            'contract_start_date' => '2022-05-17',
            'contract_end_date' => '2022-05-30'
        ];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('POST', $this->path, $data);
        $response->assertStatus(200);
    }

    /** @test **/
    public function project_edit()
    {
        $this->login();
        $project = Project::orderBy('created_at', 'desc')->limit(1)->first();
        $response = $this->withHeaders(['AUthorization' => 'Bearer '.$this->token])->json('GET', $this->path.'/'.$project->id.'/edit');
        $response->assertStatus(200);
    }

    /** @test **/
    public function project_update()
    {
        $this->login();
        $project = Project::orderBy('created_at', 'desc')->limit(1)->first();
        $data = [
            'psp_id' => 'Kitsia Liliana Acosta Camac',
            'name' => 'Proyecto Miguel Angel',
            'contract_number' => 003,
            'contract_start_date' => '2022-05-15',
            'contract_end_date' => '2022-05-29'
        ];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('PUT', $this->path.'/'.$project->id, $data);
        $response->assertStatus(200);
    }

    /** @test **/
    public function project_destroy()
    {
        $this->login();

        $project = Project::orderBy('created_at', 'desc')->limit(1)->first();
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('DELETE', $this->path.'/'.$project->id);
        $response->assertStatus(200);
    }

}
