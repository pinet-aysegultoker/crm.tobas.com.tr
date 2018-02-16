@extends('layouts.common')
@section('title', 'Yeni Bir Satış İşlemi Belirt')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Satış İşlemi Belirt</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('sales.create.post'),'method'=>'post','autocomplete'=>'off')) }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('proje', 'Proje')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    {{ Form::select('proje', $projects_array, Input::old('proje'), array('id'=>'proje','class'=>'form-control','onChange'=>'getBlok($(this).val());')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('blok', 'Blok')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                    {{ Form::select('blok', ['' => 'Bir Proje Seçiniz'], Input::old('blok'), array('id'=>'blok','class'=>'form-control','onChange'=>'getKonut($(this).val());')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('konut', 'Konut')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                    {{ Form::select('konut', ['' => 'Bir Blok Seçiniz'], Input::old('konut'), array('id'=>'konut','class'=>'form-control','onChange'=>'getTeklif($(this).val());')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('teklif', 'Teklif')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                    {{ Form::select('teklif', ['' => 'Bir Konut Seçiniz'], Input::old('teklif'), array('id'=>'teklif','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                {{ Form::label('açıklama', 'Açıklama')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::textarea('açıklama',Input::old('açıklama'),array('class'=>'form-control','id'=>'açıklama','placeholder'=>'Açıklama')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::submit('Yeni Bir Satış İşlemi Belirt',array('class'=>'btn btn-lg btn-success btn-block')) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getBlok(proje) {
            $.ajax({
                type: "POST",
                url: "{{ route('api.get.buildings') }}",
                beforeSend: function() { $('.loading').show(); },
                complete: function() { $('.loading').hide(); },
                data:'proje='+proje,
                success: function(data){
                    $('#blok').empty();
                    $('#blok').append($('<option>').text("Seçiniz..."));
                    $.each(JSON.parse(data), function(key, value){
                        $('#blok').append($('<option>').text(value.title).attr('value', value.id));
                    });
                }
            });
        }
        function getKonut(blok) {
            $.ajax({
                type: "POST",
                url: "{{ route('api.get.apartments') }}",
                beforeSend: function() { $('.loading').show(); },
                complete: function() { $('.loading').hide(); },
                data:'blok='+blok,
                success: function(data){
                    $('#konut').empty();
                    $('#konut').append($('<option>').text("Seçiniz..."));
                    $.each(JSON.parse(data), function(key, value){
                        $('#konut').append($('<option>').text(value.title).attr('value', value.id));
                    });
                }
            });
        }
        function getTeklif(konut) {
            $.ajax({
                type: "POST",
                url: "{{ route('api.get.offers') }}",
                beforeSend: function() { $('.loading').show(); },
                complete: function() { $('.loading').hide(); },
                data:'konut='+konut,
                success: function(data){
                    $('#teklif').empty();
                    $('#teklif').append($('<option>').text("Seçiniz..."));
                    $.each(JSON.parse(data), function(key, value){
                        $('#teklif').append($('<option>').text(value.title).attr('value', value.id));
                    });
                }
            });
        }
    </script>
@endsection