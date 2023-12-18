<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskService $taskService;

    /**
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $result =  $this->taskService->tasksByProjectId($id);

        if ($result === null) {
            abort(404, 'Project not found');
        }

        ['project' => $project, 'tasks' => $tasks] = $result;

        return view('task')->with(['tasks' => $tasks, 'project'=> $project]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($projectId)
    {
        return view('tasks.create')->with(['projectId' => $projectId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, $projectId)
    {
       $this->taskService->storeTask($projectId,  $request->file('image'),$request->input('title'),$request->input('description'));

       session()->flash('success', 'Your task create successfully');

       return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task, $id)
    {
        $result =  $this->taskService->editTask($id);

        ['task' => $task, 'users' => $users] = $result;

        return view('tasks.edit')->with(['task'=> $task, 'users' => $users]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task, $id)
    {
        $this->taskService->updateTask($id, $request->input('title'),$request->input('description'), $request->file('image'));

        session()->flash('success', 'Your task update successfully');

        return redirect()->back();
    }

    public function updateStatus(Request $request): JsonResponse
    {

        $this->taskService->updateStatus($request->input('taskId'), $request->input('status'));

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, $id)
    {

       $this->taskService->delete($id);

       session()->flash('success', 'Task delete successfully');

       return redirect()->back();

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function attachUser(Request $request): JsonResponse
    {
        $this->taskService->attachUser($request->input('taskId'),$request->input('user') );

        return response()->json(['success' => true]);
    }
}
