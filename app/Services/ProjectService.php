<?php

namespace App\Services;

use App\Interfaces\Projects\ProjectServiceInterface;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Database\Eloquent\Collection;

class ProjectService implements ProjectServiceInterface
{
    protected ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllProjects(): Collection
    {
        return $this->projectRepository->all();
    }

    public function getProjectById($id): Project
    {
        return $this->projectRepository->find($id);
    }

    public function createProject(array $data)
    {
        return $this->projectRepository->create($data);
    }

    public function updateProject($id, array $data)
    {
        return $this->projectRepository->update($id, $data);
    }

    public function deleteProject($id): void
    {
        $this->projectRepository->delete($id);
    }
}
