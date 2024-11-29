<?php

namespace App\Services;

use App\Interfaces\Tasks\TaskServiceInterface;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskService implements TaskServiceInterface
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks(): Collection
    {
        return $this->taskRepository->all();
    }

    public function getTaskById($id): Task
    {
        return $this->taskRepository->find($id);
    }

    public function createTask(array $data)
    {
        return $this->taskRepository->create($data);
    }

    public function updateTask($id, array $data)
    {
        return $this->taskRepository->update($data, (int)$id);
    }

    public function deleteTask($id): void
    {
        $this->taskRepository->delete($id);
    }

    public function getUserTasks(int $userId): Collection
    {
        return $this->taskRepository->getUserTasks($userId);
    }

    public function getProjectTasks(int $projectId): Collection
    {
        return $this->taskRepository->getProjectTasks($projectId);
    }
}
