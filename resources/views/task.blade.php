@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card">
                <h5 class="p-2"><strong>{{ $project->name }}</strong> </h5>
                     <hr>
                 <div class="form-search-filter d-flex flex-row mb-3 p-3 " style="gap:5%">
                    <form  class="form-group w-75" action="{{ route('search.tasks', ['projectId' => $project->id]) }}" method="GET">
                        <input class="form-control mb-1" type="text" name="query" placeholder="Search tasks">
                        <button class="btn btn-primary float-right" type="submit">Search</button>
                    </form>

                    <div class="form-filter" >
                       <form action="{{ route('task.filter', ['projectId' => $project->id]) }}" method="GET">
                        <select class="form-select mb-1" name="status" id="status">
                            <option value="">Filter by Status:</option>
                            <option value="to_do" >To Do</option>
                            <option value="in_progress" >In Progress</option>
                            <option value="ready_for" >Ready For</option>
                            <option value="ready_for_test" >Ready For Test</option>
                               <option value="done" >Done</option>
                        </select>
                        <button  class="btn btn-primary" type="submit">Filter</button>
                    </form>
                    </div>

                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                     <div class="mb-4"><a style="float: right" class="btn btn-primary mb-2" href="{{ route('create.task', ['projectId' => $project->id]) }}">Create Task</a></div>
                    <table class="table" style="margin-top:-20px">
                        <thead>
                                <tr>
                                  <th>#</th>
                                 <th> Task Name</th>
                                 <th> Description</th>
                                 <th>Image</th>
                                 <th> Status</th>
                                 <th>Attach User</th>
                                 <th>Action</th>
                                </tr>

                        </thead>
                        <tbody>
                            @if (!empty($project))
                            @foreach ($tasks as $task)
                                <tr>
                                    <a href="">
                                    <th>{{$task->id}}</th>
                                    <td >{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    </a>
                                    @if(!is_null($task->image))
                                    <td><img width="100px" src="{{ asset('storage/images/' . $task->image) }}"></td>
                                    @else
                                    <td><img width="100px" src="https://t4.ftcdn.net/jpg/04/99/93/31/360_F_499933117_ZAUBfv3P1HEOsZDrnkbNCt4jc3AodArl.jpg"></td>
                                    @endif

                                    <td style="width:14%">
                                        @if($task->status == 'ready_for_test')
                                            Ready For Test
                                        @elseif($task->status == 'done')
                                            Done
                                        @elseif($task->status == 'in_progrees')
                                            In Progress
                                        @elseif($task->status == 'to_do')
                                            To Do
                                        @elseif($task->status == 'completed')
                                            Completed
                                        @endif
                                    </td>
                                        <td style="width:14%">
                                            @if(!is_null($task->user))
                                         {{$task->user->email}}
                                            @endif
                                       </td>
                                    <td style="width:6%">
                                       <a style="float: right; float: right; margin-right: 16px;" href="{{route('task.edit', ['id'=> $task->id])}} "><i style="float: right; font-size: 21px;cursor: pointer" class="fa fa-pencil"></i></a>
                                       <a style="float: right; float: right; margin-right: 16px;" href="{{route('task.delete', ['id' => $task->id])}}"><i style="float: right;font-size: 22px;" class="fa fa-trash-o"></i>
                                       <a style="float: right; float: right; margin-right: 16px;" href="{{route('task.comment', ['id' => $task->id])}}"><i style="font-size: 19px" class="fa fa-comment" aria-hidden="true"></i></a>
                                    </td>
                              </tr>
                            @endforeach
                          @else
                          <tr>
                             <td>Not Tasks in Projects</th>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                        <div class="d-flex justify-content-center">
                            {!! $tasks->links() !!}
                        </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
