<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Illuminate\Pagination\Paginator;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 連想配列の取得
     *
     * @param [type] $id
     * @return void
     */
    protected function getData($id){
        // 連想配列
        return [
            'item' => Item::find($id),
            'genres' => Item::getGenreName(),
            'media' => Item::getMediumName(),
            'reading_statuses' => Item::getReadingStatus()
        ];
    }

    /**
     * 書籍一覧
     */
    public function index(Request $request)
    {
        $query = Item::query();
        $keyword = $request->keyword;
        $genreKey = $request->genre;

        // 検索機能
        if(isset($keyword)){
            $query->where('title', "LIKE", '%' . $keyword . '%');
        }
        if(isset($genreKey)){
            $query->where('genre', $genreKey);
        }

        // ページネーションし取得
        $items = $query->paginate(10)->withQueryString();
        $genres = Item::getGenreName();
        $media = Item::getMediumName();

        return view('item.index', compact('items', 'genres', 'media', 'genreKey'));
    }


    /**
     * 書籍登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'title' => 'required|max:100',
                'author' => 'max:100',
                'genre' => 'required',
                'detail' => 'max:500',
            ], [
                'title.required' => 'タイトルの入力は必須です。',
                'genre.required' => 'ジャンルの選択は必須です。',
                'title.max' => 'タイトルの入力文字数は最大100文字までです。',
                'author.max' => 'タイトルの入力文字数は最大100文字までです。',
                'detail.max' => '詳細欄の入力文字数は最大500文字までです。'
            ]);

            $request->flash();

            // 書籍登録
            Item::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'medium' => $request->medium,
                'reading_status' => $request->reading_status,
                'detail' => $request->detail,
            ]);

            session()->flash('flash_message', '書籍情報を1件登録が完了しました');

            return redirect()->route('home');
        }

        $genres = Item::getGenreName();
        $media = Item::getMediumName();
        $reading_statuses = Item::getReadingStatus();

        return view('item.add', compact('genres', 'media', 'reading_statuses'));
    }


    /**
     * 書籍詳細画面の表示
     *
     * @param [type] $id
     * @return void
     */
    public function detail($id)
    {
        $data = $this->getData($id);
        return view('item.detail', $data);
    }


    // 編集画面の表示
    public function edit($id)
    {
        $data = $this->getData($id);
        return view('item.edit', $data);
    }


    /**
     * 書籍情報の編集
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // バリデーション
            $this->validate($request, [
                'title' => 'required|max:100',
                'author' => 'max:100',
                'genre' => 'required',
                'detail' => 'max:500',
            ], [
                'title.required' => 'タイトルの入力は必須です。',
                'genre.required' => 'ジャンルの選択は必須です。',
                'title.max' => 'タイトルの入力文字数は最大100文字までです。',
                'author.max' => 'タイトルの入力文字数は最大100文字までです。',
                'detail.max' => '詳細欄の入力文字数は最大500文字までです。'
            ]);

        $request->flash();

        // 指定のIDのレコード1件を取得
        $item = Item::find($id);

        // 登録情報を編集・更新
        $item->title = $request->title;
        $item->author = $request->author;
        $item->genre = $request->genre;
        $item->medium = $request->medium;
        $item->reading_status = $request->reading_status;
        $item->detail = $request->detail;

        // 変更があるかどうかを確認
        if ($item->isDirty()) {

            // 変更がある場合のみ保存
            $item->save();

            // フラッシュメッセージを設定
            session()->flash('flash_message', '書籍情報を更新しました');
        }
        return redirect('/items/detail/' . $id);
    }


    /**
     * 書籍情報の削除
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        // 指定のIDのレコード1件を取得
        $item = Item::find($id);
        $item->delete();

        // フラッシュメッセージ設定
        session()->flash('flash_message', '書籍情報を1件削除しました。');

        return redirect()->route('home');
    }

}
