@extends('admin.layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row bg-dark d-flex justify-content-center align-items-center">
            <p class="h1 p-2 ml-3">Welcome To Admin Dashboard!</p>
            <img src="{{ asset('images/undraw_programmer_re_owql.svg') }}" class="w-25 p-4 ml-5" alt="">
        </div>
    </div>
        {{-- <div class="row mt-3 mx-auto" style="height: 200px;">
            <div
                class="col m-3 shadow-sm text-center bg-white d-flex flex-column justify-content-center align-items-center rounded-lg">
                <h3 class="h3">Employee List</h3>
                <button type="button" class="btn btn-primary btn-sm w-40"><a href="{{ route('employees.index') }}">Click
                        here!</a></button>
            </div> --}}

            {{-- <div
                class="col m-3  shadow-sm text-center bg-white d-flex flex-column justify-content-center align-items-center rounded-lg">
                <h3 class="h3">Department List</h3>
                <button type="button" class="btn btn-primary btn-sm w-40"><a href="{{ route('departments.index') }}">Click
                        here!</a></button>
            </div> --}}

            {{-- <div
                class="col m-3 shadow-sm text-center bg-white d-flex flex-column justify-content-center align-items-center rounded-lg">
                <h3 class="h3">Brand List</h3>
                <button type="button" class="btn btn-primary btn-sm w-40"><a href="{{ route('brands.index') }}">Click
                        here!</a></button>
            </div>
        </div> --}}

        {{-- <div class="row mt-3 mx-auto w-100" style="height: 200px;">

            <div
                class="col m-3 shadow-sm text-center bg-white d-flex flex-column justify-content-center align-items-center rounded-lg">
                <h3 class="h3 mb-3">Category List</h3>
                <button type="button" class="btn btn-primary btn-sm w-40"><a href="{{ route('categories.index') }}">Click
                        here!</a></button>
            </div> --}}

            {{-- <div
                class="col m-3 shadow-sm text-center bg-white d-flex flex-column justify-content-center align-items-center rounded-lg">
                <h3 class="h3 mb-3">Product List</h3>
                <button type="button" class="btn btn-primary btn-sm w-40"><a href="{{ route('products.index') }}">Click
                        here!</a></button>
            </div> --}}

            {{-- <div
                class="col m-3 shadow-sm text-center bg-white d-flex flex-column justify-content-center align-items-center rounded-lg">
                <h3 class="h3 mb-3">Customer List</h3>
                <button type="button" class="btn btn-primary btn-sm w-40"><a href="{{ route('customers.index') }}">Click
                        here!</a></button>
            </div> --}}
        {{-- </div> --}}

        {{-- <div class="row mt-3 mx-auto w-100" style="height: 200px;">

            <div
                class="col-4 m-3 shadow-sm text-center bg-white d-flex flex-column justify-content-center align-items-center rounded-lg">
                <h3 class="h3 mb-3">Order List</h3>
                <button type="button" class="btn btn-primary btn-sm w-40"><a href="{{ route('orders.index') }}">Click
                        here!</a></button>
            </div> --}}
        {{-- </div> --}}
    {{-- </div> --}}
    {{-- <div class="content-wrapper"> --}}

        <div class="content-header">
            {{-- <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        </ol>
                    </div>
                </div>
            </div> --}}
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>50</h3>

                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>20</h3>

                                <p>Pending Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px"></sup></h3>

                                <p>Complete Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>10</h3>

                                <p>Cancel Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>13</h3>

                                <p>New Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <section class="col-lg-7 connectedSortable">
                    </section>
                    <section class="col-lg-5 connectedSortable">

                        <!-- Map card -->
                        <!-- <div class="card bg-gradient-primary">
                      <div class="card-header border-0">
                        <h3 class="card-title">
                          <i class="fas fa-map-marker-alt mr-1"></i>
                          Visitors
                        </h3> -->
                        <!-- card tools -->
                        <!-- <div class="card-tools">
                          <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                            <i class="far fa-calendar-alt"></i>
                          </button>
                          <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div> -->
                        <!-- /.card-tools -->
                        <!-- </div>
                      <div class="card-body">
                        <div id="world-map" style="height: 250px; width: 100%;"></div>
                      </div> -->
                        <!-- /.card-body-->
                        <!-- <div class="card-footer bg-transparent">
                        <div class="row">
                          <div class="col-4 text-center">
                            <div id="sparkline-1"></div>
                            <div class="text-white">Visitors</div>
                          </div> -->
                        <!-- ./col -->
                        <!-- <div class="col-4 text-center"> -->
                        <!-- <div id="sparkline-2"></div>
                            <div class="text-white">Online</div>
                          </div> -->
                        <!-- ./col -->
                        <!-- <div class="col-4 text-center">
                            <div id="sparkline-3"></div>
                            <div class="text-white">Sales</div>
                          </div> -->
                        <!-- ./col -->
                        <!-- </div> -->
                        <!-- /.row -->
                        <!-- </div>
                    </div> -->
                        <!-- /.card -->

                        <!-- solid sales graph -->
                        <!-- <div class="card bg-gradient-info"> -->
                        <!-- <div class="card-header border-0">
                        <h3 class="card-title">
                          <i class="fas fa-th mr-1"></i>
                          Sales Graph
                        </h3> -->

                        <!-- <div class="card-tools">
                          <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                      </div> -->
                        <!-- /.card-body -->

                        <!-- /.card-footer -->
                </div>
                <!-- /.card -->

                <!-- Calendar -->
                <div class="card bg-gradient-success">
                    <!-- <div class="card-header border-0">

                        <h3 class="card-title">
                          <i class="far fa-calendar-alt"></i>
                          Calendar
                        </h3> -->
                    <!-- tools card -->
                    <div class="card-tools">
                        <!-- button with a dropdown -->
                        <!-- <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                              <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a href="#" class="dropdown-item">Add new event</a>
                              <a href="#" class="dropdown-item">Clear events</a>
                              <div class="dropdown-divider"></div>
                              <a href="#" class="dropdown-item">View calendar</a>
                            </div>
                          </div>
                          <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button> -->
                        <!-- <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button> -->
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%"></div>
                </div>
                <!-- /.card-body -->
            {{-- </div> --}}
            <!-- /.card -->
        </section>
        <!-- right col -->
    </div>
@endsection
