<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    /**
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $projects = $this->projectService->getAllProjects();

        return view('dashboard')->with(['projects' =>$projects]);
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function create(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('projects.create');
    }

    /**
     * @param ProjectRequest $request
     * @return RedirectResponse
     */
    public function store(ProjectRequest $request)
    {
        $this->projectService->storeProject($request->input('name'));

        session()->flash('success', 'Your project created successfully');

        return redirect()->back();
    }


    /**
     * @param Project $project
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Project $project, $id): \Illuminate\Foundation\Application|View|Factory|Application
    {

        $project = $this->projectService->editProject($id);

        return view('projects.edit')->with(['project' => $project]);
    }

    /**
     * @param ProjectRequest $request
     * @param Project $project
     * @param $id
     * @return RedirectResponse
     */
    public function update(ProjectRequest $request, Project $project, $id)
    {

        $this->projectService->updateProject($id, $request->input('name'));

        session()->flash('success', 'Your project update successfully');

        return redirect()->back();

    }

    /**
     * @param Project $project
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(Project $project, $id): RedirectResponse
    {
        $this->projectService->projectDelete($id);

        session()->flash('success', 'Your project delete successfully');

        return redirect()->back();
    }
}
