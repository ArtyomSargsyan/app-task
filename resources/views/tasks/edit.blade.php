@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="success-message"  class="alert alert-secondary" role="alert" style="display: none; color: green;"></div>
                   <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                {{-- <div class="card-header mb-4">Task Create <a style="float: right;" class="btn btn-primary" href="{{ route('project.show', ['id'=> $projectId]) }}">Back</a></div> --}}

                                 <form action="{{ route('task.update', ['taskId'=> $task->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="title" value="{{$task->title}}" aria-describedby="emailHelp" placeholder="Enter title">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <textarea  class="form-control mb-3" name="description" cols="30" placeholder="Description" rows="4">{{$task->description}}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>

                                    <select class="status-dropdown form-select" data-task-id="{{ $task->id }}">
                                        <option value="to_do" {{ $task->status == 'to_do' ? 'selected' : '' }}>To Do</option>
                                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="ready_for_test" {{ $task->status == 'ready_for_test' ? 'selected' : '' }}>Ready for Test</option>
                                        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>completed</option>
                                    </select>

                                    <select class="status-dropdown-user form-select" data-task-id="{{ $task->id }}">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{ $user->id == $task->user_id ? 'selected' : '' }}>{{$user->email}}</option>
                                        @endforeach
                                    </select>

                                    <div class="form-group">
                                       <input type="file" class="form-control" name="image" >

                                       <img width="100px" src="{{ asset('storage/images/' . $task->image) }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

<script>
    $(document).ready(function () {
    $('.status-dropdown').change(function () {

        var taskId = $(this).data('task-id');
        var newStatus = $(this).val();

        $.ajax({
            url: '/tasks/update-status',
            type: 'POST',
            data: {
                taskId: taskId,
                status: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function (data) {
                console.log(data);

                $('#success-message').text('Task status updated successfully.');
                $('#success-message').show().delay(4000).fadeOut();
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});

$(document).ready(function () {
        $('.status-dropdown-user').change(function () {

            var taskId = $(this).data('task-id');
            var newTasks = $(this).val();

            $.ajax({
                url: '/tasks/attach-user',
                type: 'POST',
                data: {
                    taskId: taskId,
                    user: newTasks,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    console.log(data);

                    $('#success-message').text('Attach user successfully.');
                    $('#success-message').show().delay(4000).fadeOut();
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
</script>

