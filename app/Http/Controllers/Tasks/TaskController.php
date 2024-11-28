<?php

namespace App\Http\Controllers\Tasks;


use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(): JsonResponse
    {
        try {
            return response()->json($this->taskService->getAllTasks());
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            return response()->json($this->taskService->getTaskById($id));
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'project_id' => 'required|exists:projects,id',
                'user_id' => 'nullable|exists:users,id',
                'name' => 'required|string|max:255',
                'status' => 'required|in:in_progress,completed',
                'due_date' => 'required|date',
            ]);

            return response()->json($this->taskService->createTask($data), 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $data = $request->validate([
                'project_id' => 'sometimes|required|exists:projects,id',
                'user_id' => 'nullable|exists:users,id',
                'name' => 'sometimes|required|string|max:255',
                'status' => 'sometimes|required|in:in_progress,completed',
                'due_date' => 'sometimes|required|date',
            ]);

            return response()->json($this->taskService->updateTask($id, $data));
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->taskService->deleteTask($id);
            return response()->json(null, 204);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
