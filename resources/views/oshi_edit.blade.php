@extends('layouts.app')

@section('content')
<h1 class='pagetitle'>推し投稿ページ</h1>

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
    <div class="col-md-10">
      <form method='POST' action="{{ url('update/'.$oshi_infos->id) }}"  enctype="multipart/form-data">  
      @csrf
        <div class="card">
            <div class="card-body">
            	
              <div class="form-group">
                <label for="file1">推しのサムネイル画像</label>
                <input type="file" name='image' id="image" class="form-control-file" src="{{ asset('storage/images/'.$oshi_infos->image) }}">
              </div>

              <div class="form-group">
                <label>名前</label>
                <input type='text' class='form-control' name='name' placeholder='推しの名前を入力' value="{{ $oshi_infos->name }}">
              </div>

              <div class="form-group">
                <label>所属チーム</label>
                <input type='text' class='form-control' name='belongteam' placeholder='所属チームを入力' value="{{ $oshi_infos->belong_team }}">
              </div>

              <div class="form-group" >
                <label>性別</label><br> 
    						<input name="sex" type="radio" value="0" {{ $oshi_infos->sex == 0 ? 'checked' : '' }}> <label for="men">男</label>
    						<input name="sex" type="radio" value="1" {{ $oshi_infos->sex== 1 ? 'checked' : '' }}> <label for="women">女</label>
    						<input name="sex" type="radio" value="2" {{ $oshi_infos->sex== 2 ? 'checked' : '' }}> <label for="else" >その他</label>
    			    </div>

              <div class="form-group">
                <label>誕生日</label>
                <input name="birthday" type="date" class="form-control" value="{{ $oshi_infos->birthday }}">
              </div>
              
              <div class="form-group">
                <label>沼に落ちた日(推し始めた日)</label>
                <input name="startrecomendat" type="date" class="form-control" value="{{ $oshi_infos->start_recomend_at }}">
              </div>

              <div class="form-group">
                <label>担当カラー</label>
        				<select class='form-control' name="color">
          				<option value="">選択してください</option>
          				<option value="red" {{ $oshi_infos->color == 'red' ? 'selected' : '' }}>赤</option>
          				<option value="pink" {{ $oshi_infos->color == 'pink' ? 'selected' : '' }}>ピンク</option>
          				<option value="purple"{{ $oshi_infos->color == 'purple' ? 'selected' : '' }}>紫</option>
          				<option value="blue" {{ $oshi_infos->color == 'blue' ? 'selected' : '' }}>青</option>
          				<option value="green" {{ $oshi_infos->color == 'green' ? 'selected' : '' }}>緑</option>
          				<option value="yellow" {{ $oshi_infos->color == 'yellow' ? 'selected' : '' }}>黄色</option>
          				<option value="black" {{ $oshi_infos->color == 'black' ? 'selected' : '' }}>黒</option>
          				<option value="white" {{ $oshi_infos->color == 'white' ? 'selected' : '' }}>白</option>
        				</select>
              </div>
              <input type="hidden"  name='id' id="id" value={{ $oshi_infos->id }}>
              <input type='submit' class='btn btn-primary' value='推しを登録'>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection