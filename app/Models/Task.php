<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_name',
        'description',
        'status',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function isCompleted(): bool
    {
        return $this->status === 'Completed';
    }

    public function isPending(): bool
    {
        return $this->status === 'Pending';
    }

    public function getNextStatus(): string
    {
        return $this->isCompleted() ? 'Pending' : 'Completed';
    }
}