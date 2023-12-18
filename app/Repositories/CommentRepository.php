<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class CommentRepository  implements  CommentRepositoryInterface
{

    /**
     * @var Comment
     */
    protected Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function commentById($id): mixed
    {
        return Task::find($id);
    }

    /**
     * @param $content
     * @param $taskId
     * @param $userId
     * @return void
     */
    public function store($content, $taskId, $userId)
    {

        $comment = new $this->comment;
        $comment->content = $content;
        $comment->task_id = $taskId;
        $comment->user_id = $userId;

        $comment->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        $comment= $this->comment->find($id);
        return  $comment->delete();

    }

    /**
     * @param $content
     * @param $parentId
     * @param $blogId
     * @param $userId
     * @return void
     */
    public function commentReplay($content, $parentId, $taskId, $userId)
    {

        $comment = new $this->comment;
        $comment->content = $content;
        $comment->parent_id = $parentId;
        $comment->task_id = $taskId;
        $comment->user_id = $userId;

        $comment->save();
    }
}
