@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@endsection

@section('content')
    @guest
  <!-- contents -->
  
  <div class="wrapper container-fluid">
     
    <div class="slide-img">
      <div class="container text-center">
        <h1 class="heading-font-lg pb-5">推し活を応援する<br>情報収集＋スケジュール管理サービス</h1>
        <a href="{{ route('register') }}"><button class="btn btn-ready btn-lg" id="btn_ready" type="button" >無料でOshiMarshを始める</button></a>
      </div>
    </div>
    
    <!-- section ready -->
    <section class="section ready" id="ready">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto text-center ">
            <div class="heading-font-lg h3">OshiMarshとは</div>
            <div class="heading-font-sm">
                OshiMarshは、「Oshi」＝「推し」、「Marsh」＝「沼」、</br>
                更に「推します！」という推しへの熱い思いを宣言する意味も込めています。</br>
                推しの沼にはまってしまっている推し活で忙しい人たちのためのサービスです。</br></br>
                
                今や推しが複数いることも珍しくなく、推しが多ければ多いほど、</br>
                情報収集やスケジュール管理に時間を費やしている人は多いはず。</br>
                Oshimarshを利用すれば、そんな"情報収集"、"スケジュール管理"をカンタンに行えます。</br>
                
                アイドル、歌手、タレント、お笑い芸人など、数多くのジャンルの登録が可能です。</br>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- section ready -->

    <!-- section about -->
    <section class="section border-bottom border-light" id="about">
      <div class="container">
          <!--thema-->
          <div class="col-md-12 ">
            <h2 class="text-center">
              <div class="heading-font-lg">OshiMarshの機能・特徴</div>
            </h2>
          </div>
          <!--thema-->
          <!--card div-->
          <div class="col-md-12">
            <!--card deck-->
            <div class="card-deck about">
              <!--card-->

               <div class="card" style="width: 20rem;">
                  <img class="card-img-top" src="{{ asset('images/function01.jpg') }}" alt="情報収集のイメージ画像">
                  <div class="card-body">
                    <h4 class="card-title">情報収集</h4>
                    <p class="card-text">推しは時とともに増えていくものですね。
                        推しのプロフィールを入力して何人推しているかをしっかり管理。</br>
                        さらに、推しの情報(Twitter、メディア情報)も簡単に収集できます！
                    </p>
                  </div>
                </div>

               <div class="card" style="width: 20rem;">
                  <img class="card-img-top" src="{{ asset('images/function02.jpg') }}" alt="スケジュール管理のイメージ画像">
                  <div class="card-body">
                    <h4 class="card-title">スケジュール管理</h4>
                    <p class="card-text">
                        推しの数が多いとスケジュールを管理するのに一苦労。</br>
                        Oshimarshは推しごとに予定を登録できるスケジュール管理機能を搭載。</br>
                        いつどこで推し活をするかスケジュール一目瞭然でわかります。
                    </p>
                  </div>
                </div>
              <!--card-->
            </div>
            <!--card deck-->
          </div>
          <!--card div-->
      </div>
    </section>
    <!-- section about -->
    <!-- section ready -->
    <section class="section ready" id="ready">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center ">
            <div class="heading-font-lg h3">まずはユーザー登録から！</div>
        <a href="{{ route('register') }}"><button class="btn btn-ready btn-lg" id="btn_ready" type="button" >無料でOshiMarshを始める</button></a>
          </div>
        </div>
      </div>
    </section>
    <!-- section ready -->
  </div>

    @else
    	<div class="row justify-content-center container">
    	    <div class="col-md-4">
    	        <div class="card mb50 mt50">
    	            <div class="card-body">
     			    {{ Auth::user()->name }} さんの推しは<br>現在 {{ count($oshi_infos) }} 人です！
    	            </div>
    	        </div>
    	    </div>
    	</div>
        <div class="d-flex flex-column justify-content-center container">
            @foreach($oshi_infos as $oshi_info)
                    <div class="card mb50">
                        <div class="card-body col-md-12 d-flex justify-content-start">
                            <div class="col-md-3">
                                @if(!empty($oshi_info->image))
                                    <div class='image-wrapper'><img class='oshi-image' src="{{ asset('storage/images/'.$oshi_info->image) }}"></div>
                                @else
                                    <div class='image-wrapper'><img class='oshi-image' src="{{ asset('images/angel.png') }}"></div>
                                @endif
                              <div class="col-md-2 d-flex align-items-end text-right">
                                <a href="{{ route('show', ['id' => $oshi_info->id ]) }}" class='btn btn-info'>
                                    <i class="fas fa-external-link-alt"></i>詳細
                                </a>
                                <a href="{{ route('edit', ['id' => $oshi_info->id ]) }}" class='btn btn-secondary'>
                                    <i class="fa fa-pencil"></i>編集
                                </a>
                              </div>
                            </div>
                            <div class="col-md-7">
                                <h3 class='h3 oshi-title'>{{ $oshi_info->name }}</h3>
                                <p class='description'>{{ $oshi_info->belong_team }}</p>
                            </div>
                            <div class="col-md-2 d-flex align-items-end text-right">
                              <a href="{{ route('delete', ['id' => $oshi_info->id ])  }}" class="btn btn-danger">
                                  <i class="fa fa-trash"></i>削除
                              </a>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    @endguest
@endsection