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
    Home
@endsection
@section('main-content')
    <div class="breadcrumb">
        <h1>Home</h1>

    </div>
    @include('common.alert')
    <div class="separator-breadcrumb border-top"></div>
    <div class="card mb-4">
        <div class="card-header">
            <div class="card-title">Profile Siswa</div>
        </div>
        <div class="card-body">
            <div class="col-lg-12 text-right">
                <a href="{{url('siswa/edit/'.$siswa->id_siswa)}}" class="btn btn-outline-info m-1">Edit</a>
            </div>
            <form class="needs-validation">
                {{ csrf_field() }}
                <input type="hidden" name="id_siswa" value="{{ old('id_siswa', $siswa->id_siswa ) }}"/>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="sales_id">Nama</label>
                        <input class="form-control @error('nama') is-invalid @enderror" name="nama" type="text"
                               value="{{ old('nama', $siswa->nama ) }}" disabled>
                        <div class="invalid-feedback">{{ $errors }}</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="sales_id">Username</label>
                        <input class="form-control @error('username') is-invalid @enderror" name="username" type="text"
                               value="{{ old('username', $siswa->username ) }}" disabled>
                        <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="sales_id">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                  rows="4" cols="50"
                                  disabled>{{$siswa->alamat != null ? $siswa->alamat : old('alamat')}}</textarea>
                        <div class="invalid-feedback">{{ $errors->first('alamat') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="sales_id">Tempat Lahir</label>
                        <input class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir"
                               type="text" value="{{ old('tempat_lahir', $siswa->tempat_lahir ) }}" disabled>
                        <div class="invalid-feedback">{{ $errors->first('tempat_lahir') }}</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="sales_id">Tanggal Lahir</label>
                        <div class="input-group">
                            <input id="tanggal" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                   placeholder="yyyy-mm-dd" name="tanggal_lahir"
                                   value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ) }}" disabled>
                            <div class="invalid-feedback">{{ $errors->first('tanggal_lahir') }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Nilai Rapot</label>
                        <input class="form-control @error('nilai_rapot') is-invalid @enderror" name="nilai_rapot"
                               type="number" value="{{old('nilai_rapot', $siswa->nilai_rapot)}}" step=".01" disabled>
                        <div class="invalid-feedback">{{ $errors->first('nilai_rapot') }}</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="d-block">Foto Siswa</label>
                        @if($siswa->foto_siswa)
                            <img src="{{asset('storage/'.$siswa->foto_siswa)}}"
                                 class="img-preview-siswa img-fluid mb-3 col-sm-6">
                        @else
                            <img class="img-preview-siswa img-fluid mb-3 col-sm-6">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="d-block">Foto Rapot</label>
                        @if($siswa->foto_rapot)
                            <img src="{{asset('storage/'.$siswa->foto_rapot)}}"
                                 class="img-preview-rapot img-fluid mb-3 col-sm-6">
                        @else
                            <img class="img-preview-rapot img-fluid mb-3 col-sm-6">
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="d-block">Sertifikat Prestasi</label>
                        @if($siswa->sertifikat_prestasi)
                            <img src="{{asset('storage/'.$siswa->sertifikat_prestasi)}}"
                                 class="img-preview-sertifikat img-fluid mb-3 col-sm-6">
                        @else
                            <img class="img-preview-sertifikat img-fluid mb-3 col-sm-6">
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="sales_id">Juara</label>
                        <input class="form-control @error('juara_sertifikat_prestasi') is-invalid @enderror"
                               name="juara_sertifikat_prestasi"
                               type="text"
                               value="{{ old('juara_sertifikat_prestasi', $siswa->juara_sertifikat_prestasi ) }}"
                               disabled>
                        <div class="invalid-feedback">{{ $errors->first('juara_sertifikat_prestasi') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="picker1">Tingkat</label>
                        <input class="form-control" name="tingkat_sertifikat_prestasi"
                               value="{{ old('tingkat_sertifikat_prestasi', $siswa->tingkat_sertifikat_prestasi ) }}"
                               disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="d-block">Sertifikat Hafidh</label>
                        @if($siswa->sertifikat_hafidh)
                            <img src="{{asset('storage/'.$siswa->sertifikat_hafidh)}}"
                                 class="img-preview-hafidh img-fluid mb-3 col-sm-6">
                        @else
                            <img class="img-preview-hafidh img-fluid mb-3 col-sm-6">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="picker1">Juz</label>
                        <input class="form-control" name="juz_sertifikat_hafidh"
                               value="{{ old('juz_sertifikat_hafidh', $siswa->juz_sertifikat_hafidh ) }}"
                               disabled>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <div class="card-title">Beasiswa yang diajukan</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="zero_configuration_table" class="display table table-striped table-bordered"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Beasiswa</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($beasiswaSiswa as $key=>$value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->beasiswa->nama_beasiswa}}</td>
                            <td>
                                @if($value->status == 'pending')
                                    <span class="badge badge-pill badge-warning p-2 m-1">Pending</span>
                                @elseif($value->status == 'ditolak')
                                    <span class="badge badge-pill badge-danger p-2 m-1">Ditolak</span>
                                @else
                                    <span class="badge badge-pill badge-success p-2 m-1">Diterima</span>
                                @endif
                            </td>
{{--                            <td>{{ucfirst(trans($value->status))}}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="task-manager">

        <!-- content-start -->


        <div class="row">


        </div>
        <!-- end of sidebar content -->

        <!-- end-of-content -->
    </div>

@endsection

@section('page-js')

    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables.script.js')}}"></script>

@endsection
