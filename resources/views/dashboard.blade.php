@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('search') }}" method="get" class="mb-4">
                        @csrf
                        <input type="text" class="form-control mb-2" placeholder="Find project here" value="{{ request('search') }}" name="search">
                        <button type="send" class="btn btn-primary">Search</button>
                    </form>
                    <div class="mb-4"><a style="float: right" class="btn btn-primary mb-2" href="{{ route('create.project') }}">Create Project</a></div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Projects</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                            <tr>
                               <td scope="col"><a style="text-decoration:none;color:black" href="{{ route('project.show', ['id' => $project->id]) }}">{{ $project->name }}</a></td>
                               <td style="width:6%">
                                  <a style="float: right; float: right; margin-right: 16px;" href="{{route('project.edit', ['id'=> $project->id])}} "><i style="float: right; font-size: 21px;cursor: pointer" class="fa fa-pencil"></i></a>
                                  <a style="float: right; float: right; margin-right: 16px;" href="{{route('project.delete', ['id' => $project->id])}}"><i style="float: right;font-size: 22px;" class="fa fa-trash-o"></i>
                               </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center">
                        {!! $projects->links() !!}
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
