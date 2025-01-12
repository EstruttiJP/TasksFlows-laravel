<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'status',
        'creator',
        'description',
        'deadline',
        'project_id'
    ];

    public function getStatusColorAttribute()
    {
        $statusColors = [
            'Pending' => 'text-red-500',
            'In progress' => 'text-blue-500',
            'Completed' => 'text-green-500',
        ];

        return $statusColors[$this->status];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
