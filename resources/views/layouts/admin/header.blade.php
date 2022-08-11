<!-- header start -->
<header class=" main-header bg-white d-flex justify-content-between p-2">
    <div class="header-toggle">
        <div class="menu-toggle mobile-menu-icon">
            <div></div>
            <div></div>
            <div></div>
        </div>

    </div>
    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
        <!-- Grid menu Dropdown -->
        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div  class="user col align-self-end">
                <img src="{{asset('/images/user.png')}}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> {{ Auth::user()->nama }}
                    </div>
                    <a href="#" class="dropdown-item"
                        data-toggle="modal"
                        data-target="#changePasswordModal">Change Password
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
</header>
<!-- header close -->

<!-- Modal Verif OTP -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('admin.home.changePassword')}}" method="POST">
                {{ method_field('post') }}
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="homepass_name" class="col-sm-6 col-form-label">Old Password:</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control" name="old_password"
                                placeholder="Old Password" required>
                    </div>
                    <label for="newPassword" class="col-sm-6 col-form-label">New Password:</label>
                    <div class="col-sm-12">
                        <input id="newPassword" type="password" class="form-control" name="new_password"
                                placeholder="New Password" required>
                    </div>
                    <label for="retypeNewPassword" class="col-sm-6 col-form-label">Retype New Password:</label>
                    <div class="col-sm-12">
                        <input id="retypeNewPassword" type="password" class="form-control" name="retype_new_password"
                                placeholder="Retype New Password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('bottom-js')

@endsection
