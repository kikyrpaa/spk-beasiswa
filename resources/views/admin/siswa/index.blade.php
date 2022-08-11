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
    Siswa Management
@endsection
@section('main-content')
    <div class="breadcrumb">
        <h1>List Siswa</h1>
    </div>



    <div class="separator-breadcrumb border-top"></div>
    @include('common.alert')
    <div id="task-manager">

        <!-- content-start -->


        <div class="row">

            <div class="col-md-12 mb-4">
                <div class="card text-left">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Siswa</h4>
                        <a href="{{route('admin.siswa.form')}}"><button type="button" class="btn btn-primary ripple m-1">Add New Siswa</button></a>
                        <br>
                        <div class="table-responsive">
                            <table id="zero_configuration_table" class="display table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Alamat</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Status Prestasi</th>
                                    <th>Status Hafidh</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($siswas as $key=>$value)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$value->nama}}</td>
                                        <td>{{$value->username}}</td>
                                        <td>{{$value->alamat}}</td>
                                        <td>{{$value->tempat_lahir}}</td>
                                        <td>{{date("d-M-Y", strtotime($value->tanggal_lahir))}}</td>
                                        <td>
                                            @if($value->status_sertifikat_prestasi)
                                                <span class="badge badge-pill badge-success p-2 m-1">Verified</span>
                                            @else
                                                <span class="badge badge-pill badge-danger p-2 m-1">Unverified</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->status_sertifikat_hafidh)
                                                <span class="badge badge-pill badge-success p-2 m-1">Verified</span>
                                            @else
                                                <span class="badge badge-pill badge-danger p-2 m-1">Unverified</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->status)
                                                <span class="badge badge-pill badge-success p-2 m-1">Verified</span>
                                            @else
                                                <span class="badge badge-pill badge-danger p-2 m-1">Unverified</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('administrator/siswa/detail/'.$value->id_siswa)}}"
                                               class="text-success mr-2">
                                                <button type="button" class="btn btn-light m-1">Show</button>
                                            </a>
                                            <a href="{{url('administrator/siswa/form/'.$value->id_siswa)}}"
                                               class="text-success mr-2">
                                                <button type="button" class="btn btn-info m-1">Update</button>
                                            </a>
{{--                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>--}}
                                            <a class="btn btn-danger m-1 deleteSiswa"
                                               data-toggle="modal"
                                               data-target="#reject"
                                               data-id-siswa="{{$value->id_siswa}}">Delete</a>
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

            <!-- Modal Reject -->
            <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{route('admin.siswa.delete')}}" method="POST">
                            {{ method_field('post') }}
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <input type="text" name="id_siswa" id="id_siswa" hidden>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-danger">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!-- end-of-content -->
@endsection
@section('page-js')
        <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
        <script src="{{asset('assets/js/datatables.script.js')}}"></script>
        <script>
            $(document).on('click', '.deleteSiswa', function () {
                var IDSiswa = $(this).attr('data-id-siswa');
                $('#id_siswa').val(IDSiswa);
            });
        </script>
@endsection
