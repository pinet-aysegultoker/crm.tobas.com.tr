@extends('layouts.common')
@section('title', 'Müşterileri Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading">
                        <h1><i class="fa fa-eye" aria-hidden="true"></i> Müşterileri Görüntüle</h1>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-crm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>İsim & Soyisim</th>
                                        <th>Son İşlem Zamanı</th>
                                        <th>Oluşturma Zamanı</th>
                                        <th class="col-sm-1">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <th scope="row">{{ $customer->id }}</th>
                                        <td>{{ $customer->first_name }} <b>{{ $customer->last_name }}</b></td>
                                        <td>{{ Carbon::parse($customer->last_process_time)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                        <td>{{ Carbon::parse($customer->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-justified" role="group">
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn btn-xs btn-info" href="{{ route('customer.show', $customer->id) }}" role="button"><span class="fa fa-eye" aria-hidden="true"></span></a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn btn-xs btn-warning" href="{{ route('customer.edit', $customer->id) }}" role="button"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#removeModal" data-id="{{ $customer->id }}" data-group="{{ CustomerGroup::where('id',$customer->group_id)->pluck('title') }}" data-first_name="{{ $customer->first_name }}" data-last_name="{{ $customer->last_name }}">
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
                                <a type="button" class="btn btn-xl btn-success" href="{{ route('customer.create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Müşteri Oluştur</a>
                            </div>
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-xl btn-info" href="{{ route('customer.group.index') }}" role="button"><i class="fa fa-eye" aria-hidden="true"></i> Müşteri Gruplarını Görüntüle</a>
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
                {{ Form::open(array('url'=>route('customer.remove.post'),'method'=>'post','autocomplete'=>'off')) }}
                {{ Form::hidden('id', '', array('id' => 'id')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Bir Müşteriyi Sil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('müşteriGrubu', 'Müşteri Grubu')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                {{ Form::text('müşteriGrubu',null,array('class'=>'form-control','id'=>'müşteriGrubu','placeholder'=>'Müşteri Grubu','disabled'=>'disabled')) }}
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
            var group = button.data('group');
            var first_name = button.data('first_name');
            var last_name = button.data('last_name');
            modal.find('.modal-title').text('Bir Müşteriyi Sil -> ' + first_name + ' ' + last_name);
            $('#id').val(id);
            modal.find('.modal-body #müşteriGrubu').val(group);
            modal.find('.modal-body #isim').val(first_name);
            modal.find('.modal-body #soyisim').val(last_name);
        })
    </script>
@endsection