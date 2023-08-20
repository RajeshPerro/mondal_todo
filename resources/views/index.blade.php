@extends('layout')

@section('main-content')
    <div>
        <div class="float-start">
            <h4 class="pb-3">My Tasks</h4>
        </div>
        <div class="float-end">
            <a href="{{ route('task.create') }}" class="btn btn-info">
                <i class="fas fa-plus-circle"></i> Create Task</a>
        </div>
        <div class="clearfix"></div>
    </div>

    @foreach ($tasks as $task)
        <div class="card mt-3">
            <div class="card-header h5">
                @if ($task->status === 'Todo')
                    {{ $task->title }}
                @else
                    <del>{{ $task->title }}</del>
                @endif
                <span class="badge rounded-pill text-bg-warning">{{ $task->created_at->diffForHumans() }}</span>
            </div>

            <div class="card-body">
                <div class="card-text">
                    <div class="float-start">
                        @if ($task->status === 'Todo')
                            {{ $task->description }}
                        @else
                            <del>{{ $task->description }}</del>
                        @endif
                        <br>

                        @if ($task->status === 'Todo')
                            <span class="badge rounded-pill text-bg-info">Todo</span>
                        @else
                            <span class="badge rounded-pill text-bg-success text-white">Done</span>
                        @endif
                        <small>Last Updated - {{ $task->updated_at->diffForHumans() }}</small>
                    </div>

                    <div class="float-end">
                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-success">
                            <i class="fas fa-edit"></i></a>

                        <form action="{{ route('task.destroy', $task->id) }}" style="display: inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    @endforeach

    @if (count($tasks) === 0)
        <div class="alert alert-danger p-2">
            No Task Found. Please create a task.
            <br><br>
            <a href="{{ route('task.create') }}" class="btn btn-info btn-sm"><i class="fas fa-plus-circle"></i> Create
                Task</a>
        </div>
    @endif
@endsection
