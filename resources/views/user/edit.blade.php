@extends('admin.layouts.app')

@section('content')
    <section class="content-header bg-dark">
        <div class="container-fluid text-center">
            <h1 class="font-weight-bold">Edit Employee</h1>
        </div>
    </section>

    <div class="card-body bg-dark text-white col-5 mx-auto mt-5 p-4">

        <form action="{{ route('users.update', $user->uuid) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ $user->name }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ $user->email }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="mb-4">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control rounded-3" id="password" name="password"
                    placeholder="Enter new password (leave blank to keep current)" autocomplete="new-password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="role_id" class="form-label fw-semibold">Role</label>
                <select name="role_id" id="role_id" class="form-control rounded-3">
                    <option value="" selected disabled>Choose role...</option>
                    @foreach ($roles as $role)
                        <option @if ($user->role_id == $role->id) selected @endif value={{ $role->id }}>
                            {{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 row">
                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
            </div>
        </form>

    </div>
    </div>
@endsection
