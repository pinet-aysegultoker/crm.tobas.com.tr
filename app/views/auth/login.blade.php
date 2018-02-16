@extends('layouts.auth')
@section('title', 'Giriş')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6 auth-box">
                <img alt="Brand" src="{{ asset('assets/images/auth-logo.png') }}" class="img-responsive center-block" />
                <h1 class="text-center">Hesabınıza giriş yapın...</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6 auth-box">
                {{ Form::open(array('url'=>route('auth.store'), 'method'=>'post', 'id'=>'auth-form', 'autocomplete'=>'off')) }}
                <div class="row">
                    <div class="form-group form-group-lg col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                            {{ Form::text('username', Input::old('username'), array('id' => 'username', 'class' => 'form-control', 'placeholder' => 'Kullanıcı adınızı girin')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-group-lg col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-console" aria-hidden="true"></span></span>
                            {{ Form::password('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'Şifrenizi girin')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        {{ Form::submit('Giriş', array('class' => 'btn btn-success btn-lg btn-block')) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection