@extends('admin.layouts.app')

@section('content')
    {{-- Page Header --}}
    <section class="content-header py-4 bg-dark text-white shadow-sm">
        <div class="container-fluid text-center">
            <h1 class="fw-bold mb-0">Create Satff</h1>
        </div>
    </section>

    {{-- Form Card --}}
    <div class="card bg-dark text-white border-0 shadow-lg col-lg-6 col-md-8 col-sm-10 mx-auto mt-5 rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Name --}}
                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Full Name</label>
                    <input type="text" class="form-control rounded-3" id="name" name="name"
                        placeholder="Enter full name" value="{{ old('name') }}" autocomplete="off">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input type="email" class="form-control rounded-3" id="email" name="email"
                        placeholder="Enter email" value="{{ old('email') }}" autocomplete="off" autocorrect="off"
                        autocapitalize="none">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control rounded-3" id="password" name="password"
                        placeholder="Enter password" autocomplete="new-password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                {{-- Role --}}
                <div class="mb-4">
                    <label for="role_id" class="form-label fw-semibold">Role</label>
                    <select name="role_id" id="role_id" class="form-control rounded-3">
                        <option value="" selected disabled>Choose role...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3">
                        Add Staff
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
