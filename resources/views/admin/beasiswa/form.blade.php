@extends('layouts.admin.master')
@section('before-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
@endsection
@section('title')
    Manage Beasiswa
@endsection
@section('main-content')
    <div class="breadcrumb">
        @if($isNew)
            <h1>Create New Beasiswa</h1>
        @else
            <h1>Data Beasiswa</h1>
        @endif
        <ul>
            <li><a href="{{route('admin.beasiswa.list')}}">Beasiswa Management</a></li>
            <li>Create New Beasiswa</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    @include('common.alert')

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form class="needs-validation" action="{{route('admin.beasiswa.store')}}" method="POST" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="id_beasiswa" value="{{ old('name', $beasiswa->id_beasiswa ) }}" />
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Nama Beasiswa</label>
                                <input class="form-control" name="nama_beasiswa" type="text" value="{{ old('name', $beasiswa->nama_beasiswa ) }}" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" cols="50" required>{{$beasiswa->deskripsi}}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="picker1">Semester</label>
                                <select class="form-control" name="semester" required>
                                    <option value="ganjil" {{ ( $beasiswa->semester == 'ganjil') ? 'selected' : '' }}>Ganjil</option>
                                    <option value="genap" {{ ( $beasiswa->semester == 'genap') ? 'selected' : '' }}>Genap</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Tahun Beasiswa</label>
                                <input class="form-control" name="tahun_beasiswa" type="text" value="{{ old('name', $beasiswa->tahun_beasiswa ) }}" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="picker1">Pemberi Beasiswa</label>
                                <select class="form-control" name="pemberi_beasiswa" required>
                                    <option value="sekolah">Sekolah</option>
                                    <option value="pemerintah">Pemerintah</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="tanggal_beasiswa">Tanggal Akhir Beasiswa</label>
                                <div class="input-group">
                                    <input id="tanggal" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_beasiswa" value="{{ old('name', $beasiswa->tanggal_beasiswa ) }}" required>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Jumlah Penerima Beasiswa</label>
                                <input class="form-control" name="jumlah_penerima" type="number" value="{{ old('name', $beasiswa->jumlah_penerima ) }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12 text-right">
                            <a href="{{route('admin.beasiswa.list')}}" class="btn btn-outline-secondary m-1">Cancel</a>
                            <button type="submit" class="btn btn-primary m-1">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('page-js')
    <script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
    <script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/form.basic.script.js')}}"></script>
    <script src="{{asset('assets/js/form.validation.script.js')}}"></script>
    <script>
        $(document).ready(function(){$("#tanggal").pickadate({
            formatSubmit: 'yyyy-mm-dd',
            format: 'yyyy-mm-dd',
            hiddenName: true,
            selectYears: true,
            selectMonths: true,
            min: new Date(1945,1,1),
        })});
    </script>
@endsection
