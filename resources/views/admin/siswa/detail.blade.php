@extends('layouts.admin.master')
@section('before-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
@endsection
@section('title')
    Data Siswa
@endsection
@section('main-content')
    <div class="breadcrumb">
        <h1>Data Siswa</h1>
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
                    @if(!$siswa->status)
                    <div class="col-lg-12 text-right">
                        <a class="btn btn-info m-1 verifySiswa"
                           data-toggle="modal"
                           data-target="#verify"
                           data-id-siswa="{{$siswa->id_siswa}}">Verify</a>
                    </div>
                    @endif
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
                                <input class="form-control @error('username') is-invalid @enderror" name="username"
                                       type="text" value="{{ old('username', $siswa->username ) }}" disabled>
                                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                          name="alamat" rows="4" cols="50"
                                          disabled>{{$siswa->alamat != null ? $siswa->alamat : old('alamat')}}</textarea>
                                <div class="invalid-feedback">{{ $errors->first('alamat') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="sales_id">Tempat Lahir</label>
                                <input class="form-control @error('tempat_lahir') is-invalid @enderror"
                                       name="tempat_lahir" type="text"
                                       value="{{ old('tempat_lahir', $siswa->tempat_lahir ) }}" disabled>
                                <div class="invalid-feedback">{{ $errors->first('tempat_lahir') }}</div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="sales_id">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input id="tanggal"
                                           class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                           placeholder="yyyy-mm-dd" name="tanggal_lahir"
                                           value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ) }}" disabled>
                                    <div class="invalid-feedback">{{ $errors->first('tanggal_lahir') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Nilai Rapot</label>
                                <input class="form-control @error('nilai_rapot') is-invalid @enderror"
                                       name="nilai_rapot" type="number"
                                       value="{{old('nilai_rapot', $siswa->nilai_rapot)}}" step=".01" disabled>
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
                            <div class="col-md-6">
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
                        @if($siswa->sertifikat_prestasi && !$siswa->status_sertifikat_prestasi)
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <a class="btn btn-info m-1 verifyPrestasi"
                                       data-toggle="modal"
                                       data-target="#verifyPrestasi"
                                       data-id-siswa="{{$siswa->id_siswa}}">Verify Sertifikat Prestasi</a>
                                </div>
                            </div>
                        @endif
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
                        @if($siswa->sertifikat_hafidh && !$siswa->status_sertifikat_hafidh)
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <a class="btn btn-info m-1 verifyHafidh"
                                       data-toggle="modal"
                                       data-target="#verifyHafidh"
                                       data-id-siswa="{{$siswa->id_siswa}}">Verify Sertifikat Hafidh</a>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12 text-right">
                            <a href="{{route('admin.siswa.list')}}" class="btn btn-outline-secondary m-1">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Verify Siswa -->
        <div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{route('admin.siswa.verify')}}" method="POST">
                        {{ method_field('post') }}
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure want to verify this?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <input type="text" name="id_siswa" id="id_siswa" hidden>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-info">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Verify Prestasi -->
        <div class="modal fade" id="verifyPrestasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{route('admin.siswa.verify-prestasi')}}" method="POST">
                        {{ method_field('post') }}
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure want to verify this achievement?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <input type="text" name="id_siswa" id="id_siswa_prestasi" hidden>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-info">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Verify Hafidh -->
        <div class="modal fade" id="verifyHafidh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{route('admin.siswa.verify-hafidh')}}" method="POST">
                        {{ method_field('post') }}
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure want to verify this hafidh?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <input type="text" name="id_siswa" id="id_siswa_hafidh" hidden>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-info">Yes</button>
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
        $(document).ready(function () {
            $("#tanggal").pickadate({
                formatSubmit: 'yyyy-mm-dd',
                format: 'yyyy-mm-dd',
                hiddenName: true,
                selectYears: true,
                selectMonths: true,
                min: new Date(1945, 1, 1),
            })
        });

        function previewFoto() {
            const fotoSiswa = document.querySelector('#foto_siswa');
            const fotoSiswaPreview = document.querySelector('.img-preview');
            fotoSiswaPreview.style.display = 'block';
            const ofReader = new FileReader()
            ofReader.readAsDataURL(foto_siswa.files[0]);
            ofReader.onload = function (oFREvent) {
                fotoSiswaPreview.src = oFREvent.target.result;
            }
        }
    </script>

    <script>
        $(document).on('click', '.verifySiswa', function () {
            var IDSiswa = $(this).attr('data-id-siswa');
            $('#id_siswa').val(IDSiswa);
        });
        $(document).on('click', '.verifyPrestasi', function () {
            var IDSiswa = $(this).attr('data-id-siswa');
            $('#id_siswa_prestasi').val(IDSiswa);
        });
        $(document).on('click', '.verifyHafidh', function () {
            var IDSiswa = $(this).attr('data-id-siswa');
            $('#id_siswa_hafidh').val(IDSiswa);
        });
    </script>
@endsection
