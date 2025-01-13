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
            'Pending' => 'text-red-500', // Vermelho
            'In progress' => 'text-yellow-500', // Amarelo
            'Completed' => 'text-blue-500', // Azul
        ];

        return $statusColors[$this->status];
    }


    public function getStatusIconAttribute()
    {
        $statusIcon = [
            'Pending' => 'fa-hourglass-start',
            'In progress' => 'fa-spinner fa-spin',
            'Completed' => 'fa-check-circle',
        ];

        return $statusIcon[$this->status] ?? 'fa-question-circle';
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
