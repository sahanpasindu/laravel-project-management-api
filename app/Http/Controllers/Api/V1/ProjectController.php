<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::where('owner_id', auth()->id())
            ->latest()
            ->paginate(10);

        return ProjectResource::collection($projects)
            ->additional(['message' => 'Projects retrieved successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request)
    {
        $project = Project::create([
            ...$request->validated(),
            'owner_id' => auth()->id(),
        ]);

        return response()->json([
            'data' => new ProjectResource($project),
            'message' => 'Project created successfully.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorizeOwnership($project);

        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $this->authorizeOwnership($project);

        $project->update($request->validated());

        return response()->json([
            'data' => new ProjectResource($project),
            'message' => 'Project updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorizeOwnership($project);

        $project->delete();

        return response()->json(['message' => 'Project deleted.'], 204);
    }

    private function authorizeOwnership(Project $project)
    {
        if ($project->owner_id !== auth()->id()) {
            abort(403, 'Unauthorized.');
        }
    }
}
