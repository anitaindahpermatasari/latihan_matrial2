@php
use App\Models\Users;
@endphp

@extends('layouts.app')
@push('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/themes/semi-dark-layout.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/plugins/charts/chart-apex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/pages/app-invoice-list.min.css') }}">
@endpush

@section('title', 'Friends')

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Friends</h1>
                <a href="/friends/create" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Teman</a>
            </div>

            <!-- Content Row -->
            <div class="row">
            @foreach ($friend as $friend)
                <!-- Content Column -->
                <div class="col-lg-4 mb-4">
                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="/friends/{{ $friend['id'] }}" class="m-0 font-weight-bold text-success h6">{{ $friend['nama'] }}</a>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold mb-4">Nomor Telepon: <span class="float-right">{{ $friend['no_tlp'] }}</span></h4>
                            <h4 class="small font-weight-bold mb-4">Alamat: <span class="float-right">{{ $friend['alamat'] }}</span></h4>
                            <h4 class="small font-weight-bold mb-4">Jenis Kelamin: <span class="float-right">{{ $friend['jenis_kelamin'] }}</span></h4>
                            <h4 class="small font-weight-bold mb-4">Instagram: <span class="float-right">{{ $friend['instagram'] }}</span></h4>
                        </div>
                        <div class="card-footer">
                            <div class="d-inline float-right">
                                <a href="/friends/{{$friend['id']}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt">Edit</i></a>
                                <form action="/friends/{{ $friend['id'] }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"><i class="fas fa-trash">Delete</i></b>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
        <div class="row d-flex justify-content-center">
                    {{ $friend-> links() }}
        </div>
        </div>

            </div>
            </div>
            </div>
        </div>

        </section>
        <!-- users edit ends -->

    </div>



@endsection

@push('script')


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->

    <script src="{{ asset('/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('/js/core/app.min.js') }}"></script>
    <script src="{{ asset('/js/scripts/customizer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/js/scripts/pages/dashboard-analytics.min.js') }}"></script>
    <script src="{{ asset('/js/scripts/pages/app-invoice-list.min.js') }}"></script>
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>

    @endpush

