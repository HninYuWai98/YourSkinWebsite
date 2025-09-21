@extends('admin.layouts.app')

@section('content')
    <section class="content-header bg-dark">
        <div class="container-fluid text-center">
            <h1 class="font-weight-bold">Edit Brand</h1>
        </div>
    </section>

    <div class="card-body bg-dark text-white col-5 mx-auto mt-5 p-4">

        <form action="{{ route('brands.update', $brand->uuid) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Brand Name --}}
            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">Brand Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $brand->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Brand Image --}}
            <div class="mb-4">
                <label for="image" class="form-label fw-semibold">Brand Image (Logo)</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Show current image --}}
                @if($brand->image)
                    <div class="mt-2">
                        <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}" width="100" class="rounded">
                    </div>
                @endif
            </div>

            {{-- Submit --}}
            <div class="mb-3 row">
                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
            </div>
        </form>

    </div>
@endsection
