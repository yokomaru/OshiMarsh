<?php

namespace App;
use Carbon\Carbon;

class Calendar
{
    private $html;    
    private $schedule; 
    
    function __construct($schedule) {
        $this->schedules = $schedule;
    }
    
    public function showCalendarTag($m, $y)
    {
        $year = $y;
        $month = $m;
        if ($year == null) {
            // システム日付を取得する。 
            $year = date("Y");
            $month = date("m");
        }
        // 前月
        $prev = strtotime('-1 month',mktime(0, 0, 0, $month, 1, $year));
        $prev_year = date("Y",$prev);
        $prev_month = date("m",$prev);
        // 翌月
        $next = strtotime('+1 month',mktime(0, 0, 0, $month, 1, $year));
        $next_year = date("Y",$next);
        $next_month = date("m",$next);
        
        $firstWeekDay = date("w", mktime(0, 0, 0, $month, 1, $year)); // 1日の曜日(0:日曜日、6:土曜日)
        $lastDay = date("t", mktime(0, 0, 0, $month, 1, $year)); // 指定した月の最終日
        // 日曜日からカレンダーを表示するため前月の余った日付をループの初期値にする
        $day = 1 - $firstWeekDay;
        $this->html = <<< EOS
            <h1>
                <a class="btn btn-primary btn-secondary" href="/schedule/?year={$prev_year}&month={$prev_month}" role="button">&lt;前月</a>
                {$year}年{$month}月
                <a class="btn btn-primary btn-secondary" href="/schedule/?year={$next_year}&month={$next_month}" role="button">翌月&gt;</a>
            </h1>
            <table class="table table-bordered ">
            <tr>
              <th style="width:12%" scope="col">日</th>
              <th style="width:12%" scope="col">月</th>
              <th style="width:12%" scope="col">火</th>
              <th style="width:12%" scope="col">水</th>
              <th style="width:12%" scope="col">木</th>
              <th style="width:12%" scope="col">金</th>
              <th style="width:12%" scope="col">土</th>
            </tr>
            EOS;
        // カレンダーの日付部分を生成する
        while ($day <= $lastDay) {
            $this->html .= "<tr>";
            // 各週を描画するHTMLソースを生成する
            for ($i = 0; $i < 7; $i++) {
                if ($day <= 0 || $day > $lastDay) {
                    // 先月・来月の日付の場合
                    $this->html .= "<td>&nbsp;</td>";
                } else {
                   $this->html .= "<td>" . $day ."&nbsp"; 
                   //$daydd = date("d",$day);
                   $daydd = str_pad($day, 2, 0, STR_PAD_LEFT); // 01
                   $this->html .= "<a data-toggle='modal' data-target='#modal-example' data-whatever='{$year}-{$month}-{$daydd}'><i class='far fa-plus-square'></i></a>";
                   $this->html .= "<input type='hidden' value =>";
                   $target = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year)); 
                   foreach($this->schedules as $val) {
                       //dd($val);
                       if ($val->day == $target) {
                           $start_time_at = ( $val->start_time_at == null ) ? '' :Carbon::parse($val->start_time_at)->format('H:i'); 
                           $end_time_at = ( $val->end_time_at == null ) ? '' :Carbon::parse($val->end_time_at)->format('H:i'); 
                           $this->html .= "<br><a data-toggle='modal' data-target='#modal-example' data-whatever='{$val}'>";
                            if ($start_time_at === '' && $end_time_at === '') {
                                $this->html .= "<span>{$start_time_at}{$end_time_at}</span> {$val->title} ({$val->name})</a>";  
                            }
                            else{
                                $this->html .= "<span>{$val->name} : {$start_time_at}  ～ {$end_time_at}</span> {$val->title}  ({$val->name})</a>";  
                            }
                       }
                   }
                   $this->html .= "</td>"; 
                }
               $day++;
            }
            $this->html .= "</tr>";
        }

        return $this->html .= '</table>';
    }
}