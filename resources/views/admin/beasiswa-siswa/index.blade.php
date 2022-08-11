@extends('layouts.admin.master')
@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <style>
        .verified {
            color: #fff;
            background: #5cb85c;
            border-color: #4cae4c;
        }

        .unverified {
            color: #fff;
            background: #c9302c;
            border-color: #ac2925;
        }
    </style>
@endsection
@section('title')
    Beasiswa Siswa
@endsection
@section('main-content')
    <div class="breadcrumb">
        <h1>List Beasiswa Siswa</h1>
    </div>



    <div class="separator-breadcrumb border-top"></div>
    @include('common.alert')
    <div id="task-manager">

        <!-- content-start -->


        <div class="row">

            <div class="col-md-12 mb-4">
                <div class="card text-left">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Beasiswa Siswa</h4>
                        <br>
                        <div class="table-responsive">
                            <table id="zero_configuration_table" class="display table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Beasiswa</th>
                                    <th>Nama Siswa</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($beasiswaSiswa as $key=>$value)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$value->beasiswa->nama_beasiswa}}</td>
                                        <td>{{$value->siswa->nama}}</td>
                                        <td>
                                            @if($value->status == 'pending')
                                                <span class="badge badge-pill badge-warning p-2 m-1">Pending</span>
                                            @elseif($value->status == 'ditolak')
                                                <span class="badge badge-pill badge-danger p-2 m-1">Ditolak</span>
                                            @else
                                                <span class="badge badge-pill badge-success p-2 m-1">Diterima</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of sidebar content -->
        </div>
    </div>
            <!-- end-of-content -->
@endsection
@section('page-js')
        <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
        <script src="{{asset('assets/js/datatables.script.js')}}"></script>
@endsection
