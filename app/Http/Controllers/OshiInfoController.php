<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Oshi_info;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;

class OshiInfoController extends Controller
{
    public function index()
    {
        $oshi_infos = Oshi_info::where('status', 1)->where('user_id', \Auth::id())->orderBy('created_at', 'DESC')->paginate(5);
        //dd(count($oshi_infos));
        return view('index', compact('oshi_infos'));
    }
    
    public function show($id)
    {
        $oshi_infos = Oshi_info::where('id', $id)->where('status', 1)->first();
        $tweets_params = ['q' =>$oshi_infos->name . ' OR '.  '#' .  $oshi_infos->name ,'count' => '20'];
        $result = \Twitter::get('search/tweets', $tweets_params)->statuses;
        //ViewのTwitter.blade.phpに渡す
        //ViewのTwitter.blade.phpに渡す
        //dd($result);
        //return view('twitter', [
        //    "result" => $result
        //]);
        return view('oshi_show', compact('oshi_infos','result'));
    }
    
    public function create()
    {
        return view('oshi_register');
    }
    
    // タスク削除
    public function delete(Request $request, Oshi_info $oshi_info) {
        $oshi_info = new Oshi_info;
        $oshi_info = Oshi_info::where('id',$request->id)->first();
        //dd($oshi_info);
        $oshi_info->status = 2;
        $oshi_info->save();
        return redirect('/')->with('flash_message', '削除が完了しました');
    }
    
    // 一覧⇒編集画面への画面遷移
    public function edit($id) {
        $oshi_infos = Oshi_info::where('id', $id)->where('status', 1)->first();
        return view('oshi_edit', compact('oshi_infos'));
    }
    
    // タスク更新処理
    public function update(Request $request) {
        
        $post = $request->all();

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'belongteam' => 'max:255',
            'birthday' => 'date',
            'startrecomendat' => 'date',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $oshi_info = new Oshi_info;
        $oshi_info = Oshi_info::where('id',$post['id'])->first();
        $oshi_info->name =$post['name'];
        $oshi_info->belong_team = $post['belongteam'];
        $oshi_info->sex = $post['sex'];
        $oshi_info->birthday = $post['birthday'];
        $oshi_info->start_recomend_at = $post['startrecomendat'];
        $oshi_info->color = $post['color'];
        if ($request->hasFile('image')) {
            $request->file('image')->store('/public/images');
            $oshi_info->image = $request->file('image')->hashName(); 
        }
        $oshi_info->save();
        
        return redirect('/')->with('flash_message', '編集が完了しました');
    }
    
    public function store(Request $request)
    {
        $post = $request->all();
        //dd($request->all());
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'belongteam' => 'max:255',
            'birthday' => 'date',
            'startrecomendat' => 'date',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            $request->file('image')->store('/public/images');
            $data = ['user_id' => \Auth::id(), 
                    'name' => $post['name'], 
                    'belong_team' => $post['belongteam'],
                    'sex' => $post['sex'],
                    'birthday' => $post['birthday'],
                    'start_recomend_at' => $post['startrecomendat'],
                    'color' => $post['color'],
                    'image' => $request->file('image')->hashName(),
                    'status' => 1,
                    ];  
        }
        else {
            $data = ['user_id' => \Auth::id(), 
                    'name' => $post['name'], 
                    'belong_team' => $post['belongteam'],
                    'sex' => $post['sex'],
                    'birthday' => $post['birthday'],
                    'start_recomend_at' => $post['startrecomendat'],
                    'color' => $post['color'],
                    'status' => 1,
                    ];          
        }
        
        Oshi_info::insert($data);

        return redirect('/')->with('flash_message', '推し登録が完了しました');
        //return view('oshi_register');
    }
}
