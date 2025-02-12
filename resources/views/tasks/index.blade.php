@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 mt-5">Task Management</h1>

    <!-- Navigation Buttons -->
    <div class="mb-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">All Tasks</a>
        <a href="{{ route('tasks.index', ['status' => 'Pending']) }}" class="btn btn-warning">Pending</a>
        <a href="{{ route('tasks.index', ['status' => 'Completed']) }}" class="btn btn-success">Completed</a>
    </div>

    <!-- Tasks Table -->
    <div class="card">
        <div class="card-header">Your Tasks</div>
        <div class="card-body">
            @if ($tasks->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>
                                    <span class="badge {{ $task->status == 'Completed' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $task->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                                    </form>
                                    @if ($task->status == 'Pending')
                                        <form action="{{ route('tasks.complete', $task->id, 'complete') }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                {{ $tasks->links() }}
            @else
                <p class="text-center">No tasks found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
