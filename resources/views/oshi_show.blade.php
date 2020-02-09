@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/oshi_show.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <div class="card">
    <div class="card-body d-flex">
      <aside class='oshi-image'>
  		@if(!empty($oshi_infos->image))
          	<img class='book-image' src="{{ asset('storage/images/'.$oshi_infos->image) }}">
  		@else
      		<img class='book-image' src="{{ asset('images/dummy.png') }}">
  		@endif
      </aside>
      <section class='oshi-main'>
        <h2 class='h2'>名前</h2>
        <p class='h2 mb20'>{{ $oshi_infos->name }}</p>
        <h2 class='h2'>所属チーム</h2>
        <p>{{ $oshi_infos->belong_team }}</p>
      </section>
      </div>
    <div class="d-flex justify-content-start">
      <a href="{{ route('index') }}" class='btn btn-info btn-back mb20'>一覧へ戻る</a>
      <a href="{{ route('index') }}" class='btn btn-info btn-back mb20'><i class="fas fa-edit"></i>編集</a>
    </div>
  </div>
<div class="tab_wrap">
	<input id="tab1" type="radio" name="tab_btn" checked>
	<input id="tab2" type="radio" name="tab_btn">
	<!--<input id="tab3" type="radio" name="tab_btn">-->
 
	<div class="tab_area">
		<label class="tab1_label" for="tab1">メディア情報</label>
		<label class="tab2_label" for="tab2">Twitter</label>
		<!--<label class="tab3_label" for="tab3">tab3</label>-->
	</div>
	<div class="panel_area">
		<div id="panel1" class="tab_panel">
			<p>panel1</p>
		</div>
		<div id="panel2" class="tab_panel">
    <div class="container">
　　　   {{-- コントローラーで取得した$resultをforeachで回す --}}
        @foreach ($result as $tweet)
            <div class="card mb-2">
                <div class="card-body">
                    <div class="media">
                        <img src="https://placehold.jp/70x70.png" class="rounded-circle mr-4">
                        <div class="media-body">
                            <h5 class="d-inline mr-3"><strong>{{ $tweet->user->name }}</strong></h5>
                            <h6 class="d-inline text-secondary">{{ date('Y/m/d', strtotime($tweet->created_at)) }}</h6>
                            <p class="mt-3 mb-0">{{ $tweet->text }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <div class="d-flex flex-row justify-content-end">
                        <div class="mr-5"><i class="far fa-comment text-secondary"></i></div>
                        <div class="mr-5"><i class="fas fa-retweet text-secondary"></i></div>
                        <div class="mr-5"><i class="far fa-heart text-secondary"></i></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
		</div>
	</div>
</div>
</div>
@endsection