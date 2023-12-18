@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="content p-3">
                 @foreach($tasks as $key => $task)
                 <td>{{ $key + 1 }}</td>
                    <h4>{{$task->title}}</h4>
                    <h6>{{$task->description}}</h6>

                   @endforeach
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
