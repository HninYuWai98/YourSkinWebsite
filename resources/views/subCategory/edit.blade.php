@extends('admin.layouts.app')

@section('content')
    <section class="content-header bg-dark">
        <div class="container-fluid text-center">
            <h1 class="font-weight-bold">Edit Role</h1>
        </div>
    </section>

    <div class="card-body bg-dark text-white col-5 mx-auto mt-5 p-4">

        <form action="{{ route('subCategories.update', $subCategory->uuid) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ $subCategory->name }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="form-label fw-semibold">Role</label>
                <select name="category_id" id="category_id" class="form-control rounded-3">
                    <option value="" selected disabled>Choose category...</option>
                    @foreach ($categories as $category)
                        <option @if ($subCategory->category_id == $category->id) selected @endif value={{ $category->id }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
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
