@extends('adminlte::page')

@section('title', '書籍登録')

@section('content_header')
    <h1>書籍登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="タイトル">
                        </div>

                        <div class="form-group">
                            <label for="author">著者</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" placeholder="著者">
                        </div>

                        <div class="form-group">
                            <label for="genre">ジャンル</label>
                            <select id="genre" name="genre" class="form-control">
                                @foreach($genres as $key => $genre)
                                <option value="{{ $key }}">{{ $genre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="medium">媒体</label>
                            <select id="medium" name="medium" class="form-control">
                                @foreach($media as $key => $medium)
                                <option value="{{ $key }}">{{ $medium }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="reading_status">読破状況</label>
                            <select id="reading_status" name="reading_status" class="form-control">
                                @foreach($reading_statuses as $key => $reading_status)
                                <option value="{{ $key }}">{{ $reading_status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" row="5" value="{{ old('detail') }}" placeholder="詳細説明"></textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
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
@stop
