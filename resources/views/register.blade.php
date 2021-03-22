@extends('headerlogin')
@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-50 p-b-90 bg-dark">
            @isset($url)
                    <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
                    @else
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                    @endisset
                        @csrf
                <span class="login100-form-title p-b-51">
                    Restoran - {{ isset($url) ? ucwords($url) : ""}} {{ __('Register') }}
                </span>

                <div
                    class="wrap-input100 validate-input"
                    data-validate="Nama tidak boleh kosong">
                    <div class="mt-2 mb-2 row">
                        <i class="fa fa-user icon mr-2"></i>
                        <input id="name" type="text" class="input100 form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" placeholder="Nama" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <span class="focus-input100"></span>
                        </div>
                    </div>

                <div
                    class="wrap-input100 validate-input"
                    data-validate="Username tidak boleh kosong">
                    <div class="mt-2 mb-2 row">
                        <i class="fa fa-user icon mr-2"></i>
                        <input id="username" type="text" class="input100 form-control @error('username') is-invalid @enderror" name="username" required autocomplete="username" placeholder="Username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <span class="focus-input100"></span>
                        </div>
                    </div>

                    <div
                        class="wrap-input100 validate-input"
                        data-validate="Kata Sandi tidak boleh kosong">
                        <div class="mt-2 mb-2 row">
                            <i onclick="show('pass')" class="fa fa-key icon mr-2"></i>
                            <input id="password" type="password" class="input100 form-control @error('password') is-invalid @enderror" name="password" required placeholder="Kata Sandi" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="focus-input100"></span>
                                {{-- <i onclick="show('pass')" class="fa fa-eye icon fixed-right"></i> --}}
                            </div>
                        </div>

                        <div
                        class="wrap-input100 validate-input"
                        data-validate="Kata Sandi tidak boleh kosong">
                        <div class="mt-2 mb-2 row">
                            <i onclick="show('pass')" class="fa fa-key icon mr-2"></i>
                            <input id="password-confirm" type="password" class="input100 form-control @error('password') is-invalid @enderror" name="password-confirm">

                                @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="focus-input100"></span>
                                {{-- <i onclick="show('pass')" class="fa fa-eye icon fixed-right"></i> --}}
                            </div>
                        </div>

                        <div class="container-login100-form-btn m-t-17">
                            <button type="submit" class="login100-form-btn btn-success">
                                {{ __('Daftar') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	
	<script>
		function show(id) {
			var a = document.getElementById(id);
			if (a.type == "password") {
				a.type = "text";

			} else {
				a.type = "password";

			}
		}
	</script>
@endsection
