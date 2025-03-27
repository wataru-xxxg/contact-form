@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('button')
<button class="title_btn-link" type="submit"><a href="/login">login</a></button>
@endsection

@section('content')
<div class="register__content">
    <div class="register__heading">
        <h2>Register</h2>
    </div>
    <!-- /.register__heading -->
    <form action="/register" method="post" class="register-form">
        @csrf
        <div class="register-form__group">
            <div class="register-form__group-title">
                <span class="register-form__label--text">お名前</span>
            </div>
            <!-- /.register-form__group-title -->
            <div class="register-form__group-content">
                <div class="register-form__input--text">
                    <input type="text" name="name" placeholder="例: 山田　太郎" value="{{ old('name') }}">
                </div>
                <!-- /.register-form__input--text -->
            </div>
            <!-- /.register-form__group-content -->
            <div class="register-form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <!-- /.register-form__error -->
            <div class="register-form__group-title">
                <span class="register-form__label--text">メールアドレス</span>
            </div>
            <!-- /.register-form__group-title -->
            <div class="register-form__group-content">
                <div class="register-form__input--text">
                    <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                <!-- /.register-form__input--text -->
            </div>
            <!-- /.register-form__group-content -->
            <div class="register-form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <!-- /.register-form__error -->
            <div class="register-form__group-title">
                <span class="register-form__label--text">パスワード</span>
            </div>
            <!-- /.register-form__group-title -->
            <div class="register-form__group-content">
                <div class="register-form__input--text">
                    <input type="text" name="password" placeholder="例: coachtech1106" value="{{ old('password') }}">
                </div>
                <!-- /.register-form__input--text -->
            </div>
            <!-- /.register-form__group-content -->
            <div class="register-form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
            <!-- /.register-form__error -->
            <div class="register-form__group-button">
                <button class="register-form__group-button-submit">登録</button>
            </div>
            <!-- /.register-form__group-button -->
        </div>
        <!-- /.register-form__group -->
    </form>
</div>
<!-- /.register__content -->
@endsection