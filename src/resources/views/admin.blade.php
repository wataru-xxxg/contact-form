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
                <input type="date" name="date" value="">
            </div>
            <!-- /.admin-form__select -->
            <div class="admin-form__button-search">
                <button class="admin-form__group-button-submit">検索</button>
            </div>
            <!-- /.admin-form__button-search -->
            <div class="admin-form__button-reset">
                <button class="admin-form__group-button-submit">リセット</button>
            </div>
            <!-- /.admin-form__button-reset -->
        </div>
        <!-- /.admin-form__group -->
    </form>
    <div class="export-and-page__group">
        <div class="export-and-page__button-export">
            <button class="export-and-page__group-button-submit">エクスポート</button>
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
                            詳細
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
                            <button class="detail-button">詳細</button>
                        </div>
                        <!-- /.admin-table__data-inner -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.admin-table__group -->
</div>
<!-- /.admin__content -->
@endsection