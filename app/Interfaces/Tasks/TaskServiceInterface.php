<?php

namespace App\Interfaces\Tasks;

interface TaskServiceInterface
{
    public function getAllTasks();
    public function getTaskById($id);
    public function createTask(array $data);
    public function updateTask($id, array $data);
    public function deleteTask($id);
    public function getUserTasks(int $userId);
    public function getProjectTasks(int $projectId);
}
