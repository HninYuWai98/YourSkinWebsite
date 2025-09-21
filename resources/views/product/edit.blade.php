@extends('admin.layouts.app')

@section('content')
    <section class="content-header bg-dark">
        <div class="container-fluid text-center">
            <h1 class="font-weight-bold">Edit Role</h1>
        </div>
    </section>

    <div class="card-body bg-dark text-white col-5 mx-auto mt-5 p-4">

        <form action="{{ route('products.update', $product->uuid) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ $product->name }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="sub_category_id" class="form-label fw-semibold">SubCategory</label>
                <select name="sub_category_id" id="sub_category_id" class="form-control rounded-3">
                    <option value="" selected disabled>Choose subCategory...</option>
                    @foreach ($subCategories as $subCategory)
                        <option @if ($product->sub_category_id == $subCategory->id) selected @endif value={{ $subCategory->id }}>
                            {{ $subCategory->name }}</option>
                    @endforeach
                </select>
                @error('sub_category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="brand_id" class="form-label fw-semibold">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control rounded-3">
                    <option value="" selected disabled>Choose brand...</option>
                    @foreach ($brands as $brand)
                        <option @if ($product->brand_id == $brand->id) selected @endif value={{ $brand->id }}>
                            {{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="form-label fw-semibold">Product Image (Logo)</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" accept="image/*">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Show current image --}}
                @if ($product->image)
                    <div class="mt-2">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="100" class="rounded">
                    </div>
                @endif
            </div>


            <div class="mb-3 row">
                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
            </div>
        </form>

    </div>
    </div>
@endsection
