@extends('adminlte::page')

@section('title', '書籍の編集')

@section('content_header')
<h1>書籍の編集</h1>
@stop

@section('content')
<!-- フラッシュメッセージの表示-->
<div>
    @if(session('flash_message'))
    <div class="alert alert-success">
        {{ session('flash_message') }}
    </div>
    @endif
</div>

<!-- エラーメッセージ表示 -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <form method="POST" action="{{ route('item.update', $item->id) }}">
        @csrf
        <div class="card-body">
            <div class="card-body">

                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $item->title) }}">
                </div>

                <div class="form-group">
                    <label for="author">著者</label>
                    <input id="author" type="text" class="form-control" name="author" value="{{ old('author', $item->author ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="genre">ジャンル</label>
                    <select id="genre" name="genre" class="form-control">
                        @foreach($genres as $key => $genre)
                            <option value="{{ $key }}" {{ $item->genre == $key ? 'selected' : '' }}>{{ $genre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="medium">媒体</label>
                    <select id="medium" name="medium" class="form-control">
                        @foreach($media as $key => $medium)
                            <option value="{{ $key }}" {{ $item->medium == $key ? 'selected' : '' }}>{{ $medium }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="reading_status">読破状況</label>
                    <select id="reading_status" name="reading_status" class="form-control">
                        @foreach($reading_statuses as $key => $reading_status)
                            <option value="{{ $key }}" {{ $item->reading_status == $key ? 'selected' : '' }}>{{ $reading_status }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="detail">詳細</label>
                    <textarea class="form-control" id="detail" name="detail" row="5">{{ old('detail', $item->detail ?? '') }}</textarea>
                </div>

                <!-- 編集ボタン -->
                <div class="form-group row mb-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary bt">編集</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<p>
    <a class="link-dark link-opacity-50-hover link-underline-opacity-50-hover" href="{{ route('home') }}">
        書籍一覧に戻る
    </a>
</p>

@stop

@section('css')
@stop

@section('js')
<script>
    setTimeout(function() {
    $(".alert-success,.alert-error")
        .fadeOut(3000)
        .queue(function() {
            this.remove();
        });
    }, 1000);
</script>
@stop
