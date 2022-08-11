@extends('layouts.siswa.master')
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
    Beasiswa Management
@endsection
@section('main-content')
    <div class="breadcrumb">
        <h1>List Beasiswa</h1>
    </div>



    <div class="separator-breadcrumb border-top"></div>
    @include('common.alert')
    <div id="task-manager">

        <!-- content-start -->


        <div class="row">

            <div class="col-md-12 mb-4">
                <div class="card text-left">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Beasiswa</h4>
                        <br>
                        <div class="table-responsive">
                            <table id="zero_configuration_table" class="display table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Beasiswa</th>
                                    <th>Pemberi Beasiswa</th>
                                    <th>Semester</th>
                                    <th>Tahun</th>
                                    <th>Jumlah Penerima</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($beasiswas as $key=>$value)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$value->nama_beasiswa}}</td>
                                        <td>{{ucfirst(trans($value->pemberi_beasiswa))}}</td>
                                        <td>{{ucfirst(trans($value->semester))}}</td>
                                        <td>{{$value->tahun_beasiswa}}</td>
                                        <td>{{$value->jumlah_penerima}}</td>
                                        <td>{{$value->tanggal_beasiswa}}</td>
                                        <td>
                                            <a href="{{url('siswa/beasiswa/detail/'.$value->id_beasiswa)}}"
                                               class="text-success mr-2">
                                                <button type="button" class="btn btn-light m-1">Show</button>
                                            </a>
                                            @if($value->apply && \Carbon\Carbon::now()->format('Y-m-d') < $value->tanggal_beasiswa && $value->status == 0)
                                            <a class="btn btn-primary m-1 applyBeasiswa"
                                               data-toggle="modal"
                                               data-target="#apply"
                                               data-id-siswa="{{Auth::user()->id_siswa}}"
                                               data-id-beasiswa="{{$value->id_beasiswa}}">Apply</a>
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

            <!-- Modal Reject -->
            <div class="modal fade" id="apply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{route('siswa.beasiswa.apply')}}" method="POST">
                            {{ method_field('post') }}
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure want to apply for this?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <input type="text" name="id_beasiswa" id="id_beasiswa" hidden>
                                <input type="text" name="id_siswa" id="id_beasiswa" hidden>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
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
        $(document).on('click', '.applyBeasiswa', function () {
            var IDBeasiswa = $(this).attr('data-id-beasiswa');
            var IDSiswa = $(this).attr('data-id-siswa');
            $('#id_beasiswa').val(IDBeasiswa);
            $('#id_siswa').val(IDSiswa);
        });
    </script>
@endsection
