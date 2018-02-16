@extends('layouts.common')
@section('title', 'Bir Sistem Kullanıcısını Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Bir Sistem Kullanıcısını Görüntüle</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>'#','method'=>'post','autocomplete'=>'off')) }}
                        {{ Form::hidden('id',$user->id) }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('kullanıcıAdı', 'Kullanıcı Adı')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    {{ Form::text('kullanıcıAdı',$user->username,array('class'=>'form-control','id'=>'kullanıcıAdı','placeholder'=>'Kullanıcı Adı','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('eposta', 'Eposta')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::email('eposta',$user->email,array('class'=>'form-control','id'=>'eposta','placeholder'=>'Eposta','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('isim', 'İsim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('isim',$user->first_name,array('class'=>'form-control','id'=>'isim','placeholder'=>'İsim','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('soyisim', 'Soyisim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('soyisim',$user->last_name,array('class'=>'form-control','id'=>'soyisim','placeholder'=>'Soyisim','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('şifre', 'Şifre')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    {{ Form::text('şifre', null,array('class'=>'form-control','id'=>'şifre','placeholder'=>'Şifre','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('erişimGrubu', 'Erişim Grubu')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                    {{ Form::select('erişimGrubu', $groups_array, $user->group_id, array('id'=>'erişimGrubu','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, $user->status, array('id'=>'durum','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-lg btn-info btn-block" href="{{ route('system.users.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Sistem Kullanıcısının Günlüğünü Görüntüle</h1></div>
                    <div class="panel-body">
                        <table class="table table-hover table-crm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>İşlenen Veri</th>
                                <th>İşlem Türü</th>
                                <th>Gerçekleştiren Kullanıcı</th>
                                <th>İşlem Zamanı</th>
                                <th class="col-sm-1">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_logs as $log)
                                <?php
                                $user = User::find($log->user_id);
                                ?>
                                <tr>
                                    <th scope="row">{{ $log->id }}</th>
                                    <td>{{ User::where('id', $log->data_id)->pluck('first_name') . ' <b>' . User::where('id', $log->data_id)->pluck('last_name') . '</b>' }}</td>
                                    <td>{{ Lang::get('common.'.$log->type) }}</td>
                                    <td>{{ $user->first_name }} <b>{{ $user->last_name }}</b></td>
                                    <td>{{ Carbon::parse($log->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-justified" role="group">
                                            <div class="btn-group" role="group">
                                                <a type="button" class="btn btn-xs btn-info" href="#" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection