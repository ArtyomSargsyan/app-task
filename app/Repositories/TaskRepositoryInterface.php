<?php

namespace  App\Repositories;

interface TaskRepositoryInterface
{
      public function byProjectId($id);
      public function store($projectId, $fileName, $title, $description);
      public function edit($id);
      public function update($id, $title, $description, $image);
      public function generateImageName($image);
      public function updateStatus($taskId, $status);
      public function delete($id);
      public function searchTask($projectId, $query);
      public function filterStatus($projectId, $statusFilter);
      public function addUserTask($taskId, $user);
}
