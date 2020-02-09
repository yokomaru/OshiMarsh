<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    public function index(Request $request)
    {
        //ツイートを5件取得
        //$result = \Twitter::get('statuses/home_timeline', array("count" => 5));
        // キーワードによるツイート検索
        //$tweets_params = ['q' => '夜景,きれい OR キレイ OR 綺麗' ,'count' => '10'];
        //$tweets = $connection->get('search/tweets', $tweets_params)->statuses;

        $tweets_params = ['q' => '目黒蓮 OR #目黒蓮 OR 目黒くん' ,'count' => '30'];
        $result = \Twitter::get('search/tweets', $tweets_params)->statuses;
        //ViewのTwitter.blade.phpに渡す
        //ViewのTwitter.blade.phpに渡す
        //dd($result);
        return view('twitter', [
            "result" => $result
        ]);
    }
}