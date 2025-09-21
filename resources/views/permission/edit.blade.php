@extends('layouts.app');

@section('content')


<section class="content-header bg-dark">
    <div class="container-fluid text-center">
          <h1 class="font-weight-bold">Edit Employee</h1>
    </div>
</section>

  <div class="card-body bg-dark text-white col-5 mx-auto mt-5 p-4">

    <form action="{{ route('employees.update', $employee->id) }}" method="post" >
        @csrf
        @method("PUT")

        <div class="form-group col-7 mb-3 mx-auto">
            <label for="name" class="mb-1">Enter Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $employee->name }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
        </div>


        <div class="form-group col-7 mb-3 mx-auto">
            <label for="email" class="mb-1">Enter Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$employee->email }}">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
        </div>

        <div class="form-group col-7 mb-3 mx-auto">
            <label for="name" class="mb-1">Choose Department</label>
            <select name="department_id" class="form-select bg-white text-black w-100" aria-label="Default select example">
            <option selected>Choose Departments</option>
                @foreach ($departments as $department)
                <option
                @if($employee->department_id == $department->id) selected

                @endif
                value={{$department->id}}>{{$department->name}}</option>
            @endforeach
          </select>
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>


        <div class="mb-3 row">
            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
        </div>
    </form>

</div>
</div>


@endsection
