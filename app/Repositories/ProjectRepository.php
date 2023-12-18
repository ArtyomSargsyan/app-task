<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProjectRepository  implements  ProjectRepositoryInterface
{

    /**
     * @var Project
     */
    public Project $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function allProjects()
    {
       return Project::orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * @param $name
     * @return void
     */
    public function store($name)
    {
        $this->project::create([
            'name' => $name
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
      return $this->project->find($id);
    }

    /**
     * @param $id
     * @param $name
     * @return void
     */
    public function update($id, $name)
    {
        $project = $this->project::find($id);
        $project->name = $name;

        $project->save();

    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        $this->project::find($id)->delete();
    }

    /**
     * @param $search
     * @return mixed
     */
    public function search($search)
    {
       return $this->project::where('name', 'like', '%' . $search . '%')->paginate(10);
    }



}
