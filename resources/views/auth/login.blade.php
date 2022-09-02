@extends(config('app.templates.auth'))
@push('stylesheet')
    <style>
        .bg-white-o-5 {
            background: rgba(255, 255, 255, 0.02) !important
        }
    </style>
@endpush
@push('script')
    <script>
        "use strict";
        // Class Definition
        var KTLoginGeneral = function() {
            var handleSignInFormSubmit = function() {
                $('#kt_login_signin_submit').click(function(e) {
                    e.preventDefault();
                    var btn = $(this);
                    var form = $(this).closest('form');
                    form.validate({
                        errorClass: "invalid-feedback",
                        errorPlacement: function(error, element) {
                            if (element.parent('.input-group').length) {
                                error.insertAfter(element.parent());
                            } else {
                                error.insertAfter(element);
                            }
                        },
                        onError: function() {
                            $('.input-group.invalid-feedback').find('.help-block.form-error')
                                .each(function() {
                                    $(this).closest('.form-group').addClass(
                                        'invalid-feedback').append($(this));
                                });
                        },
                        rules: {
                            email: {
                                required: true
                            },
                            password: {
                                required: true
                            }
                        },
                        messages: {
                            email: {
                                required: "Email tidak boleh kosong"
                            },
                            password: {
                                required: "Password tidak boleh kosong"
                            }
                        }
                    });
                    if (!form.valid()) {
                        return;
                    }
                    form.submit();
                });
            }
            // Public Functions
            return {
                init: function() {
                    handleSignInFormSubmit();
                }
            };
        }();
        jQuery(document).ready(function() {
            KTLoginGeneral.init();
        });
    </script>
@endpush

@section('content')
    <div class="kt-login__container" style="margin-top: 25%">
        <div class="kt-login__logo">
            <a href="#">
                <img width="100" src="{{ asset('vendor/metronic-3/media/logos/logo-4-sm.png') }}">
            </a>
        </div>
        <div class="kt-login__signin">
            <div class="kt-login__head">
                <h3 class="kt-login__title">Silahkan Login</h3>
            </div>
            <form class="kt-form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input
                        class="form-control text-white bg-white-o-5 border-0 @error('email') is-invalid @enderror @error('username') is-invalid @enderror"
                        type="text" placeholder="Email" name="email" value="{{ old('email') ?: old('username') }}"
                        required autocomplete="off" autofocus>
                    @error('email')
                        <div class="error invalid-feedback" role="alert">
                            {{ __($message, ['attribute' => 'email']) }}
                        </div>
                    @enderror
                    @error('username')
                        <div class="error invalid-feedback" role="alert">
                            {{ __($message, ['attribute' => 'email']) }}
                        </div>
                    @enderror
                </div>
                {{-- rgba(255, 255, 255, 0.02) !important --}}
                <div class="input-group">
                    <input class="form-control text-white bg-white-o-5 border-0" type="password" placeholder="Password"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <div class="error invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group text-center mt-5">
                </div>
                <div class="kt-login__actions">
                    <button id="kt_login_signin_submit"
                        class="btn btn-brand btn-elevate kt-login__btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script>
        @isset($workspaces)
            $('#exampleModal').modal('show')
        @endisset
        $("input:password").password()
        $("input:password ~ .input-group-append > button").attr('class', 'form-control bg-white-o-5')
        $('#workspace_id').select2({
            placeholder: "Choose Workspace",
            width: '100%'
        });
    </script>
@endpush
