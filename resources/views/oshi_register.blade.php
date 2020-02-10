@extends('layouts.app')

@section('content')
<h1 class=''>推し投稿ページ</h1>

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
      <form method='POST' action="{{ url('/oshi_register/store') }}" enctype="multipart/form-data">  
      @csrf
        <div class="card">
            <div class="card-body">
            	
            <!--<label for="file_photo" class="rounded-circle userProfileImg">
              <div class="userProfileImg_description">画像をアップロード</div>
              <i class="fas fa-camera fa-3x"></i>
              <input type="file" id="file_photo" name="image">
      
            </label>
            <div class="userImgPreview" id="userImgPreview">
              <img id="thumbnail" class="userImgPreview_content" accept="image/*" src="">
            </div>-->
              <div class="form-group">
                <label for="file1">推しのサムネイル画像</label>
                <input type="file"  name='image' id="file1" class="form-control-file"  value="{{old('image')}}">
              </div>

              <div class="form-group">
                <label>名前</label>
                <input type='text' class='form-control' name='name' placeholder='推しの名前を入力' value="{{old('name')}}">
              </div>

              <div class="form-group">
                <label>所属チーム</label>
                <input type='text' class='form-control' name='belongteam' placeholder='所属チームを入力' value="{{old('belongteam')}}">
              </div>

              <div class="form-group" >
                <label>性別</label><br> 
    						<input name="sex" type="radio" value="0" @if(old('sex')=='0') checked  @endif> <label for="men">男</label>
    						<input name="sex" type="radio" value="1" @if(old('sex')=='1') checked  @endif> <label for="women">女</label>
    						<input name="sex" type="radio" value="2" @if(old('sex')=='2') checked  @endif> <label for="else" >その他</label>
			        </div>

              <div class="form-group">
                <label>誕生日</label>
                <input name="birthday" type="date" class='form-control' value="{{old('birthday')}}">
              </div>
              
              <div class="form-group">
                <label>沼に落ちた日(推し始めた日)</label>
                <input name="startrecomendat" type="date" class='form-control' value="{{old('startrecomendat')}}">
              </div>

              <div class="form-group">
                <label>担当カラー</label>
        				<select class='form-control' name="color">
          				<option value="" @if(old('color')=='') selected  @endif>選択してください</option>
          				<option value="red" @if(old('color')=='red') selected  @endif>赤</option>
          				<option value="pink" @if(old('color')=='pink') selected  @endif>ピンク</option>
          				<option value="purple" @if(old('color')=='purple') selected  @endif>紫</option>
          				<option value="blue" @if(old('color')=='blue') selected  @endif>青</option>
          				<option value="green" @if(old('color')=='green') selected  @endif>緑</option>
          				<option value="yellow" @if(old('color')=='yellow') selected  @endif>黄色</option>
          				<option value="black" @if(old('color')=='black') selected  @endif>黒</option>
          				<option value="white" @if(old('color')=='white') selected  @endif>白</option>
        				</select>
              </div>

              <input type='submit' class='btn btn-primary' value='推しを登録'>
              <a href="{{ route('index') }}" class='btn btn-info btn-back'>一覧へ戻る</a>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection