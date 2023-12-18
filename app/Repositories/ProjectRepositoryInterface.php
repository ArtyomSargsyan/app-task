<?php

namespace  App\Repositories;

interface ProjectRepositoryInterface
{
      public function allProjects();
      public function edit($id);
      public function store($name);
      public function update($id, $name);
      public function delete($id);
      public function search($search);
}
