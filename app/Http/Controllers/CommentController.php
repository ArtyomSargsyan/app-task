<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    protected CommentService $commentService;

    /**
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

        $task = $this->commentService->getById($id);

        return view('comments.view')->with([
            'task' => $task
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $this->commentService->store($request->input('content'), $request->input('task_id'));

        session()->flash('success', 'Your comment created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment, $id)
    {
        $this->commentService->delete($id);

        session()->flash('success', 'Your comment delete successfully');

        return redirect()->back();

    }

    public function replayComment(CommentRequest $request): RedirectResponse
    {

        $this->commentService->commentReplay($request->input('content'), $request->input('parent_id'), $request->input('task_id'));

        session()->flash('success', 'Your comment created successfully');

        return redirect()->back();
    }
}
