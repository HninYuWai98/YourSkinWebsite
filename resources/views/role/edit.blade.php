@extends('admin.layouts.app')

@section('content')

<section class="content-header bg-dark">
    <div class="container-fluid text-center">
        <h1 class="font-weight-bold">Edit Role</h1>
    </div>
</section>

<div class="card-body bg-dark text-white col-lg-6 col-md-8 col-sm-10 mx-auto mt-5 p-4 rounded-4">

    <form action="{{ route('roles.update', $role->id) }}" method="post">
        @csrf
        @method("PUT")

        {{-- Role Name --}}
        <div class="form-group col-10 mb-3 mx-auto">
            <label for="name" class="mb-1">Enter Role</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Permissions --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Permissions</label>
            <div class="row">
                @foreach ($permissions as $permission)
                    <div class="col-md-6 col-sm-12 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                value="{{ $permission->name }}" id="perm-{{ $permission->id }}"
                                {{ in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm-{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('permissions')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="mb-3 row">
            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
        </div>
    </form>

</div>

@endsection
