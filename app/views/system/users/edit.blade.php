@extends('layouts.common')
@section('title', 'Bir Sistem Kullanıcısını Düzenle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-pencil" aria-hidden="true"></i> Bir Sistem Kullanıcısını Düzenle</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('system.users.edit.post'),'method'=>'post','autocomplete'=>'off')) }}
                        {{ Form::hidden('id',$user->id) }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('kullanıcıAdı', 'Kullanıcı Adı')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    {{ Form::text('kullanıcıAdı',$user->username,array('class'=>'form-control','id'=>'kullanıcıAdı','placeholder'=>'Kullanıcı Adı')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('eposta', 'Eposta')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::email('eposta',$user->email,array('class'=>'form-control','id'=>'eposta','placeholder'=>'Eposta')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('isim', 'İsim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('isim',$user->first_name,array('class'=>'form-control','id'=>'isim','placeholder'=>'İsim')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('soyisim', 'Soyisim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('soyisim',$user->last_name,array('class'=>'form-control','id'=>'soyisim','placeholder'=>'Soyisim')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('şifre', 'Şifre')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    {{ Form::text('şifre', null,array('class'=>'form-control','id'=>'şifre','placeholder'=>'Şifre')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('erişimGrubu', 'Erişim Grubu')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                    {{ Form::select('erişimGrubu', $groups_array, $user->group_id, array('id'=>'erişimGrubu','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, $user->status, array('id'=>'durum','class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::submit('Düzenle',array('class'=>'btn btn-lg btn-warning btn-block')) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection