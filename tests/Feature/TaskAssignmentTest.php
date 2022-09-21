<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskAssignmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public $path = '/api/task-assignments';
    public $token = '';

    public function login()
    {
        $user = User::where( 'username', 'marcosp' )->first();
        Auth::loginUsingId( $user->id );
        $this->token = $user->createToken( 'sci_session' )->accessToken;
    }


    /** @test **/
    public function task_assignment_index()
    {
        $this->login();
        $data = ['search' => '1'];
        $response = $this->withHeaders(['Authorization' => 'Bearer '.$this->token])->json('GET', $this->path, $data);
        $response->assertStatus(200);
    }
}
