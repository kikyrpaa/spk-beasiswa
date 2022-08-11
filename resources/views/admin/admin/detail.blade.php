@extends('layouts.admin.master')


@section('before-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
@endsection
@section('title')
    Data Administrator
@endsection
@section('main-content')
    <div class="breadcrumb">
        <h1>Admin Detail</h1>
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
                    <form class="needs-validation">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_admin" value="{{ old('name', $admin->id_admin ) }}"/>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Nama</label>
                                <input class="form-control" name="nama" type="text" value="{{ old('name', $admin->nama ) }}" readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Username</label>
                                <input class="form-control" name="username" type="text" value="{{ old('name', $admin->username ) }}" readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Password</label>
                                <input class="form-control" name="password" type="password" value="{{ old('name', $admin->password ) }}" readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Alamat</label>
                                <input class="form-control" name="alamat" type="text" value="{{ old('name', $admin->alamat ) }}" readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Tempat Lahir</label>
                                <input class="form-control" name="tempat_lahir" type="text" value="{{ old('name', $admin->tempat_lahir ) }}" readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input id="picker3" class="form-control" placeholder="yyyy-mm-dd" name="tanggal_lahir" value="{{ old('name', $admin->tanggal_lahir ) }}" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary"  type="button">
                                            <i class="icon-regular i-Calendar-4"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="sales_id">Jabatan</label>
                                <input class="form-control" name="jabatan" type="text" value="{{ old('name', $admin->jabatan ) }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12 text-right">
                            <a href="{{route('admin.admin.list')}}" class="btn btn-outline-secondary m-1">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('bottom-js')
{{--    <script type="text/javascript">--}}

{{--        $(function(){--}}
{{--            $('#sales_id').select2({--}}
{{--                ajax: {--}}
{{--                    url: "{{ route('admin.salesperson.search.sales-id') }}",--}}
{{--                    data: function (params) {--}}
{{--                        var query = {--}}
{{--                            term: params.term--}}
{{--                        }--}}

{{--                        // Query parameters will be ?search=[term]&type=public--}}
{{--                        return query;--}}
{{--                    },--}}
{{--                    dataType: 'json'--}}
{{--                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example--}}
{{--                },--}}
{{--                placeholder: "Select sales ID"--}}
{{--            }).on('select2:select', function (result) {--}}
{{--                $('#email').val(result.params.data.sales_email);--}}
{{--                $('#name').val(result.params.data.sales_name);--}}
{{--                $('#username').val(result.params.data.id);--}}
{{--            });--}}

{{--            // $('#branch').select2({--}}
{{--            //     placeholder: "Select branch"--}}
{{--            // });--}}
{{--        });--}}
{{--    </script>--}}
    <script src="{{asset('assets/js/form.basic.script.js')}}"></script>
    <script src="{{asset('assets/js/form.validation.script.js')}}"></script>
@endsection
