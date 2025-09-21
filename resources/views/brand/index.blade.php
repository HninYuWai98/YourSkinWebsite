@extends('admin.layouts.app')

@section('content')
    <section class="content-header bg-dark">
        <div class="container-fluid text-center">
            <h1 class="font-weight-bold">Brand List</h1>
        </div>
    </section>

    <section class="content box mt-5">
        <div class="col-9 m-auto card">
            <div class="card-body">
                <a href="{{ route('brands.create') }}" class="btn btn-primary btn-sm my-2 p-2"><i
                        class="fa-solid fa-circle-plus"></i> Add New Brand</a>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Modified By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr>
                                <th class="col-1" scope="row">{{ $loop->iteration }}</th>
                                <td class="col-2">
                                    @if ($brand->image)
                                        <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}" width="50"
                                            height="50" class="rounded">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->created_user->name }}</td>
                                <td>{{ $brand->modified_user->name }}</td>
                                <td class="col-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <!-- Edit Button -->
                                        <form action="{{ route('brands.edit', $brand->uuid) }}" method="get"
                                            class="flex-fill mb-2 mb-md-2 p-0">
                                            <button type="submit" class="btn btn-primary btn-sm text-center"
                                                style="width: 60px;">
                                                Edit
                                            </button>
                                        </form>

                                        <!-- Delete Button -->
                                        <form action="{{ route('brands.destroy', $brand->uuid) }}" method="POST"
                                            class="flex-fill p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm text-center"
                                                style="width: 60px;"
                                                onclick="return confirm('Do you want to delete this product?');">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No Brand Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
