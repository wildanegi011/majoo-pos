<table id="{{ $tableId }}" class="table align-middle table-row-dashed fs-6 gy-5">
    <thead>
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                        data-kt-check-target="#{{ $tableId }} .form-check-input" value="1" />
                </div>
            </th>
            @foreach ($fieldsToArray as $field)
                @if ($field != 'id')
                    <th>{{ Str::replaceFirst('_', ' ', $field) }}</th>
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody class="text-gray-800 fw-semibold">

    </tbody>
</table>
