@extends('layouts.admin.master')
@section('before-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
@endsection
@section('title')
    Manage Administrator
@endsection
@section('main-content')
    <div class="breadcrumb">
        @if($isNew)
            <h1>Create New Admin</h1>
        @else
            <h1>Data Admin</h1>
        @endif
        <ul>
            <li><a href="{{route('admin.admin.list')}}">Admin Management</a></li>
            <li>Create New Admin</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    @include('common.alert')

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form class="needs-validation" action="{{route('admin.admin.store')}}" method="POST" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="id_admin" value="{{ old('name', $admin->id_admin ) }}" />
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Nama</label>
                                <input class="form-control @error('nama') is-invalid @enderror" name="nama" type="text" value="{{ old('nama', $admin->nama ) }}" required>
                                <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" name="username" type="text" value="{{ old('username', $admin->username ) }}" required>
                                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                            </div>
                            @if($isNew)
                                <div class="col-md-12 form-group">
                                    <label for="sales_id">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" value="{{ old('name', $admin->password ) }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="sales_id">Confirm Password</label>
                                    <input class="form-control" name="password_confirmation" type="password" value="" required>
                                </div>
                            @endif
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="4" cols="50" required>{{$admin->alamat != null ? $admin->alamat : old('alamat')}}</textarea>
                                <div class="invalid-feedback">{{ $errors->first('alamat') }}</div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Tempat Lahir</label>
                                <input class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" type="text" value="{{ old('tempat_lahir', $admin->tempat_lahir ) }}" required>
                                <div class="invalid-feedback">{{ $errors->first('tempat_lahir') }}</div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input id="tanggal" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="yyyy-mm-dd" name="tanggal_lahir" value="{{ old('tanggal_lahir', $admin->tanggal_lahir ) }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('tanggal_lahir') }}</div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="picker1">Select</label>
                                <select class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" required>
                                    <option value="admin" {{ ( $admin->jabatan == 'admin') ? 'selected' : '' }}>Admin</option>
                                    <option value="pengurus" {{ ( $admin->jabatan == 'pengurus') ? 'selected' : '' }}>Pengurus</option>
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('jabatan') }}</div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-right">
                            <a href="{{route('admin.admin.list')}}" class="btn btn-outline-secondary m-1">Cancel</a>
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
