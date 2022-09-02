@extends(config('app.templates.main'), [
    'breadcrumb' => [['title' => 'Product'], ['title' => @$product ? 'update' : 'create']],
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
    Product
@endsection
@section('content')
    <form action="{{ @$product ? route('product.update', ['id' => $product['id']]) : route('product.store') }}" method="POST"
        enctype="multipart/form-data">
        @if (@$product)
            @method('PUT')
        @endif
        @csrf
        <div class="card mb-5">
            <!--begin::Header-->
            <div class="card-header">
                <h3 class="card-title">Product Information</h3>
            </div>
            <div class="card-body">
                <input type="hidden" name="is_active" id="is_active"
                    value="{{ @$product['is_active'] ? @$product['is_active'] : '1' }}">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group row mb-5">
                            <label class="col-md-12 col-form-label form-required">Product Name</label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-bag-fill fs-4"></i></span>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', @$product['name']) }}">
                                    @error('name')
                                        <div class="error invalid-feedback" role="alert">
                                            {{ __($message) }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label class="col-md-12 col-form-label form-required">Description</label>
                            <div class="col-md-12">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">
                                    {{ old('description', @$product['description']) }}
                                </textarea>
                                @error('description')
                                    <div class="error invalid-feedback" role="alert">
                                        {{ __($message) }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-md-12 col-form-label form-required">Product Price</label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-cash-coin fs-4"></i></span>
                                    <input type="text" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', @$product['price']) }}">
                                    <span class="input-group-text">IDR</span>
                                    @error('price')
                                        <div class="error invalid-feedback" role="alert">
                                            {{ __($message) }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-md-12 col-form-label form-required">Category</label>
                            <div class="col-md-12">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text"><i class="bi bi-app fs-4"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-0 @error('description') is-invalid @enderror"
                                            data-control="select2" data-placeholder="Select category" name="category_id">
                                            <option></option>
                                            @foreach ($category['data'] as $item)
                                                <option value="{{ $item['id'] }}" @selected($item['id'] == @$product->category_id)>
                                                    {{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="error invalid-feedback" role="alert">
                                                {{ __($message) }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-md-12 col-form-label form-required">Upload Images</label>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <!--begin::Input group-->
                                    <div class="fv-row">
                                        <!--begin::Dropzone-->
                                        <div class="dropzone" id="kt_dropzonejs_example_1">
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick">
                                                <!--begin::Icon-->
                                                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                <!--end::Icon-->

                                                <!--begin::Info-->
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or
                                                        click to upload.</h3>
                                                    <span class="fs-7 fw-bold text-gray-400">Upload up to 10
                                                        files</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary disabled" id="save"><i class="fas fa-save"></i>
                    Simpan</button>
                <a href="{{ route('product.index') }}">
                    <button type="button" class="btn btn-sm btn-danger">Batal</button>
                </a>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="/vendor/metronic-3/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
    {{-- <script src="/vendor/metronic-3/plugins/custom/tinymce/tinymce.bundle.js"></script> --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

        var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
            url: '{{ route('product.upload') }}', // Set the url for your upload script location
            paramName: "image", // The name that will be used to transfer the file
            maxFiles: 1,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
                if (file.name == "wow.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            },
            init: function() {
                @if (@$product)
                    image = "/{{ $product['image'] }}"

                    let mockFile = {
                        name: 'image',
                        size: '200'
                    }
                    this.emit("addedfile", mockFile);
                    this.emit("complete", mockFile);
                    this.files.push(mockFile);
                    this.options.thumbnail.call(this, mockFile, image);
                @endif
            },
            success: function(file, response) {
                if (!response.success) {
                    Swal.fire({
                        title: 'Upload Gagal!',
                        text: "Upload file gagal, silahkan ulangi lagi",
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ya',
                    }).then((result) => {
                        this.removeFile(this.file)
                    });
                } else {
                    $('#save').removeClass('disabled');
                }
            },
            sending: function(file, xhr, formData) {
                formData.append("_token", '{{ csrf_token() }}');
                // formData.append("id", '{{ @$result['id'] }}');
                formData.append("filename", 'image');
            }
        });
    </script>
@endpush
