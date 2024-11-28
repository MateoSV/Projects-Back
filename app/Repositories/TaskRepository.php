<?php

namespace App\Repositories;

use App\Interfaces\Tasks\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function all(): Collection
    {
        return Task::all();
    }

    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(array $data, $id)
    {
        $task = $this->find($id);
        $task->update($data);
        return $task;
    }

    public function delete($id): void
    {
        $task = $this->find($id);
        $task->delete();
    }
}