@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact__content">
    <div class="contact__heading">
        <h2>Contact</h2>
    </div>
    <!-- /.contact__heading -->
    <form action="/confirm" method="post" class="contact-form">
        @csrf
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <span class="contact-form__label--text">お名前 ※</span>
            </div>
            <!-- /.contact-form__group-title -->
            <div class="contact-form__group-content-name">
                <div class="contact-form__input--text-last">
                    <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">

                    @error('last_name')
                    <div class="contact-form__error-name">
                        <p>{{ $message }}</p>
                    </div>
                    <!-- /.contact-form__error-name -->
                    @enderror
                </div>
                <!-- /.contact-form__input--text-name -->
                <div class="contact-form__input--text-first">
                    <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                    @error('first_name')
                    <div class="contact-form__error-name">
                        <p>{{ $message }}</p>
                    </div>
                    <!-- /.contact-form__error-name -->
                    @enderror
                </div>
                <!-- /.contact-form__input--text-name -->
            </div>
            <!-- /.contact-form__group-content-name -->
        </div>
        <!-- /.contact-form__group -->
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <span class="contact-form__label--text">性別 ※</span>
            </div>
            <!-- /.contact-form__group-title -->
            <div class="contact-form__group-content-gender">
                <div class="contact-form__input--radio">
                    <label for="male">
                        <input {{ old('gender','1') == '1' ? 'checked' : '' }} type="radio" name="gender" id="male" value=1>&nbsp;&nbsp;&nbsp;男性
                    </label>
                </div>
                <!-- /.contact-form__input--radio -->
                <div class="contact-form__input--radio">
                    <label for="female">
                        <input {{ old('gender') == '2' ? 'checked' : ''}} type="radio" name="gender" id="female" value=2>&nbsp;&nbsp;&nbsp;女性
                    </label>
                </div>
                <!-- /.contact-form__input--radio -->
                <div class="contact-form__input--radio">
                    <label for="other">
                        <input {{ old('gender') == '3' ? 'checked' : ''}} type="radio" name="gender" id="other" value=3>&nbsp;&nbsp;&nbsp;その他
                    </label>
                </div>
                <!-- /.contact-form__input--radio -->
            </div>
            <!-- /contact-form__group-content-gender -->
        </div>
        <!-- /.contact-form__group -->
        @error('gender')
        <div class="contact-form__error">
            <p>{{ $message }}</p>
        </div>
        <!-- /.contact-form__error -->
        @enderror
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <span class="contact-form__label--text">メールアドレス ※</span>
            </div>
            <!-- /.contact-form__group-title -->
            <div class="contact-form__group-content">
                <div class="contact-form__input--text">
                    <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                <!-- /.contact-form__input--text -->
            </div>
            <!-- /contact-form__group-content -->
        </div>
        <!-- /.contact-form__group -->
        @error('email')
        <div class="contact-form__error">
            <p>{{ $message }}</p>
        </div>
        <!-- /.contact-form__error -->
        @enderror
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <span class="contact-form__label--text">電話番号 ※</span>
            </div>
            <!-- /.contact-form__group-title -->
            <div class="contact-form__group-content-tel">
                <div class="contact-form__input--text">
                    <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                </div>
                <!-- /.contact-form__input--text -->
                <span>-</span>
                <div class="contact-form__input--text">
                    <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                </div>
                <!-- /.contact-form__input--text -->
                <span>-</span>
                <div class="contact-form__input--text">
                    <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                </div>
                <!-- /.contact-form__input--text -->
            </div>
            <!-- /.contact-form__group-content-tel -->
        </div>
        <!-- /.contact-form__group -->
        @if($errors->has('tel1'))
        <div class="contact-form__error">
            <p>{{ $errors->first('tel1') }}</p>
        </div>
        <!-- /.contact-form__error -->
        @elseif($errors->has('tel2'))
        <div class="contact-form__error">
            <p>{{ $errors->first('tel2') }}</p>
        </div>
        <!-- /.contact-form__error -->
        @elseif($errors->has('tel3'))
        <div class="contact-form__error">
            <p>{{ $errors->first('tel3') }}</p>
        </div>
        <!-- /.contact-form__error -->
        @endif
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <span class="contact-form__label--text">住所 ※</span>
            </div>
            <!-- /.contact-form__group-title -->
            <div class="contact-form__group-content">
                <div class="contact-form__input--text">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                </div>
                <!-- /.contact-form__input--text -->
            </div>
            <!-- /contact-form__group-content -->
        </div>
        <!-- /.contact-form__group -->
        @error('address')
        <div class="contact-form__error">
            <p>{{ $message }}</p>
        </div>
        <!-- /.contact-form__error -->
        @enderror
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <span class="contact-form__label--text">建物名</span>
            </div>
            <!-- /.contact-form__group-title -->
            <div class="contact-form__group-content">
                <div class="contact-form__input--text">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
                <!-- /.contact-form__input--text -->
            </div>
            <!-- /contact-form__group-content -->
        </div>
        <!-- /.contact-form__group -->
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <span class="contact-form__label--text">お問い合わせの種類 ※</span>
            </div>
            <!-- /.contact-form__group-title -->
            <div class="contact-form__group-content-select">
                <div class="contact-form__select">
                    <select name="category_id">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                        <option @if($category->id===(int)old('category_id')) selected @endif value="{{$category->id}}">{{$category->content}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- /.contact-form__select -->
            </div>
            <!-- /contact-form__group-content-select -->
        </div>
        <!-- /.contact-form__group -->
        @error('category_id')
        <div class="contact-form__error">
            <p>{{ $message }}</p>
        </div>
        <!-- /.contact-form__error -->
        @enderror
        <div class="contact-form__group">
            <div class="contact-form__group-title">
                <span class="contact-form__label--text">お問い合わせ内容 ※</span>
            </div>
            <!-- /.contact-form__group-title -->
            <div class="contact-form__group-content-textarea">
                <div class="contact-form__textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                </div>
                <!-- /.contact-form__textarea -->
            </div>
            <!-- /contact-form__group-content-textarea -->
        </div>
        <!-- /.contact-form__group -->
        @error('detail')
        <div class="contact-form__error">
            <p>{{ $message }}</p>
        </div>
        <!-- /.contact-form__error -->
        @enderror
        <div class="contact-form__group-button">
            <button class="contact-form__group-button-submit">確認画面</button>
        </div>
        <!-- /.contact-form__group-button -->
    </form>
</div>
<!-- /.contact__content -->
@endsection