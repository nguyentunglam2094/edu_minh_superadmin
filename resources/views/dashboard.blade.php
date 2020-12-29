@extends('layouts.app1')
@section('title_for_layout','Dashboard')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection
@section('bread')

@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- ============================================================== -->
                <!-- Info Box -->
                <!-- ============================================================== -->
                <div class="card-body border-top">
                    <div class="row m-b-0">
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><span class="text-orange display-5"><i class="m-r-10 mdi mdi-food-off"></i></span></div>
                                <div><span>Total Articles</span>
                                    <h3 class="font-medium m-b-0"></h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><span class="text-info display-5"><i class="m-r-10 mdi mdi-food-fork-drink"></i></span></div>
                                <div>
                                    <span>Drinks</span>
                                    <h3 class="font-medium m-b-0"></h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><span class="text-cyan display-5"><i class="m-r-10 mdi mdi-food-apple"></i></span></div>
                                <div><span>Dessert</span>
                                    <h3 class="font-medium m-b-0"></h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><span class="text-primary display-5"><i class="m-r-10 mdi mdi-food"></i></span></div>
                                <div><span>Build your own</span>
                                    <h3 class="font-medium m-b-0"></h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('xtreme/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{ asset('xtreme/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
    <script src="{{ asset('xtreme/assets/libs/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('xtreme/assets/libs/sweetalert2/sweet-alert.init.js')}}"></script>
    <script src="{{ asset('xtreme/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('xtreme/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('xtreme/dist/js/pages/forms/select2/select2.init.js') }}"></script>
@endpush
