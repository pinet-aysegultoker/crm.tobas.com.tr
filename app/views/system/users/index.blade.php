@extends('layouts.common')
@section('title', 'Sistem Kullanıcılarını Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Sistem Kullanıcılarını Görüntüle</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-crm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kullanıcı Adı</th>
                                        <th>İsim & Soyisim</th>
                                        <th>Eposta</th>
                                        <th>Kullanıcı Grubu</th>
                                        <th>Oluşturma Zamanı</th>
                                        <th>Son Değişiklik Zamanı</th>
                                        <th>Son Giriş Zamanı</th>
                                        <th class="col-sm-1">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->first_name }} <b>{{ $user->last_name }}</b></td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ UserGroup::where('id',$user->group_id)->pluck('title') }}</td>
                                            <td>{{ Carbon::parse($user->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                            <td>{{ Carbon::parse($user->updated_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                            <td>
                                                @if($user->last_login_time==null)
                                                    Kayıtlı Giriş Yok
                                                @else
                                                    {{ Carbon::parse($user->last_login_time)->formatLocalized('%d/%m/%Y %H:%M:%S') }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-justified" role="group">
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn btn-xs btn-info" href="{{ route('system.users.show', $user->id) }}" role="button"><span class="fa fa-eye" aria-hidden="true"></span></a>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn btn-xs btn-warning" href="{{ route('system.users.edit', $user->id) }}" role="button"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#removeModal" data-id="{{ $user->id }}" data-username="{{ $user->username }}" data-first_name="{{ $user->first_name }}" data-last_name="{{ $user->last_name }}">
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
                    <div class="panel-footer">
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-xl btn-success" href="{{ route('system.users.create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Sistem Kullanıcı Oluştur</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(array('url'=>route('system.users.remove.post'),'method'=>'post','autocomplete'=>'off')) }}
                {{ Form::hidden('id', '', array('id' => 'id')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Bir Sistem Kullanıcısını Sil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('kullanıcıAdı', 'Kullanıcı Adı')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                {{ Form::text('kullanıcıAdı',null,array('class'=>'form-control','id'=>'kullanıcıAdı','placeholder'=>'Kullanıcı Adı','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('isim', 'İsim')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('isim',null,array('class'=>'form-control','id'=>'isim','placeholder'=>'İsim','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('soyisim', 'Soyisim')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('soyisim',null,array('class'=>'form-control','id'=>'soyisim','placeholder'=>'Soyisim','disabled'=>'disabled')) }}
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
    <script>
        $('#removeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            var username = button.data('username');
            var first_name = button.data('first_name');
            var last_name = button.data('last_name');
            modal.find('.modal-title').text('Bir Sistem Kullanıcısını Sil -> ' + first_name + ' ' + last_name);
            $('#id').val(id);
            modal.find('.modal-body #kullanıcıAdı').val(username);
            modal.find('.modal-body #isim').val(first_name);
            modal.find('.modal-body #soyisim').val(last_name);
        })
    </script>
@endsection