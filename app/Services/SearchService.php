<?php

namespace App\Services;


use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;


class SearchService
{
    /**
     * @var TaskRepository
     */
    public TaskRepository $taskRepository;
    public ProjectRepository $projectRepository;


    /**
     * @param TaskRepository $taskRepository
     * @param ProjectRepository $projectRepository
     */
    public function __construct(TaskRepository $taskRepository, ProjectRepository $projectRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param $search
     * @return mixed
     */
    public function searchProject($search): mixed
    {
         return $this->projectRepository->search($search);
    }

    /**
     * @param $projectId
     * @param $query
     * @return array
     */
    public function searchTask($projectId, $query): array
    {
        return $this->taskRepository->searchTask($projectId, $query);
    }

    /**
     * @param $projectId
     * @param $statusFilter
     * @return array
     */
    public function filterStatusTask($projectId, $statusFilter): array
    {
        return $this->taskRepository->filterStatus($projectId, $statusFilter);
    }
}
