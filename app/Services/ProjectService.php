<?php

namespace App\Services;


use App\Repositories\ProjectRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class ProjectService
{
    /**
     * @var ProjectRepository
     */
    public ProjectRepository $projectRepository;


    /**
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @return mixed
     */
    public function getAllProjects(): mixed
    {
       return $this->projectRepository->allProjects();
    }

    /**
     * @param $name
     * @return void
     */
    public function storeProject($name)
    {
         $this->projectRepository->store($name);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function editProject($id): mixed
    {
        if ($id){
            return $this->projectRepository->edit($id);
        }else{
            abort(404, 'ID not found');
        }


    }

    /**
     * @param $id
     * @param $name
     * @return void
     */
    public function updateProject($id, $name)
    {
        if ($id){
            $this->projectRepository->update($id, $name);
        }else{
            abort(404, 'ID not found');
        }

    }

    /**
     * @param $id
     * @return void
     */
    public function projectDelete($id)
    {
        if ($id){
            $this->projectRepository->delete($id);
        }else{
            abort(404, 'ID not found');
        }

    }

}
