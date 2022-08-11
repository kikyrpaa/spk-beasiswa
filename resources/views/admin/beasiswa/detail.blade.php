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

@section('before-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
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
            <li><a href="{{route('admin.beasiswa.list')}}">Beasiswa Management</a></li>
            <li>Data Beasiswa</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    @include('common.alert')

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    @if($beasiswa->status != 1)
                        <div class="col-lg-12 text-right">
                            <a class="btn btn-info m-1 decide"
                               data-toggle="modal"
                               data-target="#decide"
                               data-id-beasiswa="{{$beasiswa->id_beasiswa}}">Decide</a>
                        </div>
                    @endif
                    <form class="needs-validation" action="" method="POST" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="id_beasiswa" value="{{ old('name', $beasiswa->id_beasiswa ) }}"/>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Nama Beasiswa</label>
                                <input class="form-control" name="nama_beasiswa" type="text"
                                       value="{{ old('name', $beasiswa->nama_beasiswa ) }}" required readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" cols="50"
                                          required readonly>{{$beasiswa->deskripsi}}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="picker1">Semester</label>
                                <select class="form-control" name="semester" required disabled>
                                    <option value="ganjil" {{ ( $beasiswa->semester == 'ganjil') ? 'selected' : '' }}>
                                        Ganjil
                                    </option>
                                    <option value="genap" {{ ( $beasiswa->semester == 'genap') ? 'selected' : '' }}>
                                        Genap
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Tahun Beasiswa</label>
                                <input class="form-control" name="tahun_beasiswa" type="text"
                                       value="{{ old('name', $beasiswa->tahun_beasiswa ) }}" required readonly>
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
                                    <input id="tanggal" class="form-control" placeholder="yyyy-mm-dd"
                                           name="tanggal_beasiswa"
                                           value="{{ old('name', $beasiswa->tanggal_beasiswa ) }}" required disabled>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Jumlah Penerima Beasiswa</label>
                                <input class="form-control" name="jumlah_penerima" type="number"
                                       value="{{ old('name', $beasiswa->jumlah_penerima ) }}" required disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if(sizeof($beasiswa->siswas) > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="card-title">Siswa Pendaftar Beasiswa</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_configuration_table" class="display table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($beasiswaSiswa as $key=>$value)
                                    <tr>
                                        <td>{{$key+1}}</td>
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
            @endif
            <div class="card mb-4">
                <div class="card-footer">
                    <div class="col-lg-12 text-right">
                        <a href="{{route('admin.beasiswa.list')}}" class="btn btn-outline-secondary m-1">Back</a>
                    </div>
                </div>
            </div>

            <!-- Modal Decide Beasiswa -->
            <div class="modal fade" id="decide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{route('admin.beasiswa.decide')}}" method="POST">
                            {{ method_field('post') }}
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure want to decide this?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <input type="text" name="id_beasiswa" id="id_beasiswa" hidden>
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
    </div>

@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/form.basic.script.js')}}"></script>
    <script src="{{asset('assets/js/form.validation.script.js')}}"></script>
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables.script.js')}}"></script>
    <script>
        $(document).on('click', '.decide', function () {
            var IDBeasiswa = $(this).attr('data-id-beasiswa');
            $('#id_beasiswa').val(IDBeasiswa);
        });
    </script>
@endsection
