{{-- <div class="content d-flex flex-column flex-column-fluid" id="kt_content"> --}}
<!--begin::Post-->
{{-- @yield('content') --}}
<!--end::Post-->
{{-- </div> --}}

{{-- <div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl" style="max-width: 100%">
        <ol class="breadcrumb text-muted fs-6 fw-bold mb-3">
            @for ($i = 0; $i < count($breadcrumb); $i++)
                <li class="breadcrumb-item pe-3">
                    <a href="#"
                        class="pe-3 @if ($i + 1 === count($breadcrumb)) {{ 'text-muted' }} @endif">{{ $breadcrumb[$i]['title'] }}</a>
                </li>
            @endfor
        </ol>
        @yield('content')
    </div>
</div> --}}


<div id="kt_content_container" class="container-fluid">
    {{-- <ol class="breadcrumb text-muted fs-6 fw-bold mb-3">
        @for ($i = 0; $i < count($breadcrumb); $i++)
            <li class="breadcrumb-item pe-3">
                <a href="#"
                    class="pe-3 @if ($i + 1 === count($breadcrumb)) {{ 'text-muted' }} @endif">{{ $breadcrumb[$i]['title'] }}</a>
            </li>
        @endfor
    </ol> --}}
    @yield('content')
</div>
