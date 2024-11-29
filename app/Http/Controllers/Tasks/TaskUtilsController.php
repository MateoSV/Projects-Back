<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskUtilsController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function getUserTasks($userId): JsonResponse
    {
        try {
            $userId = (int)$userId;

            return response()->json($this->taskService->getUserTasks($userId), 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getProjectTasks($projectId): JsonResponse
    {
        try {
            $projectId = (int)$projectId;

            return response()->json($this->taskService->getProjectTasks($projectId), 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
