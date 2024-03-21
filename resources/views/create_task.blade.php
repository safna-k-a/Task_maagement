@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Task') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Task Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror mt-2" name="name" required autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <label for="status">{{ __('Status') }}</label>
                            <select id="status" class="form-control @error('status') is-invalid @enderror mt-2" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>

                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <label for="due_date">{{ __('Due Date') }}</label>
                            <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror mt-2" name="due_date" required>

                            @error('due_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">
                            {{ __('Add Task') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection