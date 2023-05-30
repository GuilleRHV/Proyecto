@extends('layouts.app')

@section('content')



<div class="container py-4">
    <div class="row g-0 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
                <div class="card-body p-5 shadow-5 text-center">
                    <h1>Registrarse</h1>
                    <br>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1">Nombre</label>
                                    <input type="text" id="form3Example1" class="form-control" name="name" />

                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example2">Apellido</label>
                                    <input type="text" id="form3Example2" class="form-control" name="apellido" />

                                </div>
                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="formemail">Direccion de correo electronico</label>
                            <input type="email" id="formemail" class="form-control" name="email" />

                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="formpassword">Contraseña</label>
                            <input type="password" id="formpassword" class="form-control" name="password" />

                        </div>

                        <div class="form-outline mb-4">
                        <label class="form-label" for="formpassword">Repite la contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mb-4">
                            Registrarse
                        </button>



                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
        <img src="{{asset('imagenes/logo.JPG')}}" class="w-100 shadow-4" style="height: 590px; border-radius: 0 20px 20px 0; "
          alt="" />
      </div>
    </div>
</div>


























<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center; background-color:#63D2FA">
                    <h3>{{ __('Registrarse') }}</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <img src="imagenes/user.png" id="userimagenregistro">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="apellido" class="col-md-4 col-form-label text-md-end">{{ __('apellido') }}</label>

                            <div class="col-md-6">
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>

                                @error('apellido')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>





                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Direccion de email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Repite tu contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection