@extends('layouts.common')
@section('title', 'Yeni Bir Blok Oluştur')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Blok Oluştur</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('building.create.post'),'method'=>'post','autocomplete'=>'off','enctype'=>'multipart/form-data')) }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('başlık', 'Başlık')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('başlık',Input::old('başlık'),array('class'=>'form-control','id'=>'başlık','placeholder'=>'Başlık')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                {{ Form::label('ada', 'Ada')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('ada',Input::old('ada'),array('class'=>'form-control','id'=>'ada','placeholder'=>'Ada')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                {{ Form::label('parsel', 'Parsel')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('parsel',Input::old('parsel'),array('class'=>'form-control','id'=>'parsel','placeholder'=>'Parsel')) }}
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
                            <div class="form-group col-md-4">
                                {{ Form::label('proje', 'Proje')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i></span>
                                    {{ Form::select('proje', $project_array, Input::old('proje'), array('id'=>'proje','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                {{ Form::label('detaylar', 'Detaylar')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    {{ Form::textarea('detaylar',Input::old('detaylar'),array('class'=>'form-control','id'=>'detaylar','placeholder'=>'Detaylar')) }}
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