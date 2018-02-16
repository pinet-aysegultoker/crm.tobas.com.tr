@extends('layouts.common')
@section('title', 'Sistem Günlüğünü Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Sistem Günlüğünü Görüntüle</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
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
                                    @foreach($system_logs as $log)
                                        <?php
                                            $user = User::find($log->user_id);
                                        ?>
                                        <tr>
                                            <th scope="row">{{ $log->id }}</th>
                                            <td>
                                                <?php
                                                   $data = SystemLogsController::logType($log->route,$log->data_id);
                                                if(isset($data['field3'])){echo $data['field3'].' '; }
                                                   echo $data['field1'] ." <b>" .$data['field2'] ."</b> ->". $data['type'];
                                                ?>
                                            </td>
                                            <td>{{ Lang::get('common.'.$log->type) }}</td>
                                            <td>{{ $user->first_name }} <b>{{ $user->last_name }}</b></td>
                                            <td>{{ Carbon::parse($log->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                            <td>
                                                <div class="btn-group btn-group-justified" role="group">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#logModal" data-ip="{{$log->user_ip}}" data-time="{{ Carbon::parse($log->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}" data-id="{{ $log->id }}" data-data=" <?php
                                                        $data = SystemLogsController::logType($log->route,$log->data_id);
                                                        if(isset($data['field3'])){echo $data['field3'].' '; }
                                                        echo $data['field1'] ." " .$data['field2'] ." ->". $data['type'];
                                                        ?>" data-first_name="{{ $user->first_name }}" data-last_name="{{ $user->last_name }}" data-type="{{ Lang::get('common.'.$log->type) }}">
                                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                                        </button>
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
    </div>
    <div class="modal fade" id="logModal" tabindex="-1" role="dialog" aria-labelledby="logModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Bir Sistem Kullanıcısını Sil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('gerceklestirenKullanici', 'Gerçekleştiren Kullanıcı')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                {{ Form::text('kullanıcıAdı',null,array('class'=>'form-control','id'=>'kullanıcıAdı','placeholder'=>'Kullanıcı Adı','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('islemTuru', 'İşlem Türü')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('islemTuru',null,array('class'=>'form-control','id'=>'islemTuru','placeholder'=>'İşlem Türü','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('islenenVeri', 'İşlenen Veri')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('islenenVeri',null,array('class'=>'form-control','id'=>'islenenVeri','placeholder'=>'İşlenen Veri','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('islemZamani', 'İşlem Zamanı')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('islemZamani',null,array('class'=>'form-control','id'=>'islemZamani','placeholder'=>'İşlem Zamanı','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('islemIp', 'İşlem Ip')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('islemIp',null,array('class'=>'form-control','id'=>'islemIp','placeholder'=>'İşlem Ip','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-lg" data-dismiss="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#logModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            var time = button.data('time');
            var type = button.data('type');
            var data = button.data('data');
            var ip = button.data('ip');
            var first_name = button.data('first_name');
            var last_name = button.data('last_name');
            modal.find('.modal-title').text('Sistem Günlüğü ');
            $('#id').val(id);
            modal.find('.modal-body #kullanıcıAdı').val(first_name+' '+last_name);
            modal.find('.modal-body #islenenVeri').val(data);
            modal.find('.modal-body #islemTuru').val(type);
            modal.find('.modal-body #islemZamani').val(time);
            modal.find('.modal-body #islemIp').val(ip);
        })
    </script>
@endsection