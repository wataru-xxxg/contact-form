@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('button')
<form class="form" action="/logout" method="post">
    @csrf
    <button class="title_btn" type="submit">logout</button>
</form>
@endsection


@section('content')
<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <!-- /.admin__heading -->
    <form action="/admin" method="post" class="admin-form">
        @csrf
        <div class="admin-form__group">
            <div class="admin-form__input--text">
                <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">
            </div>
            <!-- /.admin-form__input--text -->
            <div class="admin-form__select">
                <select name="gender">
                    <option value="">性別</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
            </div>
            <!-- /.admin-form__select -->
            <div class="admin-form__select">
                <select name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->content}}</option>
                    @endforeach
                </select>
            </div>
            <!-- /.admin-form__select -->
            <div class="admin-form__select">
                <input type="date" name="date">
            </div>
            <!-- /.admin-form__select -->
            <div class="admin-form__button-search">
                <button class="admin-form__group-button-submit">検索</button>
            </div>
            <!-- /.admin-form__button-search -->
            <div class="admin-form__button-reset">
                <input type="reset" value="リセット">
            </div>
            <!-- /.admin-form__button-reset -->
        </div>
        <!-- /.admin-form__group -->
    </form>
    <div class="export-and-page__group">
        <div class="export-and-page__button-export">
            <form action="/export" method="get">
                @isset($search_parameters['gender'])
                <input type="hidden" name="gender" value="{{ $search_parameters['gender'] }}">
                @endisset
                @isset($search_parameters['category_id'])
                <input type="hidden" name="category_id" value="{{ $search_parameters['category_id'] }}">
                @endisset
                @isset($search_parameters['created_at'])
                <input type="hidden" name="created_at" value="{{ $search_parameters['created_at'] }}">
                @endisset
                @isset($search_parameters['keyword'])
                <input type="hidden" name="keyword" value="{{ $search_parameters['keyword'] }}">
                @endisset
                @empty($search_parameters)
                <input type="hidden" name="gender" value="">
                <input type="hidden" name="category_id" value="">
                <input type="hidden" name="created_at" value="">
                <input type="hidden" name="keyword" value="">
                @endempty
                <button class="export-and-page__group-button-submit">エクスポート</button>
            </form>
        </div>
        <!-- /.export-and-page__button-export -->
        <div class="export-and-page__page">
            {{ $contacts->links() }}
        </div>
        <!-- /.export-and-page__page -->
    </div>
    <!-- /.export-and-page__group -->
    <div class="admin-table__group">
        <table>
            <thead>
                <tr>
                    <th class="admmin-table__header">
                        <div class="admin-table__header-inner">
                            お名前
                        </div>
                        <!-- /.admin-table__header-inner -->
                    </th>
                    <th class="admmin-table__header">
                        <div class="admin-table__header-inner">
                            性別
                        </div>
                        <!-- /.admin-table__header-inner -->
                    </th>
                    <th class="admmin-table__header">
                        <div class="admin-table__header-inner">
                            メールアドレス
                        </div>
                        <!-- /.admin-table__header-inner -->
                    </th>
                    <th class="admmin-table__header">
                        <div class="admin-table__header-inner">
                            お問い合わせの種類
                        </div>
                        <!-- /.admin-table__header-inner -->
                    </th>
                    <th class="admmin-table__header">
                        <div class="admin-table__header-inner">
                        </div>
                        <!-- /.admin-table__header-inner -->
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td class="admmin-table__data">
                        <div class="admin-table__data-inner">
                            {{ $contact->last_name }}{{ $contact->first_name }}
                        </div>
                        <!-- /.admin-table__data-inner -->
                    </td>
                    <td class="admmin-table__data">
                        <div class="admin-table__data-inner">
                            @switch ($contact->gender)
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
                        <!-- /.admin-table__data-inner -->
                    </td>
                    <td class="admmin-table__data">
                        <div class="admin-table__data-inner">
                            {{ $contact->email }}
                        </div>
                        <!-- /.admin-table__data-inner -->
                    </td>
                    <td class="admmin-table__data">
                        <div class="admin-table__data-inner">
                            {{ $contact->category->getCategory() }}
                        </div>
                        <!-- /.admin-table__data-inner -->
                    </td>
                    <td class="admmin-table__data">
                        <div class="admin-table__data-inner">
                            <button class="button-modal js-modal-button">詳細</button>
                        </div>
                        <!-- /.admin-table__data-inner -->
                        <div class="layer js-modal">
                            <div class="modal">
                                <div class="modal__inner">
                                    <!-- ×ボタン追記 -->
                                    <div class="modal__button-wrap">
                                        <button class="close-button js-close-button">
                                            <span></span>
                                            <span></span>
                                        </button>
                                    </div>
                                    <div class="modal__contents">
                                        <div class="modal__content">
                                            <table class="detail-table">
                                                <tr class="detail-table__row">
                                                    <th class="detail-table__header">
                                                        <div class="detail-table__header-inner">
                                                            お名前
                                                        </div>
                                                        <!-- /.detail-table__header-inner -->
                                                    </th>
                                                    <td class="detail-table__item">
                                                        <div class="detail-table__input--text-name">
                                                            {{ $contact->last_name }}
                                                            <span>　</span>
                                                            {{ $contact->first_name }}
                                                        </div>
                                                        <!-- /.detail-table__input--text-name -->
                                                    </td>
                                                </tr>
                                                <tr class="detail-table__row">
                                                    <th class="detail-table__header">
                                                        <div class="detail-table__header-inner">
                                                            性別
                                                        </div>
                                                        <!-- /.detail-table__header-inner -->
                                                    </th>
                                                    <td class="detail-table__item">
                                                        <div class="detail-table__input--text">
                                                            <div class="detail-table__input--text-gender">
                                                                @switch ($contact->gender)
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
                                                            <!-- /.detail-table__input--text-gender -->
                                                        </div>
                                                        <!-- /.detail-table__input--text -->
                                                    </td>
                                                </tr>
                                                <tr class="detail-table__row">
                                                    <th class="detail-table__header">
                                                        <div class="detail-table__header-inner">
                                                            メールアドレス
                                                        </div>
                                                        <!-- /.detail-table__header-inner -->
                                                    </th>
                                                    <td class="detail-table__item">
                                                        <div class="detail-table__input--text">
                                                            {{ $contact->email }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="detail-table__row">
                                                    <th class="detail-table__header">
                                                        <div class="detail-table__header-inner">
                                                            電話番号
                                                        </div>
                                                        <!-- /.detail-table__header-inner -->
                                                    </th>
                                                    <td class="detail-table__item">
                                                        <div class="detail-table__input--text">
                                                            {{ $contact->tel }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="detail-table__row">
                                                    <th class="detail-table__header">
                                                        <div class="detail-table__header-inner">
                                                            住所
                                                        </div>
                                                        <!-- /.detail-table__header-inner -->
                                                    </th>
                                                    <td class="detail-table__item">
                                                        <div class="detail-table__input--text">
                                                            {{ $contact->address }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="detail-table__row">
                                                    <th class="detail-table__header">
                                                        <div class="detail-table__header-inner">
                                                            建物名
                                                        </div>
                                                        <!-- /.detail-table__header-inner -->
                                                    </th>
                                                    <td class="detail-table__item">
                                                        <div class="detail-table__input--text">
                                                            {{ $contact->building }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="detail-table__row">
                                                    <th class="detail-table__header">
                                                        <div class="detail-table__header-inner">
                                                            お問い合わせの種類
                                                        </div>
                                                        <!-- /.detail-table__header-inner -->
                                                    </th>
                                                    <td class="detail-table__item">
                                                        <div class="detail-table__input--text">
                                                            {{ $contact->category->getCategory() }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="detail-table__row">
                                                    <th class="detail-table__header">
                                                        <div class="detail-table__header-inner">
                                                            お問い合わせ内容
                                                        </div>
                                                        <!-- /.detail-table__header-inner -->
                                                    </th>
                                                    <td class="detail-table__item">
                                                        <div class="detail-table__input--text">
                                                            {{ $contact->detail }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <form action="/delete" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $contact->id }}">
                                                <div class="detail-form">
                                                    <button class="detail-form__button">削除</button>
                                                </div>
                                                <!-- /.detail-form -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.layer js-modal -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.admin-table__group -->
</div>
<!-- /.admin__content -->
<script src="{{ asset('/js/main.js') }}"></script>
@endsection