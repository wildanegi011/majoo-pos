@if (isset($routeCreate))
    <a href="{{ $routeCreate }}" style="margin-right: 1px" data-bs-toggle="tooltip" title="{{ __('label.add') }}">
        <button class="btn btn-icon btn-light-facebook">
            <i class="fa fa-plus-circle"></i></button>
    </a>
@endif
@if (isset($routeRefresh))
    <a href="{{ $routeRefresh }}" style="margin-right: 1px" data-bs-toggle="tooltip" title="{{ __('label.refresh') }}">
        <button class="btn btn-icon btn-light-facebook" data-bs-toggle="tooltip" title="refresh"
            style="margin-right: 1px"><i class="la la-refresh fs-4"></i></button>
    </a>
@endif
{{-- <button class="btn btn-icon btn-light-facebook" style="margin-right: 1px" data-bs-toggle="tooltip" title="update"><i
        class="fa fa-pencil-alt"></i></button> --}}
<div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
    <button class="btn btn-light-facebook" data-kt-docs-table-select="delete_selected" data-bs-toggle="tooltip"
        title="delete"><i class="fa fa-trash"></i> <span class="fs-7"></span>
    </button>
</div>
@if (isset($routeBack))
    <a href="#" style="margin-right: 1px" data-bs-toggle="tooltip" title="{{ __('label.back') }}">
        <button class="btn btn-icon btn-light-facebook">
            <i class="fa fa-arrow-left""></i></button>
    </a>
@endif
