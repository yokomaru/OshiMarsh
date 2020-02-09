@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row justify-content-center container">
    <div class="col-md-12">
        <div class="card">
            {!!$cal_tag!!}
        </div>  
        
        <!-- 2.モーダルの配置 -->
        <div class="modal" id="modal-example" class="modal-dialog modal-dialog-centered"  tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">予定の登録</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              
              <div class="modal-body">
                <form method='POST' class='mordal-form' enctype="multipart/form-data">  
                @csrf
                  <div class="card">
                      <div class="card-body">
                        
                        <div class="form-group">
                          <label>スケジュールタイトル</label>
                          <input type='text' class='modal-title form-control' name='title' placeholder='スケジュールタイトルを入力' >
                        </div>

                        <div class="form-group">
                          <label>スケジュールメモ</label>
                          <input type='text' class='form-control modal-memo' name='memo' placeholder='スケジュールメモを入力'>
                        </div>

                        <div class="form-group">
                          <label>推しID</label>
                          {{ Form::select('oshiid', \App\Oshi_info::select('id', 'name')->get()->pluck('name','id')->prepend( "選択してください", ""), null, ['class' => 'form-control']) }}
                        </div>
          
                        <div class="form-group">
                          <label>日付</label>
                          <input type='date' name="day"  class="form-control modal-day">
                        </div>
                        
                        <div class="form-group">
                          <label>開始時間</label>
                          <input type='time' name="starttimeat" class="form-control modal-starttimeat">
                        </div>
                        
                        <div class="form-group">
                          <label>終了時間</label>
                          <input type='time' name="endtimeat" class="form-control modal-endtimeat">
                        </div>
                      </div>
                  </div>
                <input type="hidden"  name='year' id="year"  class="modal-year" >
                <input type="hidden"  name='month' id="month"  class="modal-month" >
                <input type="hidden" name='id' id="id" class="form-control modal-id" >
                <input type='submit' id='schedule_submit' class='btn btn-primary' value='登録'>
                <a class="btn btn-danger form-control" id='schedule_delete' value = '削除'><i class="fa fa-trash"></i></a>
                </form>

              </div
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div>
        
    </div>
</div>
@endsection