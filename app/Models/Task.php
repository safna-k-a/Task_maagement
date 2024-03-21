<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status', 'due_date', 'user_id', 'assigned_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
