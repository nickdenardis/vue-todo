<?php

namespace App\Transformers;

use App\Task;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{
    public function transform(Task $task)
    {
        return [
            'id'        => (int) $task->id,
            'user_id'   => (int) $task->user_id,
            'body'      => $task->body,
            'completed' => (bool) $task->completed,
        ];
    }
}
