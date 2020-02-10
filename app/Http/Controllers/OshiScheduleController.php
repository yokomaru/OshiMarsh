<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oshi_schedule;
use App\Oshi_info;
use App\Calendar;

class OshiScheduleController extends Controller
{
    public function getSchedule(Request $request)
    {
        // スケジュールデータ取得
        $list = Oshi_schedule::where('oshi_schedules.status', 1)->where('oshi_schedules.user_id', \Auth::id())->leftJoin('oshi_infos', 'oshi_infos.id', '=', 'oshi_schedules.oshi_id')->select('oshi_infos.name', 'oshi_schedules.id','oshi_schedules.day','oshi_schedules.oshi_id','oshi_schedules.user_id','oshi_schedules.memo','oshi_schedules.start_time_at','oshi_schedules.end_time_at','oshi_schedules.title')->orderBy('oshi_schedules.day', 'ASC')->orderBy('oshi_schedules.start_time_at', 'ASC') -> get();
        //dd($list);
        return view('oshi_schedule_index', ['list' => $list]);        
    }
    
    public function index(Request $request)
    {
        //$list = Oshi_schedule::all();
        $list = Oshi_schedule::where('oshi_schedules.status', 1)->where('oshi_schedules.user_id', \Auth::id())->leftJoin('oshi_infos', 'oshi_infos.id', '=', 'oshi_schedules.oshi_id')->select('oshi_infos.name', 'oshi_schedules.id','oshi_schedules.day','oshi_schedules.oshi_id','oshi_schedules.user_id','oshi_schedules.memo','oshi_schedules.start_time_at','oshi_schedules.end_time_at','oshi_schedules.title')->orderBy('oshi_schedules.day', 'ASC')->orderBy('oshi_schedules.start_time_at', 'ASC') -> get();
        //dd($list);
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month,$request->year);
        return view('oshi_schedule_index', ['cal_tag' => $tag]);
    }
    
    public function updateSchedule(Request $request)
    {
       $post = $request->all();
        $validatedData = $request->validate([
            'oshiid' => 'required',
            'birthday' => 'required\date',
        ]);
 
        $oshi_schedule = new Oshi_schedule(); 
        $oshi_schedule = Oshi_schedule::where('id',$post['id'])->first();
        //dd();
        $oshi_schedule->day = $request->day;
        $oshi_schedule->oshi_id = $request->oshiid; 
        $oshi_schedule->user_id = \Auth::id();
        $oshi_schedule->memo = $request->memo;
        $oshi_schedule->start_time_at = $request->starttimeat;    
        $oshi_schedule->end_time_at = $request->endtimeat;    
        $oshi_schedule->title = $request->title; 
        $oshi_schedule->status = 1; 
        $oshi_schedule->save();
        
        return redirect('/schedule')->with('flash_message', '編集が完了しました');
    }

    // タスク削除
    public function delete($id) {
        $oshi_schedule = new Oshi_schedule;
        $oshi_schedule = Oshi_schedule::where('id',$id)->first();
        //dd($oshi_schedule);
        $oshi_schedule->status = 2;
        $oshi_schedule->save();
        return redirect('/schedule')->with('flash_message', '削除が完了しました');
    }

    public function postSchedule(Request $request)
    {

        $validatedData = $request->validate([
            'oshiid' => 'required',
            'birthday' => 'required\date',
        ]);
        
        // POSTで受信したスケジュールデータの登録
        $oshi_schedule = new Oshi_schedule(); 
        $oshi_schedule->day = $request->day;
        $oshi_schedule->oshi_id = $request->oshiid; 
        $oshi_schedule->user_id = \Auth::id();
        $oshi_schedule->memo = $request->memo;
        $oshi_schedule->start_time_at = $request->starttimeat;    
        $oshi_schedule->end_time_at = $request->endtimeat;    
        $oshi_schedule->title = $request->title; 
        $oshi_schedule->status = 1; 
        $oshi_schedule->save();
        // スケジュールデータ取得
        //$list = Oshi_schedule::all();
        $list = Oshi_schedule::where('oshi_schedules.status', 1)->where('oshi_schedules.user_id', \Auth::id())->leftJoin('oshi_infos', 'oshi_infos.id', '=', 'oshi_schedules.oshi_id')->select('oshi_infos.name', 'oshi_schedules.id','oshi_schedules.day','oshi_schedules.oshi_id','oshi_schedules.user_id','oshi_schedules.memo','oshi_schedules.start_time_at','oshi_schedules.end_time_at','oshi_schedules.title')->orderBy('oshi_schedules.day', 'ASC')->orderBy('oshi_schedules.start_time_at', 'ASC') -> get();
        
        $cal = new Calendar($list);
        //dd($list);
        $tag = $cal->showCalendarTag($request->month,$request->year);
        return redirect('/schedule')->with('flash_message', '登録が完了しました');
    }
}
