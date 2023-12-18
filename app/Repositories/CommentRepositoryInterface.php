<?php

namespace  App\Repositories;


interface CommentRepositoryInterface
{
    public function commentById($id);
    public function store($content, $taskId, $userId);
    public function delete($id);
    public function commentReplay($content, $parentId, $taskId, $userId);
}
