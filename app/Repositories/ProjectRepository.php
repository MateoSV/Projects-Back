<?php

namespace App\Repositories;

use App\Interfaces\Projects\ProjectRepositoryInterface;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function all(): Collection
    {
        return Project::all();
    }

    public function find($id): Project
    {
        return Project::findOrFail($id);
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update(array $data, $id): Project
    {
        $project = $this->find($id);
        $project->update($data);
        return $project;
    }

    public function delete($id): void
    {
        $project = $this->find($id);
        $project->delete();
    }
}
