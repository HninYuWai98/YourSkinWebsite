@extends('admin.layouts.app')

@section('content')
    {{-- Page Header --}}
    <section class="content-header py-4 bg-dark text-white shadow-sm">
        <div class="container-fluid text-center">
            <h1 class="fw-bold mb-0">Create Product</h1>
        </div>
    </section>

    {{-- Form Card --}}
    <div class="card bg-dark text-white border-0 shadow-lg col-lg-6 col-md-8 col-sm-10 mx-auto mt-5 rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Name</label>
                    <input type="text" class="form-control rounded-3" id="name" name="name"
                        placeholder="Enter name" value="{{ old('name') }}" autocomplete="off">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="sub_category_id" class="form-label fw-semibold">Category</label>
                    <select name="sub_category_id" id="sub_category_id" class="form-control rounded-3">
                        <option value="" selected disabled>Choose SubCategory...</option>
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                        @endforeach
                    </select>
                    @error('sub_category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="brand_id" class="form-label fw-semibold">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control rounded-3">
                        <option value="" selected disabled>Choose Brand...</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-semibold">Brand Image (Logo)</label>
                    <input type="file" class="form-control rounded-3" id="image" name="image" accept="image/*">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3">
                        Create
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
