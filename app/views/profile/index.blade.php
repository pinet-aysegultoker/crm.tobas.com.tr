@extends('layouts.common')
@section('title', 'Hesap İşlemleri')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-user" aria-hidden="true"></i> Hesap İşlemleri</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>'#','method'=>'post','autocomplete'=>'off')) }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('kullanıcıAdı', 'Kullanıcı Adı')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('kullanıcıAdı',$user->username,array('class'=>'form-control','id'=>'kullanıcıAdı','placeholder'=>'Kullanıcı Adı','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('isim', 'İsim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('isim',$user->first_name,array('class'=>'form-control','id'=>'isim','placeholder'=>'İsim','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('soyisim', 'Soyisim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('soyisim',$user->last_name,array('class'=>'form-control','id'=>'soyisim','placeholder'=>'Soyisim','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('kullanıcıGrubu', 'Kullanıcı Grubu')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('kullanıcıGrubu',UserGroup::where('id',$user->group_id)->pluck('title'),array('class'=>'form-control','id'=>'kullanıcıGrubu','placeholder'=>'Kullanıcı Grubu','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('IP', 'IP')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('IP',$user->last_login_ip,array('class'=>'form-control','id'=>'IP','placeholder'=>'IP','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('sonHesapDüzenlemesi', 'Son Hesap Düzenlemesi')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('sonHesapDüzenlemesi',Carbon::parse($user->updated_at)->formatLocalized('%d/%m/%Y %H:%M:%S'),array('class'=>'form-control','id'=>'sonHesapDüzenlemesi','placeholder'=>'Son Hesap Düzenlemesi','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-lg btn-warning btn-block" href="#" data-toggle="modal" data-target="#editModal"><i class="fa fa-key" aria-hidden="true"></i> Parolayı Değiştir</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Hatırlatıcılar</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-default">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Zaman</th>
                                        <th>Müşteri</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reminders as $reminder)
                                        <?php $customer = Customer::find($reminder->customer_id); ?>

                                        <tr>
                                            <td><a href="#" data-reminder="{{  $reminder->id }}" data-toggle="modal" data-target="#infoModal">{{ $reminder->id }}</a></td>
                                                <td><a href="#" data-reminder="{{  $reminder->id }}" data-toggle="modal" data-target="#infoModal">{{ Carbon::parse($reminder->time)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</a></td>
                                                <td><a href="#" data-reminder="{{  $reminder->id }}" data-toggle="modal" data-target="#infoModal">{{ $customer->first_name }} {{ $customer->last_name }}</a></td>
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
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(array('url'=>route('profile.edit.post'),'method'=>'post','autocomplete'=>'off')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editModalLabel">Parolayı Değiştir</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('yeniParolanız', 'Yeni Parolanız')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                {{ Form::text('yeniParolanız',null,array('class'=>'form-control','id'=>'yeniParolanız','placeholder'=>'Yeni Parolanız')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            {{ Form::submit('Parolayı Değiştir', array('class' => 'btn btn-warning btn-lg btn-block')) }}
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
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="infoModalLabel">Hatırlatıcı Detayları</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" class="col-md-4">Oluşturma Zamanı</th>
                                <td id="created_at"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-md-4">Hatırlatma Zamanı</th>
                                <td id="time"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-md-4">Müşteri</th>
                                <td id="customer"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-md-4">Açıklama</th>
                                <td id="description"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-lg" data-dismiss="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#infoModal').on('show.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var modal = $(this);
            var reminder = button.data('reminder');
            modal.find('#created_at').empty();
            modal.find('#time').empty();
            modal.find('#customer').empty();
            modal.find('#description').empty();
            $.ajax({
                type: "POST",
                url: "{{ route('api.get.reminder') }}",
                beforeSend: function() { $('.loading').show(); },
                complete: function() { $('.loading').hide(); },
                data:'reminder='+reminder,
                success: function(data){
                    $.each(JSON.parse(data), function(key, value){
                        modal.find('#created_at').html(value["created_at"]);
                        modal.find('#time').html(value["time"]);
                        modal.find('#customer').html(value["customer"]);
                        modal.find('#description').html(value["description"]);
                    });
                }
            });
        });
    </script>
@endsection