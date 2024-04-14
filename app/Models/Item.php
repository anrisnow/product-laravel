<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'items';
    protected $fillable = [
        'user_id',
        'title',
        'author',
        'genre',
        'medium',
        'reading_status',
        'detail',
    ];

    public $timestamps = false;

    /**
     * ジャンル名を取得
     *
     */
    public static function getGenreName()
    {
        return [
            '1' => 'ミステリー',
            '2' => 'ファンタジー',
            '3' => '歴史',
            '4' => '恋愛',
            '5' => '自己啓発・ビジネス書',
            '6' => 'エッセイ',
            '7' => 'その他'
        ];
    }

        /**
     * 媒体を取得
     *
     */
    public static function getMediumName()
    {
        return [
            '1' => '紙',
            '2' => '電子書籍',
        ];
    }

        /**
     * 読破状況を取得
     *
     */
    public static function getReadingStatus()
    {
        return [
            '1' => '未読',
            '2' => '読書中',
            '3' => '読了',
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
