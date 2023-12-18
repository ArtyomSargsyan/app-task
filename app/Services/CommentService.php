<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;


class CommentService
{
    /**
     * @var CommentRepository
     */

    protected CommentRepository $commentRepository;


    /**
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        if ($id){
            return $this->commentRepository->commentById($id);
        }else{
            abort(404, 'ID not found');
        }

    }

    public function getCommentById($id)
    {
        return $this->commentRepository->getCommentId($id);
    }

    /**
     * @param string $content
     * @return mixed
     */
    public function store(string $content,  $taskId): mixed
    {
        $userId = Auth::user()->id;

        $this->commentRepository->store($content, $taskId, $userId);
    }

    public function delete($id)
    {
        $this->commentRepository->delete($id);
    }

    /**
     * @param $content
     * @param $parentId
     * @param $blogId
     * @return void
     */
    public function commentReplay($content, $parentId, $taskId)
    {

        $userId = Auth::user()->id;
        return $this->commentRepository->commentReplay($content, $parentId, $taskId, $userId);
    }

}
