<!-- resources/views/users/index.blade.php -->
@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Users List
        <button type="button" id="createUserModalButton" class="btn btn-primary btn-sm col-sm-2" data-toggle="modal" data-target="#createUserModal">
            Create New User
        </button>

    </h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('users.index') }}" method="GET" class="form-inline mb-3">
        <div class="form-group mr-3">
            <label for="name" class="mr-2">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
        </div>
        <div class="form-group mr-2">
            <label for="email" class="mr-2">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ request('email') }}">
        </div>
        <div class="form-group mr-2">
            <label for="status" class="mr-2">Status:</label>
            <select class="form-control" id="status" name="status">
                <option value="">All</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Is Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->isActive ? 'Yes' : 'No' }}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                        Edit
                    </button>

                    <form action="{{ route('user.status', $user) }}" method="POST" style="display:inline;">

                        @csrf
                        {{ method_field('PATCH') }}
                        
                        @if($user->isActive)
                        <button type="submit" class="btn btn-danger btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ban" viewBox="0 0 16 16">
                                <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                            </svg>
                        </button>
                        @else
                        <button type="submit" class="btn btn-success btn-sm">
                            Activate
                        </button>
                        @endif

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('users.create')
@include('users.edit')
@endsection