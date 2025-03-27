@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <!-- /.confirm__heading -->
    <form action="/thanks" method="post" class="confirm-form">
        @csrf
        <table class="confirm-table">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    <div class="confrim-table__header-inner">
                        お名前
                    </div>
                    <!-- /.confrim-table__header-inner -->
                </th>
                <td class="confirm-table__item">
                    <div class="confirm-table__input--text-name">
                        <input type="text" name="last_name" value="{{ $form['last_name'] }}">
                        <span>　</span>
                        <input type="text" name="first_name" value="{{ $form['first_name'] }}">
                    </div>
                    <!-- /.confirm-table__input--text-name -->
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    <div class="confrim-table__header-inner">
                        性別
                    </div>
                    <!-- /.confrim-table__header-inner -->
                </th>
                <td class="confirm-table__item">
                    <div class="confirm-table__input--text">
                        <input type="hidden" name="gender" value="{{ $form['gender'] }}">
                        <div class="confirm-table__input--text-gender">
                            @switch ($form['gender'])
                            @case (1)
                            男性
                            @break
                            @case (2)
                            女性
                            @break
                            @case (3)
                            その他
                            @break
                            @endswitch
                        </div>
                        <!-- /.confirm-table__input--text-gender -->
                    </div>
                    <!-- /.confirm-table__input--text -->
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    <div class="confrim-table__header-inner">
                        メールアドレス
                    </div>
                    <!-- /.confrim-table__header-inner -->
                </th>
                <td class="confirm-table__item">
                    <div class="confirm-table__input--text">
                        <input type="text" name="email" value="{{ $form['email'] }}">
                    </div>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    <div class="confrim-table__header-inner">
                        電話番号
                    </div>
                    <!-- /.confrim-table__header-inner -->
                </th>
                <td class="confirm-table__item">
                    <div class="confirm-table__input--text">
                        <input type="text" name="tel" value="{{ $form['tel1'] }}{{ $form['tel2'] }}{{ $form['tel3'] }}">
                        <input type="hidden" name="tel1" value="{{ $form['tel1'] }}">
                        <input type="hidden" name="tel2" value="{{ $form['tel2'] }}">
                        <input type="hidden" name="tel3" value="{{ $form['tel3'] }}">
                    </div>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    <div class="confrim-table__header-inner">
                        住所
                    </div>
                    <!-- /.confrim-table__header-inner -->
                </th>
                <td class="confirm-table__item">
                    <div class="confirm-table__input--text">
                        <input type="text" name="address" value="{{ $form['address'] }}">
                    </div>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    <div class="confrim-table__header-inner">
                        建物名
                    </div>
                    <!-- /.confrim-table__header-inner -->
                </th>
                <td class="confirm-table__item">
                    <div class="confirm-table__input--text">
                        <input type="text" name="building" value="{{ $form['building'] }}">
                    </div>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    <div class="confrim-table__header-inner">
                        お問い合わせの種類
                    </div>
                    <!-- /.confrim-table__header-inner -->
                </th>
                <td class="confirm-table__item">
                    <div class="confirm-table__input--text">
                        <input type="hidden" name="category_id" value="{{ $form['category_id'] }}">
                        <div class="confirm-table__input--text-category">{{ $form['category']['content'] }}</div>
                    </div>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">
                    <div class="confrim-table__header-inner">
                        お問い合わせ内容
                    </div>
                    <!-- /.confrim-table__header-inner -->
                </th>
                <td class="confirm-table__item">
                    <div class="confirm-table__input--text">
                        <input type="text" name="detail" value="{{ $form['detail'] }}">
                    </div>
                </td>
            </tr>
        </table>
        <div class="confirm-form__group-button">
            <button type="submit" name='submit' value="submit" class="confirm-form__group-button-submit">送信</button>
            <button type="submit" name='back' value="back" class="confirm-form__group-button-back">修正</button>
        </div>
        <!-- /.confirm-form__group-button -->
    </form>
</div>
<!-- /.confirm__content -->
@endsection