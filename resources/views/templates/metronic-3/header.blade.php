<div id="kt_header" style="" class="header align-items-stretch shadow">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                id="kt_aside_mobile_toggle">
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                            fill="currentColor" />
                        <path opacity="0.3"
                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                            fill="currentColor" />
                    </svg>
                </span>
            </div>
        </div>
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="?page=index" class="d-lg-none">
                <img alt="Logo" src="assets/media/logos/logo-2.svg" class="h-30px" />
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-center" id="kt_header_nav">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                        @yield('title')
                        <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 ms-2 mt-1">
                            @for ($i = 0; $i < count($breadcrumb); $i++)
                                <li class="breadcrumb-item">
                                    <a href="#"
                                        class="@if ($i + 1 === count($breadcrumb)) {{ 'text-dark' }}@else {{ 'text-muted text-hover-primary' }} @endif">{{ $breadcrumb[$i]['title'] }}</a>
                                </li>
                                @if ($i + 1 !== count($breadcrumb))
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                                    </li>
                                @endif
                            @endfor
                        </ul>
                    </h1>
                </div>

            </div>

            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click"
                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img src="{{ Session()->get('user_oauth.photo_profile') ? Session()->get('user_oauth.photo_profile') : asset('metronic/media/svg/avatars/blank.svg') }}"
                            alt="user" />
                    </div>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img src="{{ Session()->get('user_oauth.photo_profile') ? Session()->get('user_oauth.photo_profile') : asset('metronic/media/svg/avatars/blank.svg') }}"
                                        alt="user" />
                                </div>

                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                        {{ Auth::user() ? Auth::user()->name : '' }}
                                    </div>
                                    <a href="#"
                                        class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user() ? Auth::user()->email : '' }}</a>
                                </div>

                            </div>
                        </div>

                        <div class="separator my-2"></div>

                        <div class="menu-item px-5">
                            <a href="#" class="menu-link px-5">My Profile</a>
                        </div>

                        <div class="separator my-2"></div>

                        <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title position-relative">Language
                                    <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                        English
                                        <img class="w-15px h-15px rounded-1 ms-2" src=""
                                            alt="" /></span></span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4 switch-language">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-language="English">
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1"
                                                src="{{ asset('metronic/media/flags/united-states.svg') }}"
                                                alt="" />
                                        </span>English</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5 " data-language="Indonesia">
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1"
                                                src="{{ asset('metronic/media/flags/indonesia.svg') }}"
                                                alt="" />
                                        </span>Indonesia</a>
                                </div>

                            </div>
                            <!--end::Menu sub-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5 my-1">
                            <a href="#" class="menu-link px-5">Account Settings</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{ route('logout') }}" class="menu-link px-5"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none">
                                @csrf
                            </form>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <div class="menu-content px-5">
                                <label
                                    class="form-check form-switch form-check-custom form-check-solid pulse pulse-success"
                                    for="kt_user_menu_dark_mode_toggle">
                                    <input class="form-check-input w-30px h-20px switch-toggle-mode" type="checkbox"
                                        value="1" name="mode" id="kt_user_menu_dark_mode_toggle"
                                        data-kt-url="../../demo1/dist/?page=index&amp;mode=dark" />
                                    <span class="pulse-ring ms-n1"></span>
                                    <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                                </label>
                            </div>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->


                </div>
            </div>


        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
