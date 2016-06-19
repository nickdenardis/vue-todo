<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TodoTest extends TestCase
{
    use DatabaseMigrations;

    /**
    * @test
    *
    * Test: GET /api
    */
    public function it_should_explain_itself()
    {
        $this->seed('TodoTableSeeder');

        $this->get('/api')
            ->seeJson([
                'Tasks' => 'Everything you need to do!'
            ]);
    }

    /**
     * @test
     *
     * Test: GET /api/todo
     */
    public function it_should_return_a_list_of_todos()
    {
        $this->seed('TodoTableSeeder');

        $this->get('/api/tasks')
            ->seeJsonStructure([
                'data' => [
                    '*' => [
                        'body', 'completed',
                    ]
                 ]
            ]);
    }

    /**
     * @test
     *
     * Test: GET /api/task/1
     */
    public function it_fetches_a_single_task()
    {
        $this->seed('TodoTableSeeder');

        $this->get('/api/tasks/1')
            ->seeJson([
                'data' => [
                    'id' => 1,
                    'user_id' => 1,
                    'body' => 'First task',
                    'completed' => true
                ]
            ]);
    }

    /**
     * @test
     *
     * Test: GET /api/authenticate
     */
    public function it_authenticate_a_user()
    {
        $user = factory(App\User::class)->create(['password' => bcrypt('foo')]);

        $this->post('/api/authenticate', ['email' => $user->email, 'password' => 'foo'])
             ->seeJsonStructure(['token']);
    }

    /**
     * @test
     *
     * TEST: POST /api/tasks
     */
    public function it_saves_a_task()
    {
        $user = factory(App\User::class)->create(['password' => bcrypt('foo')]);

        $task = [
            'body' => 'Added a task by api',
        ];

        $this->post('api/tasks', $task, $this->headers($user))
            ->seeStatusCode(201);
    }

    /**
     * @test
     *
     * Test: POST /api/tasks
     */
    public function it_401s_when_not_authorized()
    {
        $task = factory(App\Task::class)->create()->toArray();

        $this->post('api/tasks', $task)
            ->seeStatusCode(401);
    }

    /**
     * @test
     *
     * TEST: POST /api/tasks
     */
    public function it_422_when_validation_fails()
    {
        $user = factory(App\User::class)->create(['password' => bcrypt('foo')]);

        $task = ['body' => 'Valid body'];

        $this->post('/api/tasks', $task, $this->headers($user))
             ->seeStatusCode(201);

        $this->post('/api/tasks', [], $this->headers($user))
             ->seeStatusCode(422);
    }

    /**
     * @test
     *
     * TEST: DELETE /api/tasks
     */
    public function it_deletes_a_task()
    {
        $user = factory(App\User::class)->create(['password' => bcrypt('foo')]);

        $task = factory(App\Task::class)->create();

        $this->delete('api/tasks/' . $task->id, [], $this->headers($user))
            ->seeStatusCode(204);
    }
}
