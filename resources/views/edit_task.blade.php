@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Task') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.update', ['task' => $task->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="name">{{ __('Task Name') }}</label>
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror mt-2" name="name" value="{{ old('name', $task->name) }}" required autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="status">{{ __('Status') }}</label>
                            <select id="status" class="form-control @error('status') is-invalid @enderror mt-2" name="status" required>
                                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>

                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-groupmb-4">
                            <label for="due_date">{{ __('Due Date') }}</label>
                            <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror mt-2" name="due_date" value="{{ old('due_date', $task->due_date) }}" required>

                            @error('due_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mb-4">
                            {{ __('Update Task') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection