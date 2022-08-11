<!-- start sidebar -->
<div class="sidebar-panel">
    <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center">
        <img class="pl-3" src="{{ asset('images/my-republic-logo.png') }}" alt="">
        <!-- <span class=" item-name text-20 text-primary font-weight-700">GULL</span> -->
        <div class="sidebar-compact-switch ml-auto"><span></span></div>

    </div>
    <!-- user -->
    <div class="scroll-nav" data-perfect-scrollbar data-suppress-scroll-x="true">

        <!-- user close -->
        <!-- side-nav start -->
        <div class="side-nav">

            <div class="main-menu">
                <ul class="metismenu" id="menu">
                    <li class="Ul_li--hover">
                        <a class="" href="{{route('admin.home')}}">
                            <i class="i-Home1 text-20 mr-2 text-muted"></i>
                            <span class="item-name  text-muted">Home</span>
                        </a>
                    </li>
                    <li class="Ul_li--hover">
                        <a class="" href="{{route('admin.siswa.list')}}">
                            <i class="i-Target-Market text-20 mr-2 text-muted"></i>
                            <span class="item-name  text-muted">Siswa</span>
                        </a>
                    </li>
                    <li class="Ul_li--hover">
                        <a class="" href="{{route('admin.beasiswa.list')}}">
                            <i class="i-Target-Market text-20 mr-2 text-muted"></i>
                            <span class="item-name  text-muted">Beasiswa</span>
                        </a>
                    </li>
                    <li class="Ul_li--hover">
                        <a class="" href="{{route('admin.beasiswa-siswa')}}">
                            <i class="i-Target-Market text-20 mr-2 text-muted"></i>
                            <span class="item-name  text-muted">Hasil Beasiswa</span>
                        </a>
                    </li>
                    @if(\Illuminate\Support\Facades\Auth::user()->jabatan != "pengurus")
                        <li class="Ul_li--hover">
                            <a class="" href="{{route('admin.admin.list')}}">
                                <i class="i-Target-Market text-20 mr-2 text-muted"></i>
                                <span class="item-name  text-muted">Admin</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- side-nav-close -->
</div>
<!-- end sidebar -->
