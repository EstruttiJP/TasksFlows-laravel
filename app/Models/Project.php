<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'creator',
        'description',
        'deadline',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
