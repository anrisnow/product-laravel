@extends('adminlte::page')

@section('title', '書籍詳細')

@section('content_header')
<h1>書籍詳細</h1>
@stop

@section('content')
<div class="mx-auto col-12 col-lg-8">
    <table class="table table-bordered table-product">
        <tbody>
            <tr>
                <th scope="row" class="table-info col-3 text-center">No.</th>
                <td>{{ $item->id }}</td>
            </tr>
            <tr>
                <th scope="row" class="table-info text-center">タイトル</th>
                <td>{{ $item->title }}</td>
            </tr>
            <tr>
                <th scope="row" class="table-info text-center">著者</th>
                <td>{{ $item->author }}</td>
            </tr>
            <tr>
                <th scope="row" class="table-info text-center">ジャンル</th>
                <td>{{ $genres[$item->genre] }}</td>
            </tr>
            <tr>
                <th scope="row" class="table-info text-center">媒体</th>
                <td>{{ $media[$item->medium] }}</td>
            </tr>
            <tr>
                <th scope="row" class="table-info text-center">読破状況</th>
                <td>{{ $reading_statuses[$item->reading_status] }}</td>
            </tr>
            <tr>
                <th scope="row" class="table-info text-center">詳細</th>
                <td>{!! nl2br(htmlspecialchars($item->detail)) !!}</td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex mb-3">
        <a href="{{ route('item.edit', $item->id) }}"><button class="btn btn-primary">書籍の編集</button></a>

        <form method="POST" action="{{ route('item.destroy', $item->id) }}" class="ml-2">
        @csrf
            <button class="btn btn-danger">書籍の削除</button>
        </form>
    </div>
    <p>
        <a class="link-dark link-opacity-50-hover link-underline-opacity-50-hover" href="{{ route('home') }}">
            書籍一覧に戻る
        </a>
    </p>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
