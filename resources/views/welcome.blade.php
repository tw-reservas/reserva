
@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', "Iniciar Sesión")


@section('auth_body')
    <form action="{{route('login.paciente')}}" method="post">
        @csrf
        @method('POST')
        {{-- Matricula field --}}
        <div class="input-group mb-3">
            <input type="matricula" name="matricula" autocomplete="off"  class="form-control @error('matricula') is-invalid @enderror"
                   value="{{ old('matricula') }}" placeholder="{{ __('adminlte::adminlte.matricula') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('matricula')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember">
                        {{ __('adminlte::adminlte.remember_me') }}
                    </label>
                </div>
            </div>

            <div class="col-5">
                <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>

    </form>
@stop

@section('auth_footer')

@stop

