@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card mb-3">
                    <div class="card-header">
                        Task
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="card-text">{{ $task->description }}</p>

                    </div>
                </div>
                <form class="mb-4" action="{{ route('comment.store') }}" method="post">
                    @csrf
                    <div class="form-control mb-2">
                        <textarea type="text" class="form-control mb-3" name="content" cols="30" placeholder="Add Comment" rows="4"></textarea>
                    </div>

                    <input type="hidden" name="task_id" value="{{ $task->id }}" >
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <h4>Comments</h4>
                @include('comments.commentDispaly', ['comments' => $task->comments, 'task_id' => $task->id])
            </div>
        </div>
    </div>


@endsection
