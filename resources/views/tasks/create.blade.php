@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                   <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="card-header mb-4">Task Create <a style="float: right;" class="btn btn-primary" href="{{ route('project.show', ['id'=> $projectId]) }}">Back</a></div>

                                <form action="{{ route('task.store', ['projectId'=> $projectId]) }}" method="Post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="title" aria-describedby="emailHelp" placeholder="Enter title">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <textarea  class="form-control mb-3" name="description" cols="30" placeholder="Description" rows="4"></textarea>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                       <input type="file" class="form-control" name="image" >
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
