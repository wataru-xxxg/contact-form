@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('button')
<button class="title_btn-link" type="submit"><a href="/register">register</a></button>
@endsection

@section('content')
<div class="login__content">
    <div class="login__heading">
        <h2>Login</h2>
    </div>
    <!-- /.login__heading -->
    <form action="/login" method="post" class="login-form">
        @csrf
        <div class="login-form__group">
            <div class="login-form__group-title">
                <span class="login-form__label--text">メールアドレス</span>
            </div>
            <!-- /.login-form__group-title -->
            <div class="login-form__group-content">
                <div class="login-form__input--text">
                    <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                <!-- /.login-form__input--text -->
            </div>
            <!-- /.login-form__group-content -->
            @error('email')
            <div class="login-form__error">
                {{ $message }}
            </div>
            <!-- /.login-form__error -->
            @enderror
            <div class="login-form__group-title">
                <span class="login-form__label--text">パスワード</span>
            </div>
            <!-- /.login-form__group-title -->
            <div class="login-form__group-content">
                <div class="login-form__input--text">
                    <input type="text" name="password" placeholder="例: coachtech1106" value="{{ old('password') }}">
                </div>
                <!-- /.login-form__input--text -->
            </div>
            <!-- /.login-form__group-content -->
            @error('password')
            <div class="login-form__error">
                {{ $message }}
            </div>
            <!-- /.login-form__error -->
            @enderror
            <div class="login-form__group-button">
                <button class="login-form__group-button-submit">ログイン</button>
            </div>
            <!-- /.login-form__group-button -->
        </div>
        <!-- /.login-form__group -->
    </form>
</div>
<!-- /.login__content -->
@endsection