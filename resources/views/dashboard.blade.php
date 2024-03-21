@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Session::has('success'))
        <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(Session::has('error'))
        <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <!-- Navigation Section -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">Navbar</a>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Home</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="btn btn-primary btn-sm" href="{{ route('create') }}">
                                            <i class="fas fa-plus-circle mr-2"></i>Add Task
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Logout') }}</button>
                                        </form>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </nav>
                </div>

                <div class="card-body">
                    <!-- Search Box -->
                    <form action="{{ route('search') }}" method="POST" class="mb-3" id="searchForm">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Task Name..." name="search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tasks List Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Task Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($createdTasks))
                            @foreach ($createdTasks as $task)
                            <tr>
                                <td>{{ $task->name }}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('assign_view', $task->id) }}" class="btn btn-primary btn-sm">Assign</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    document.getElementById('searchForm').addEventListener('submit', function() {
        this.reset();
    });
</script>