<div class="left-side-menu mm-show">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('images/logo/logo-vnext-white-2019.png') }}" alt="" height="60">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo/icon-small.png') }}" alt="" height="32">
        </span>
    </a>

    <!-- LOGO -->
    <div class="h-100 mm-active" id="left-side-menu-container" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">

                            <!--- Sidemenu -->
                            <ul class="metismenu side-nav mm-show">

                                <li class="side-nav-title side-nav-item">Navigation</li>

                                <li class="side-nav-item">

                                    <a href="" class="side-nav-link">
                                        <i class="mdi mdi-account-circle-outline"></i>
                                        <span> Hello,
                                        @isset(Auth::user()->name)
                                            {{ Auth::user()->name }}
                                        @endisset
                                        </span>
                                    </a>
                                </li>

                                <li class="side-nav-item">
                                    <a href="" class="side-nav-link">
                                        <i class="mdi mdi-home mdi-24px"></i>
                                        <span> Home </span>
                                    </a>
                                </li>

                                <li class="side-nav-item">
                                    <a href="{{route("products.index")}}" class="side-nav-link">
                                        <i class="mdi mdi-store mdi-24px"></i>
                                        <span> Products </span>
                                    </a>
                                </li>

                                <li class="side-nav-item">
                                    <a href="{{route("categories.index")}}" class="side-nav-link">
                                        <i class="mdi mdi-github-circle mdi-24px"></i>
                                        <span> Categories </span>
                                    </a>
                                </li>

                                <li class="side-nav-item">
                                    <a href="{{route("makers.index")}}" class="side-nav-link">
                                        <i class="mdi mdi-database-marker mdi-24px"></i>
                                        <span> Makers </span>
                                    </a>
                                </li>

                                <li class="side-nav-item">
                                    <a href="{{route("news.index")}}" class="side-nav-link">
                                        <i class="mdi mdi-newspaper mdi-24px"></i>
                                        <span> News </span>
                                    </a>
                                </li>

                                <li class="side-nav-item">
                                    <a href="{{route("users.index")}}" class="side-nav-link">
                                        <i class="mdi mdi-account-multiple mdi-24px"></i>
                                        <span> Users </span>
                                    </a>
                                </li>

                                <li class="side-nav-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="side-nav-link" href="route('logout')"
                                           onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            <i class="mdi mdi-logout mdi-24px"></i>
                                            <span> Logout </span>
                                        </a>
                                    </form>
                                </li>

                            </ul>

                            <!-- Help Box -->

                            <!-- end Help Box -->
                            <!-- End Sidebar -->

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 100px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
        </div>
    </div>
    <!-- Sidebar -left -->

</div>
