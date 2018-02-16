@extends('layouts.common')
@section('title', 'Projeleri Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Projeleri Görüntüle</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-crm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Proje Adı</th>
                                        <th>Durum</th>
                                        <th>Blok Sayısı</th>
                                        <th>Oluşturma Zamanı</th>
                                        <th class="col-sm-1">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                        <tr>
                                            <th scope="row">{{ $project->id }}</th>
                                            <td><b>{{ $project->title }}</b></td>
                                            <td>{{ Lang::get('common.'.$project->status) }}</td>
                                            <td>{{ Building::where('project_id',$project->id)->count() }}</td>
                                            <td>{{ Carbon::parse($project->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                            <td>
                                                <div class="btn-group btn-group-justified" role="group">
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn btn-xs btn-info" href="{{ route('project.show', $project->id) }}" target="_blank" role="button"><span class="fa fa-eye" aria-hidden="true"></span></a>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn btn-xs btn-warning" href="{{ route('project.edit', $project->id) }}" role="button"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#removeModal" data-id="{{ $project->id }}" data-title="{{ $project->title }}" data-status="{{ Lang::get('common.'.$project->status) }}">
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
                                <a type="button" class="btn btn-xl btn-success" href="{{ route('project.create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Proje Oluştur</a>
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
                {{ Form::open(array('url'=>route('project.remove.post'),'method'=>'post','autocomplete'=>'off')) }}
                {{ Form::hidden('id', '', array('id' => 'id')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Bir Projeyi Sil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('başlık', 'Başlık')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                {{ Form::text('başlık',null,array('class'=>'form-control','id'=>'başlık','placeholder'=>'Başlık','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('durum', 'Durum')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                {{ Form::text('durum',null,array('class'=>'form-control','id'=>'durum','placeholder'=>'Durum','disabled'=>'disabled')) }}
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
            var title = button.data('title');
            var status = button.data('status');
            modal.find('.modal-title').text('Bir Projeyi Sil -> ' + title);
            $('#id').val(id);
            modal.find('.modal-body #başlık').val(title);
            modal.find('.modal-body #durum').val(status);
        })
    </script>
@endsection