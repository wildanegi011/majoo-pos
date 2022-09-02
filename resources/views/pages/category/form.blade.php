@extends(config('app.templates.main'), [
    'breadcrumb' => [['title' => 'Category'], ['title' => @$category ? 'update' : 'create']],
])
@push('stylesheet')
    <style>
        .form-required::after {
            content: " wajib diisi";
            color: #f1416c;
            font-size: 9px;
        }
    </style>
@endpush

@section('title')
    Category
@endsection
@section('content')
    <form action="{{ @$category ? route('category.update', ['id' => $category['id']]) : route('category.store') }}"
        method="POST" enctype="multipart/form-data">
        @if (@$category)
            @method('PUT')
        @endif
        @csrf
        <div class="card mb-5">
            <!--begin::Header-->
            <div class="card-header">
                <h3 class="card-title">Category Information</h3>
            </div>
            <div class="card-body">
                <input type="hidden" name="is_active" id="is_active"
                    value="{{ @$category['is_active'] ? @$category['is_active'] : '1' }}">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group row mb-5">
                            <label class="col-md-12 col-form-label form-required">Category Name</label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-bag-fill fs-4"></i></span>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', @$category['name']) }}">
                                    @error('name')
                                        <div class="error invalid-feedback" role="alert">
                                            {{ __($message) }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary" id="save"><i class="fas fa-save"></i>
                    Simpan</button>
                <a href="{{ route('category.index') }}">
                    <button type="button" class="btn btn-sm btn-danger">Batal</button>
                </a>
            </div>
        </div>
    </form>
@endsection

@push('script')
@endpush
