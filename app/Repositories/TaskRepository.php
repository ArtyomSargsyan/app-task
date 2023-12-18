<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Storage;


class TaskRepository  implements  TaskRepositoryInterface
{

    /**
     * @var Task
     */
    public Task $project;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @param $id
     * @return array
     */
    public function byProjectId($id)
    {
        $project = Project::find($id);
        $tasks = $project->tasks()->orderBy('created_at', 'desc')->paginate(10);

        return ['project' => $project, 'tasks' => $tasks];
    }

    /**
     * @param $projectId
     * @param $fileName
     * @param $title
     * @param $description
     * @return void
     */
    public function store($projectId, $fileName, $title, $description)
    {

        $this->task::create([
            'title' => $title,
            'description' => $description,
            'image' => $fileName,
            'project_id' => $projectId
        ]);

    }

    /**
     * @param $id
     * @return array
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $users = User::all();

        return ['task' => $task, 'users' => $users];
    }

    /**
     * @param $id
     * @param $title
     * @param $description
     * @param $image
     * @return void
     */
    public function update($id, $title, $description, $image)
    {
          $task = $this->task::find($id);
          $this->task->update($title, $description);

            if (!is_null($image)) {
                Storage::disk('public')->delete('images/' . $task->image);

                $newImage = $image;
                $fileName = $this->generateImageName($newImage);
                $newImage->storeAs('images', $fileName, 'public');


                $task->update(['image' => $fileName]);
            }
    }

    /**
     * @param $image
     * @return string
     */
    public function generateImageName($image)
    {

        return time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    }

    /**
     * @param $taskId
     * @param $status
     * @return void
     * @throws \Exception
     */
    public function updateStatus($taskId, $status)
    {
        $task = $this->task::findOrFail($taskId);
        if($status == 'in_progress') {
            $task->status = $status;
            $task->start_time =  new DateTime("now", new DateTimeZone('Asia/Yerevan'));

        }elseif($status == 'completed'){
            $task->status = $status;
            $task->end_time = new DateTime("now", new DateTimeZone('Asia/Yerevan'));
        }else{
            $task->status = $status;
        }
        $task->save();
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        $task = $this->task::find($id);
        if ($task->image) {
            Storage::disk('public')->delete('images/' . $task->image);
        }

        $task->delete();
    }

    /**
     * @param $projectId
     * @param $query
     * @return array
     */
    public function searchTask($projectId, $query)
    {
        $project = Project::findOrFail($projectId);

        $tasks = $project->tasks()
            ->where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        return ['project' => $project, 'tasks' => $tasks];
    }

    /**
     * @param $projectId
     * @param $statusFilter
     * @return array
     */
    public function filterStatus($projectId, $statusFilter)
    {
        $project = Project::findOrFail($projectId);

        $tasks = $project->tasks();
        if ($statusFilter) {
            $tasks->where('status', $statusFilter);
        }
        $tasks = $tasks->get();

        return ['project' => $project, 'tasks' => $tasks];
    }

    /**
     * @param $taskId
     * @param $user
     * @return void
     */
    public function addUserTask($taskId, $user)
    {
        $task = Task::find($taskId);

        $task->user_id = $user;
        $task->save();
    }
}
