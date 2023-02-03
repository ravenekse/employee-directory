@extends('layouts.layout')
@section('title', 'Logowanie')

@section('content')
    <div class="login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center h5">
                    <b>{{ config('app.name') }}</b> - Logowanie
                </div>
                <div class="card-body">
                    @if(session("NOTIFICATION"))
                        @php
                            $notification = (object) session("NOTIFICATION")
                        @endphp
                        <div class="alert alert-{{ $notification->type }} text-center">
                            {{ $notification->message }}
                        </div>
                    @endif
                    <form action="{{ route("auth.login.form") }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ old('email') }}" placeholder="Adres e-mail">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="ri-mail-line"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Hasło">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="ri-lock-password-line"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember_me">
                                    <label for="remember">
                                        Zapamiętaj mnie
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 mx-auto mt-2">
                                <button type="submit" class="btn btn-primary btn-block">Zaloguj się</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
