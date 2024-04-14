@extends('adminlte::page')

@section('title', '書籍一覧')

@section('content_header')
    <h1>書籍一覧</h1>
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

    <!-- 検索機能 -->
    <form action="{{ route('home') }}" method="GET" class="mb-2">

        <!-- タイトル検索 -->
        <div class="d-flex align-items-center col-12 col-lg-5 mb-2">
            <label for="title" class="form-label mb-0 col-3">タイトル：</label>
            <input class="form-control" id="title" name="keyword" value="{{ request()->input('keyword') }}" type="search" aria-label="Search">
        </div>

        <!-- ジャンルプルダウン -->
        <div class="d-flex align-items-center col-12 col-lg-5 mb-2">
            <label for="genre" class="form-label mb-0 col-3">ジャンル：</label>
            <select class="custom-select" id="genre" name="genre" aria-label="Default select example">
                <option></option>
                @foreach($genres as $key => $genre)
                <option value="{{ $key }}" {{ $genreKey == $key ? 'selected' : '' }}>{{ $genre }}</option>
                @endforeach
            </select>
        </div>

        <!-- 検索・クリアボタン -->
        <div class="d-flex">
            <button class="btn btn-outline-success mr-2" type="submit">検索</button>
            <a class="btn btn-outline-info" href="/">クリア</a>
            <!-- <button class="btn btn-outline-info" type="submit" onclick="clearSearch()">クリア</button> -->
        </div>

    </form>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">書籍一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">書籍登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>タイトル</th>
                                <th>著者</th>
                                <th>ジャンル</th>
                                <th>媒体</th>
                                <th>詳細</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ Str::limit($item->title, 35) }}</td>
                                    <td>{{ Str::limit($item->author, 20) }}</td>
                                    <td>{{ $genres[$item->genre] }}</td>
                                    <td>{{ $media[$item->medium] }}</td>
                                    <td><a href="{{ route('item.detail', $item->id) }}" class="btn btn-primary">詳細</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $items->links('pagination::bootstrap-4') }}

@stop

@section('css')
<style>
    tbody{
        font-size:0.9rem;
    }
</style>
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

    function clearSearch() {
        var titleName = document.getElementById('title');
        var genreName = document.getElementById('genre');
        titletName.value = '';
        genreName.value = '';
    }

</script>
@stop
