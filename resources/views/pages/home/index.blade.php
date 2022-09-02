@extends(config('app.templates.main'), [
    'breadcrumb' => [['title' => 'Home']],
])
@push('stylesheet')
@endpush

@section('title')
    Home
@endsection
@section('content')
@endsection
