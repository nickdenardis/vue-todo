<?php

use App\Task;
use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::unguard();
        DB::table('tasks')->delete();
        $tasks = [
            ['user_id' => 1, 'body' => 'First task', 'completed' => true],
            ['user_id' => 1, 'body' => 'Second task', 'completed' => false],
            ['user_id' => 1, 'body' => 'Third task', 'completed' => false],
        ];
        // Loop through fruits above and create the record in DB
        foreach ($tasks as $task) {
            Task::create($task);
        }
        Task::reguard();
    }
}
