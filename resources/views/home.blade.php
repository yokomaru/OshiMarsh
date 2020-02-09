@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-8 mx-auto text-center ">
                        <div class="heading-font-md">登録が完了しました！</div>
                        <div class="heading-font-md">まずは↓から推しを登録！</div>
                            <a href="{{ route('create') }}"><button class="btn btn-ready btn-lg" id="btn_ready" type="button" >推しを登録する</button></a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
