<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /projects/{project}/tasks
     */
    public function index(Project $project)
    {
        $this->authorizeProject($project);
        $tasks = $project->tasks()->latest()->paginate(10);
        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     * POST /projects/{project}/tasks
     */
    public function store(TaskStoreRequest $request, Project $project)
    {
        $this->authorizeProject($project);

        $task = $project->tasks()->create($request->validated());
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     * GET /tasks/{task}
     */
    public function show(Task $task)
    {
        $this->authorizeProject($task->project);
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     * PUT /tasks/{task}
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $this->authorizeProject($task->project);
        $task->update($request->validated());
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /tasks/{task}
     */
    public function destroy(Task $task)
    {
        $this->authorizeProject($task->project);
        $task->delete();
        return response()->json(['message' => 'Task deleted.'], 204);
    }

    private function authorizeProject(Project $project)
    {
        if ($project->owner_id !== auth()->id()) {
            abort(403, 'Unauthorized.');
        }
    }
}
