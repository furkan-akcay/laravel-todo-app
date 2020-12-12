<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createProject($request)
    {
        return $this->create([
            'user_id' => auth()->user()->id,
            'title' => $request['title'],
            'description' => $request['description']
        ]);
    }

    public function updatedAt()
    {
        return date('H:i d.m.Y', strtotime($this->updated_at));
    }
}
