@extends('layouts.common')
@section('title', 'Gelen Mesajları Görüntüler')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading">
                        <h1><i class="fa fa-eye" aria-hidden="true"></i> Gelen Mesajları Görüntüle</h1>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-crm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gönderen Kişi</th>
                                    <th>Gönderen E-posta Adresi </th>
                                    <th>Gönderim Zamanı</th>
                                    <th class="col-sm-1">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <th scope="row">{{$message->id}}</th>
                                        <td>{{$message->name}}</td>
                                        <td>{{$message->email}}</td>
                                        <td>{{$message->created_at}}</td>
                                        <td>
                                            <div class="btn-group btn-group-justified" role="group">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-xs btn-primary" data-time="{{$message->created_at}}" data-phone="{{$message->phone}}" data-ip="{{$message->ip}}" data-name="{{$message->name}}" data-email="{{$message->email}}" data-toggle="modal" data-target="#showModal" >
                                                        <span class="fa fa-eye"  aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-xs btn-danger" data-id="{{$message->id}}" data-time="{{$message->created_at}}" data-phone="{{$message->phone}}" data-ip="{{$message->ip}}" data-name="{{$message->name}}" data-email="{{$message->email}}" data-toggle="modal" data-target="#removeModal" >
                                                        <span class="fa fa-trash-o" aria-hidden="true"></span>
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
    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(array('url'=>route('messages.remove'),'method'=>'post','autocomplete'=>'off')) }}
                {{ Form::hidden('id', '', array('id' => 'id')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Bir Mesajı Sil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('gönderenKisi', 'Gönderen Kişi')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                {{ Form::text('gönderenKisi',null,array('class'=>'form-control','id'=>'gönderenKisi','placeholder'=>'Müşteri Grubu','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('gönderenEmail', 'Gönderen Email')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('gönderenEmail',null,array('class'=>'form-control','id'=>'gönderenEmail','placeholder'=>'İsim','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('ip', 'Ip')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('ip',null,array('class'=>'form-control','id'=>'ip','placeholder'=>'ip','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('gönderimZamani', 'Gönderim Zamanı')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('gönderimZamani',null,array('class'=>'form-control','id'=>'gönderimZamani','placeholder'=>'gönderimZamani','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('phone', 'Telefon')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('phone',null,array('class'=>'form-control','id'=>'phone','placeholder'=>'Telefon','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            {{ Form::submit('Sil', array('class' => 'btn btn-danger btn-lg btn-block')) }}
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-lg" data-dismiss="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(array('url'=>route('customer.remove.post'),'method'=>'post','autocomplete'=>'off')) }}
                {{ Form::hidden('id', '', array('id' => 'id')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Mesaj Görüntüle</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('gönderenKisi', 'Gönderen Kişi')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                {{ Form::text('gönderenKisi',null,array('class'=>'form-control','id'=>'gönderenKisi','placeholder'=>'Müşteri Grubu','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('gönderenEmail', 'Gönderen Email')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('gönderenEmail',null,array('class'=>'form-control','id'=>'gönderenEmail','placeholder'=>'İsim','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('ip', 'Ip')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('ip',null,array('class'=>'form-control','id'=>'ip','placeholder'=>'ip','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('gönderimZamani', 'Gönderim Zamanı')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('gönderimZamani',null,array('class'=>'form-control','id'=>'gönderimZamani','placeholder'=>'gönderimZamani','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('phone', 'Telefon')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::textarea('phone',null,array('class'=>'form-control','id'=>'phone','placeholder'=>'phone','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-lg" data-dismiss="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <script>
        $('#removeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            var name = button.data('name');
            var email = button.data('email');
            var ip = button.data('ip');
            var time = button.data('time');
            var phone = button.data('phone');
            modal.find('.modal-body #gönderenKisi').val(name);
            $('#id').val(id);
            modal.find('.modal-body #gönderenEmail').val(email);
            modal.find('.modal-body #ip').val(ip);
            modal.find('.modal-body #gönderimZamani').val(time);
            modal.find('.modal-body #phone').val(phone);
        })

        $('#showModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var name = button.data('name');
            var email = button.data('email');
            var ip = button.data('ip');
            var time = button.data('time');
            var phone = button.data('phone');
            modal.find('.modal-body #gönderenKisi').val(name);
            modal.find('.modal-body #gönderenEmail').val(email);
            modal.find('.modal-body #ip').val(ip);
            modal.find('.modal-body #gönderimZamani').val(time);
            modal.find('.modal-body #phone').val(phone);
        })
    </script>
@endsection