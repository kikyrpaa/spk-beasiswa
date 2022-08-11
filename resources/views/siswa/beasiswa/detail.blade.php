@extends('layouts.siswa.master')


@section('before-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
@endsection
@section('title')
    Data Beasiswa
@endsection
@section('main-content')
    <div class="breadcrumb">
        <h1>Beasiswa Detail</h1>
        <ul>
            <li><a href="{{route('siswa.beasiswa')}}">Beasiswa Management</a></li>
            <li>Data Beasiswa</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    @include('common.alert')

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form class="needs-validation" action="" method="POST" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="id_beasiswa" value="{{ old('name', $beasiswa->id_beasiswa ) }}" />
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Nama Beasiswa</label>
                                <input class="form-control" name="nama_beasiswa" type="text" value="{{ old('name', $beasiswa->nama_beasiswa ) }}" required readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" cols="50" required readonly>{{$beasiswa->deskripsi}}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="picker1">Semester</label>
                                <select class="form-control" name="semester" required disabled>
                                    <option value="ganjil" {{ ( $beasiswa->semester == 'ganjil') ? 'selected' : '' }}>Ganjil</option>
                                    <option value="genap" {{ ( $beasiswa->semester == 'genap') ? 'selected' : '' }}>Genap</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Tahun Beasiswa</label>
                                <input class="form-control" name="tahun_beasiswa" type="text" value="{{ old('name', $beasiswa->tahun_beasiswa ) }}" required readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="picker1">Pemberi Beasiswa</label>
                                <select class="form-control" name="pemberi_beasiswa" required disabled>
                                    <option value="sekolah">Sekolah</option>
                                    <option value="pemerintah">Pemerintah</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="tanggal_beasiswa">Tanggal Akhir Beasiswa</label>
                                <div class="input-group">
                                    <input id="tanggal" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_beasiswa" value="{{ old('name', $beasiswa->tanggal_beasiswa ) }}" required disabled>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Jumlah Penerima Beasiswa</label>
                                <input class="form-control" name="jumlah_penerima" type="number" value="{{ old('name', $beasiswa->jumlah_penerima ) }}" required disabled>
                            </div>
                        </div>
                        <div class="col-lg-12 text-right">
                            <a href="{{route('siswa.beasiswa')}}" class="btn btn-outline-secondary m-1">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/form.basic.script.js')}}"></script>
    <script src="{{asset('assets/js/form.validation.script.js')}}"></script>
@endsection
