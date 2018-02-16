@extends('layouts.common')
@section('title', 'Yeni Bir Sistem Kullanıcısı Oluştur')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Yeni Bir Sistem Kullanıcısı Oluştur</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('system.users.create.post'),'method'=>'post','autocomplete'=>'off')) }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('kullanıcıAdı', 'Kullanıcı Adı')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    {{ Form::text('kullanıcıAdı',Input::old('kullanıcıAdı'),array('class'=>'form-control','id'=>'kullanıcıAdı','placeholder'=>'Kullanıcı Adı')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('eposta', 'Eposta')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::email('eposta',Input::old('eposta'),array('class'=>'form-control','id'=>'eposta','placeholder'=>'Eposta')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('isim', 'İsim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('isim',Input::old('isim'),array('class'=>'form-control','id'=>'isim','placeholder'=>'İsim')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('soyisim', 'Soyisim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('soyisim',Input::old('soyisim'),array('class'=>'form-control','id'=>'soyisim','placeholder'=>'Soyisim')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('şifre', 'Şifre')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    {{ Form::text('şifre',Input::old('şifre'),array('class'=>'form-control','id'=>'şifre','placeholder'=>'Şifre')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('erişimGrubu', 'Erişim Grubu')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                    {{ Form::select('erişimGrubu', $groups_array, Input::old('erişimGrubu'), array('id'=>'erişimGrubu','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, Input::old('durum'), array('id'=>'durum','class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::submit('Oluştur',array('class'=>'btn btn-lg btn-success btn-block')) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection