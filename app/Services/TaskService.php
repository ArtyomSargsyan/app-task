<?php

namespace App\Services;


use App\Repositories\TaskRepository;


class TaskService
{
    /**
     * @var TaskRepository
     */
    public TaskRepository $taskRepository;


    /**
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param $id
     * @return array|void
     */
    public function tasksByProjectId($id)
    {
        if ($id){
            return $this->taskRepository->byProjectId($id);
        }else{
            abort(404, 'ID not found');
        }

    }

    /**
     * @param $projectId
     * @param $image
     * @param $title
     * @param $description
     * @return void
     */
    public function storeTask($projectId, $image, $title, $description)
    {

        $fileName = $image ? $this->generateImageName($image) : null;

        if ($image) {
            $image->storeAs('images', $fileName, 'public');
        }

        $this->taskRepository->store($projectId, $fileName, $title, $description);
    }

    /**
     * @param $image
     * @return string
     */
    private function generateImageName($image)
    {

        return time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    }

    /**
     * @param $id
     * @return array|void
     */
    public function editTask($id)
    {
        if ($id) {
            return $this->taskRepository->edit($id);
        }else {
            abort(404, 'ID not found');
        }

    }

    /**
     * @param $id
     * @param $title
     * @param $description
     * @param $image
     * @return void
     */
    public function updateTask($id, $title, $description, $image)
    {
        $this->taskRepository->update($id, $title, $description, $image);

    }

    /**
     * @param $taskId
     * @param $status
     * @return void
     * @throws \Exception
     */
    public function updateStatus($taskId, $status)
    {
         $this->taskRepository->updateStatus($taskId, $status);
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        if ($id){
            $this->taskRepository->delete($id);
        }else{
            abort(404, 'ID not found');
        }
    }

    /**
     * @param $taskId
     * @param $user
     * @return void
     */
    public function attachUser($taskId, $user)
    {
        $this->taskRepository->addUserTask($taskId, $user);
    }

}
