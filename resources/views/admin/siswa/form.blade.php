@extends('layouts.admin.master')
@section('before-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
@endsection
@section('title')
    Manage Siswa
@endsection
@section('main-content')
    <div class="breadcrumb">
        @if($isNew)
            <h1>Create New Siswa</h1>
        @else
            <h1>Data Siswa</h1>
        @endif
        <ul>
            <li><a href="{{route('admin.siswa.list')}}">Siswa Management</a></li>
            <li>Create New Siswa</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    @include('common.alert')

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form class="needs-validation" action="{{route('admin.siswa.store')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_siswa" value="{{ old('id_siswa', $siswa->id_siswa ) }}" />
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="sales_id">Nama</label>
                                <input class="form-control @error('nama') is-invalid @enderror" name="nama" type="text" value="{{ old('nama', $siswa->nama ) }}" required>
                                <div class="invalid-feedback">{{ $errors }}</div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="sales_id">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" name="username" type="text" value="{{ old('username', $siswa->username ) }}" required>
                                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                            </div>
                        </div>
                        @if($isNew)
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="sales_id">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" value="{{ old('password', $siswa->password ) }}">
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="sales_id">Password Confirmation</label>
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" type="password" value="{{ old('password_confirmation', $siswa->password ) }}">
                                    <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="4" cols="50" required>{{$siswa->alamat != null ? $siswa->alamat : old('alamat')}}</textarea>
                                <div class="invalid-feedback">{{ $errors->first('alamat') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="sales_id">Tempat Lahir</label>
                                <input class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" type="text" value="{{ old('tempat_lahir', $siswa->tempat_lahir ) }}" required>
                                <div class="invalid-feedback">{{ $errors->first('tempat_lahir') }}</div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="sales_id">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input id="tanggal" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="yyyy-mm-dd" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ) }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('tanggal_lahir') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Nilai Rapot</label>
                                <input class="form-control @error('nilai_rapot') is-invalid @enderror" name="nilai_rapot" type="number" value="{{old('nilai_rapot', $siswa->nilai_rapot)}}" step=".01" required>
                                <div class="invalid-feedback">{{ $errors->first('nilai_rapot') }}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="d-block">Foto Siswa</label>
                                @if($siswa->foto_siswa)
                                    <img src="{{asset('storage/'.$siswa->foto_siswa)}}" class="img-preview-siswa img-fluid mb-3 col-sm-6">
                                @else
                                    <img class="img-preview-siswa img-fluid mb-3 col-sm-6">
                                @endif
                                <input type="file" name="foto_siswa" class="form-control @error('foto_siswa') is-invalid @enderror" placeholder="foto_siswa" id="foto_siswa" onchange="previewFotoSiswa()">
                                <div class="invalid-feedback">{{ $errors->first('foto_siswa') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="d-block">Foto Rapot</label>
                                @if($siswa->foto_rapot)
                                    <img src="{{asset('storage/'.$siswa->foto_rapot)}}" class="img-preview-rapot img-fluid mb-3 col-sm-6">
                                @else
                                    <img class="img-preview-rapot img-fluid mb-3 col-sm-6">
                                @endif
                                <input type="file" name="foto_rapot" class="form-control @error('foto_rapot') is-invalid @enderror" placeholder="foto_rapot" id="foto_rapot" onchange="previewFotoRapot()">
                                <div class="invalid-feedback">{{ $errors->first('foto_rapot') }}</div>
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
                                <input type="file" name="sertifikat_prestasi"
                                       class="form-control @error('sertifikat_prestasi') is-invalid @enderror"
                                       placeholder="sertifikat_prestasi" id="sertifikat_prestasi"
                                       onchange="previewSertif()">
                                <div class="invalid-feedback">{{ $errors->first('sertifikat_prestasi') }}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="sales_id">Juara</label>
                                <input class="form-control @error('juara_sertifikat_prestasi') is-invalid @enderror"
                                       name="juara_sertifikat_prestasi"
                                       type="text"
                                       value="{{ old('juara_sertifikat_prestasi', $siswa->juara_sertifikat_prestasi ) }}">
                                <div class="invalid-feedback">{{ $errors->first('juara_sertifikat_prestasi') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="picker1">Tingkat</label>
                                <select class="form-control" name="tingkat_sertifikat_prestasi">
                                    <option
                                        value="kota" {{ ( $siswa->juara_sertifikat_prestasi == 'kota') ? 'selected' : '' }}>
                                        Kota
                                    </option>
                                    <option
                                        value="provinsi" {{ ( $siswa->juara_sertifikat_prestasi == 'provinsi') ? 'selected' : '' }}>
                                        Provinsi
                                    </option>
                                    <option
                                        value="nasional" {{ ( $siswa->juara_sertifikat_prestasi == 'nasional') ? 'selected' : '' }}>
                                        Nasional
                                    </option>
                                    <option
                                        value="internasional" {{ ( $siswa->juara_sertifikat_prestasi == 'internasional') ? 'selected' : '' }}>
                                        Internasional
                                    </option>
                                </select>
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
                                <input type="file" name="sertifikat_hafidh"
                                       class="form-control @error('sertifikat_hafidh') is-invalid @enderror"
                                       placeholder="sertifikat_hafidh" id="sertifikat_hafidh"
                                       onchange="previewHafidh()">
                                <div class="invalid-feedback">{{ $errors->first('sertifikat_hafidh') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="sales_id">Juz</label>
                                <input class="form-control @error('juz_sertifikat_hafidh') is-invalid @enderror"
                                       name="juz_sertifikat_hafidh"
                                       type="text"
                                       value="{{ old('juz_sertifikat_hafidh', $siswa->juara_sertifikat_prestasi ) }}">
                                <div class="invalid-feedback">{{ $errors->first('juz_sertifikat_hafidh') }}</div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-right">
                            <a href="{{route('admin.siswa.list')}}" class="btn btn-outline-secondary m-1">Cancel</a>
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
{{--    <script src="{{asset('assets/js/form.validation.script.js')}}"></script>--}}
    <script>
        $(document).ready(function(){$("#tanggal").pickadate({
            formatSubmit: 'yyyy-mm-dd',
            format: 'yyyy-mm-dd',
            hiddenName: true,
            selectYears: true,
            selectMonths: true,
            min: new Date(1945,1,1),
        })});

        function previewFotoSiswa() {
            const fotoSiswa = document.querySelector('#foto_siswa');
            const fotoSiswaPreview = document.querySelector('.img-preview-siswa');
            fotoSiswaPreview.style.display = 'block';
            const ofReader = new FileReader()
            ofReader.readAsDataURL(foto_siswa.files[0]);
            ofReader.onload = function (oFREvent) {
                fotoSiswaPreview.src = oFREvent.target.result;
            }
        }
        function previewFotoRapot() {
            const fotoRapot = document.querySelector('#foto_rapot');
            const fotoRapotPreview = document.querySelector('.img-preview-rapot');
            fotoRapotPreview.style.display = 'block';
            const ofReader = new FileReader()
            ofReader.readAsDataURL(fotoRapot.files[0]);
            ofReader.onload = function (oFREvent) {
                fotoRapotPreview.src = oFREvent.target.result;
            }
        }
        function previewSertif() {
            const fotoSertif = document.querySelector('#sertifikat_prestasi');
            const fotoSertifPreview = document.querySelector('.img-preview-sertifikat');
            fotoSertifPreview.style.display = 'block';
            const ofReader = new FileReader()
            ofReader.readAsDataURL(fotoSertif.files[0]);
            ofReader.onload = function (oFREvent) {
                fotoSertifPreview.src = oFREvent.target.result;
            }
        }
        function previewHafidh() {
            const fotoHafidh = document.querySelector('#sertifikat_hafidh');
            const fotoHafidhPreview = document.querySelector('.img-preview-hafidh');
            fotoHafidhPreview.style.display = 'block';
            const ofReader = new FileReader()
            ofReader.readAsDataURL(fotoHafidh.files[0]);
            ofReader.onload = function (oFREvent) {
                fotoHafidhPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
