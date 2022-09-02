@extends(config('app.templates.main'), [
    'breadcrumb' => [['title' => 'Product']],
])
@push('stylesheet')
@endpush

@section('title')
    Product
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                    @include('pages.component.search.index', ['filter' => true])
                </div>
            </div>
            <div class="card-toolbar">
                @include('pages.component.button.crud', [
                    'routeCreate' => route('product.create'),
                    'routeRefresh' => route('product.index'),
                ])
            </div>
        </div>
        <div class="card-body">
            @include('pages.component.table.index', ['tableId' => 'kt_product_table'])
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('metronic/js/datatable.js') }}"></script>
    <script>
        var columns = {!! $fieldsToJson !!}

        KTDatatable('#kt_product_table', {
            'token': '{{ csrf_token() }}',
            'datatable': '{{ route('product.datatable') }}',
            'destroy': '{{ route('product.destroy', ['id' => ':id']) }}',
            'destroyMany': '{{ route('product.destroyMany') }}',
        }, columns, [{
                targets: 0,
                orderable: false,
                render: function(data) {
                    return `
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="${data}" />
                    </div>`;
                }
            },
            {
                targets: 1,
                width: "500",
                render: function(data, type, row) {
                    let avatar = `
                        <a href="#">
                            <div class="symbol-label">
                                <img src="/metronic/media/paket-advance.png" alt="" class="w-100">
                            </div>
                        </a>
                    `
                    if (row.image) {
                        avatar = `
                            <a href="#">
                                <div class="symbol-label">
                                    <img src="${row.image}" alt="${row.name}" class="w-100">
                                </div>
                            </a>
                        `
                    }

                    return `<div class="d-flex align-items-center">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                ` + avatar + `
                            </div>
                            <div class="d-flex justify-content-start flex-column">
                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">${row.name}</a>
                                <span class="text-muted fw-bold text-muted d-block fs-7">${row.description}</span>
                            </div>
                        </div>`
                }
            },
            {
                targets: 2,
                render: function(data, type, row) {
                    return row.category
                }
            },
            {
                targets: 3,
                render: function(data, type, row) {
                    const numb = row.price;
                    const format = numb.toString().split('').reverse().join('');
                    const convert = format.match(/\d{1,3}/g);
                    const rupiah = 'Rp ' + convert.join('.').split('').reverse().join('')

                    return rupiah
                }
            },
            {
                targets: -1,
                data: null,
                orderable: false,
                className: 'text-end',
                render: function(data, type, row) {
                    let editUrl = '{{ route('product.edit', ['id' => ':id']) }}'
                        .replace(':id', row.id);
                    let deleteUrl = '{{ route('product.destroy', ['id' => ':id']) }}'
                        .replace(':id', row.id);

                    return `
                    <a href="#" class="" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                        <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <rect x="10" y="10" width="4" height="4" rx="2" fill="currentColor"/>
                            <rect x="17" y="10" width="4" height="4" rx="2" fill="currentColor"/>
                            <rect x="3" y="10" width="4" height="4" rx="2" fill="currentColor"/>
                            </svg>
                        </span>
                    </a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="` + editUrl + `" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                Edit
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="` + deleteUrl + `" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
                                Delete
                            </a>
                        </div>
                        <!--end::Menu item-->

                `;
                },
            },
        ])
    </script>
@endpush
