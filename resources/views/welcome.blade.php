<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Majoo Teknologi Indonesia</title>

    <link href="{{ asset('metronic/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"
        id="plugins_css" />
    <link href="{{ asset('metronic/css/style.bundle.css') }}" rel="stylesheet" type="text/css" id="style_css" />

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .navbar {
            width: 100%;
            background: #000000c7;
        }

        .header h3 {
            font-family: monospace;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="header">
            <h3 class="text-white mx-10">Majoo Teknologi Indonesia</h3>
        </div>
    </div>
    <div class="content px-10 h-lg-100">
        <div class="row">
            <div class="col-lg-2">
                <h3 class="fs-2x fw-boldest">Produk</h3>
            </div>
            <div class="row my-5">
                @foreach ($products['data'] as $product)
                    <div class="col-lg-2">
                        <div class="card card-stretch card-bordered mb-5">
                            <div class="card-body">
                                <div class="text-center">
                                    <img class="card-img" src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                                    <h5 class="mb-5 my-5 fw-normal">{{ $product['name'] }}</h5>
                                    <div class="d-flex justify-content-center mb-5">
                                        <h5>
                                            <span class="fs-7 fw-normal">Rp</span>
                                        </h5>
                                        <h5 class="my-1 mx-1">
                                            <span class="fs-4">{{ $product['price'] }}</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="mb-19 text-left">
                                    {{ $product['description'] }}
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-sm btn-light">Beli</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <div class="footer py-4" id="kt_footer">
        <div class="">
            <div class="text-dark order-2 order-md-1 text-center">
                <span class="text-muted fw-bold me-1">2022©</span> PT Majoo Teknologi Indonesia
            </div>
        </div>
    </div>


</body>

</html>
