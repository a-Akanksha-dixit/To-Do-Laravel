<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Tasks extends Model
{
    use HasFactory;
    protected $primaryKey = 'task_id';
    protected $attributes = [
        'status' => 'pending'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id')->withTimestamps();
    }
}
