<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public $token = '';
    public $path = 'api/task';

    public function login(){
        $user = User::where( 'username', 'marcosp' )->first();
        Auth::loginUsingId( $user->id );
        $this->token = $user->createToken( 'sci_session' )->accessToken;
    }

    /**  @test **/
    public function task_index()
    {
        $this->login();
        $data = ['search' => '1'];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('GET', $this->path, $data);
        $response->assertStatus(200);
    }

    /**  @test **/
    public function task_store()
    {
        $this->login();
        $data = [
            'user_id' => 1,
            'name' => 'Nombre de Tarea Generica',
            'description' => 'Descripcion de tarea generica',
            'sprint' => 1,
            'dependencies' => 'INFOTEC',
            'hours' => '100',
            'project_id' => '2',
            'cat_size_id' => 2,
            'cat_phase_id' => 1,
            'cat_statuses_id' => 1,
            'employee_id' => '',
            'start_date' => '',
            'end_date' => ''
        ];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('POST', $this->path, $data);
        $response->assertStatus(200);
    }

    /** @test **/
    public function task_edit()
    {
        $this->login();
        $task = Task::orderBy('created_at', 'desc')->limit(1)->first();
        $response = $this->withHeaders(['AUthorization' => 'Bearer '.$this->token])->json('GET', $this->path.'/'.$task->id.'/edit');
        $response->assertStatus(200);
    }

     /** @test **/
    public function task_update()
    {
        $this->login();
        $task = Task::orderBy('created_at', 'desc')->limit(1)->first();
        $data = [
            'user_id' => 1,
            'name' => 'Nombre de Tarea',
            'description' => 'Descripcion de tarea',
            'sprint' => 1,
            'dependencies' => 'INFOTECC',
            'hours' => '50',
            'project_id' => '2',
            'cat_size_id' => 3,
            'cat_phase_id' => 3,
            'cat_statuses_id' => 3,
            'employee_id' => '',
            'start_date' => '2022-05-18',
            'end_date' => '2022-05-30'
        ];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('PUT', $this->path.'/'.$task->id, $data);
        $response->assertStatus(200);
    }


     /** @test **/
    public function task_destroy()
    {
        $this->login();

        $task = Task::orderBy('created_at', 'desc')->limit(1)->first();
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('DELETE', $this->path.'/'.$task->id);
        $response->assertStatus(200);
    }

}
