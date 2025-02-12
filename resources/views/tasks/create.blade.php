@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 mt-5">Add New Task</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Task Title</label>
                    <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                </div>

                <!-- Due Date -->
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" required value="{{ old('due_date') }}">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Create Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
