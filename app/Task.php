<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'body', 'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function owner() {
        return $this->belongsTo('App\User');
    }
}
