@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                   <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="card-header mb-4">Project Create <a style="float: right;" class="btn btn-primary" href="{{ route('dashboard')}}">Back</a></div>

                                <form action="{{ route('project.store') }}" method="Post">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Enter name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<
        </div>
@endsection
