<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Services\SearchService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected SearchService $searchService;

    /**
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function searchProject(Request $request)
    {
         $projects = $this->searchService->searchProject($request->search);

         return view('dashboard')->with(['projects'=> $projects]);
    }

    /***
     * @param Request $request
     * @param $projectId
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function searchTask(Request $request, $projectId)
    {

        $result =  $this->searchService->searchTask($projectId, $request->input('query'));

        ['project' => $project, 'tasks' => $tasks] = $result;

        return view('task')->with(['project'=> $project,'tasks' => $tasks]);
    }

    public function filterStatusTask(Request $request, $projectId): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $project = Project::findOrFail($projectId);

        $this->searchService->filterStatusTask($projectId, $request->input('status'));


        return view('task')->with(['project'=> $project, 'tasks'=> $tasks]);
    }

}
