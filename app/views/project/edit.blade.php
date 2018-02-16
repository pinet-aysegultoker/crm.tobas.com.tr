@extends('layouts.common')
@section('title', 'Bir Projeyi Düzenle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-pencil" aria-hidden="true"></i> Bir Projeyi Düzenle</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('project.edit.post'),'method'=>'post','autocomplete'=>'off','enctype'=>'multipart/form-data')) }}
                        {{ Form::hidden('id',$project->id) }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('başlık', 'Başlık')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('başlık',$project->title,array('class'=>'form-control','id'=>'başlık','placeholder'=>'Başlık')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, $project->status, array('id'=>'durum','class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ Form::label('detaylar', 'Detaylar')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    {{ Form::textarea('detaylar',$project->details,array('class'=>'form-control','id'=>'detaylar','placeholder'=>'Detaylar')) }}
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