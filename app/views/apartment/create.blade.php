@extends('layouts.common')
@section('title', 'Yeni Bir Konut Oluştur')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Konut Oluştur</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('apartment.create.post'),'method'=>'post','id'=>'multiple_upload_form','autocomplete'=>'off','enctype'=>'multipart/form-data')) }}
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ Form::label('blokAdı', 'Blok Adı') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('blokAdı', $building_array, Input::old('blokAdı'), array('id'=>'blokAdı','class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::label('konutAdı', 'Konut Adı') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('konutAdı',Input::old('konutAdı'),array('class'=>'form-control','id'=>'konutAdı','placeholder'=>'Konut Adı')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('kat', 'Kat') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('kat',Input::old('kat'),array('class'=>'form-control','id'=>'kat','placeholder'=>'Kat')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('numara', 'Numara') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('numara',Input::old('numara'),array('class'=>'form-control','id'=>'numara','placeholder'=>'Numara')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('bbKodu', 'BB Kodu') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('bbKodu',Input::old('bbKodu'),array('class'=>'form-control','id'=>'bbKodu','placeholder'=>'BB Kodu')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::label('netAlan', 'Net Alan (m2)') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('netAlan',Input::old('netAlan'),array('class'=>'form-control','id'=>'netAlan','placeholder'=>'Net Alan')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('brütAlan', 'Brüt Alan (m2)') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('brütAlan',Input::old('brütAlan'),array('class'=>'form-control','id'=>'brütAlan','placeholder'=>'Brüt Alan')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('tip', 'Tip') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('tip', $type_array, Input::old('tip'), array('id'=>'tip','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('durum', 'Durum') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, 'active', array('id'=>'durum','class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::label('odaSayısı', 'Oda Sayısı') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::text('odaSayısı',Input::old('odaSayısı'), array('id'=>'odaSayısı','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('cephe', 'Cephe') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::text('cephe', Input::old('cephe'), array('id'=>'cephe','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('önManzarası', 'Ön Manzarası') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('önManzarası', $view_array, Input::old('önManzarası'), array('id'=>'önManzarası','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('arkaManzarası', 'Arka Manzarası') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('arkaManzarası', $view_array, Input::old('arkaManzarası'), array('id'=>'arkaManzarası','class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('lot', 'Lot') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::text('lot', Input::old('lot'), array('id'=>'lot','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('detaylar', 'Detaylar') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    {{ Form::textarea('detaylar',Input::old('detaylar'),array('class'=>'form-control','id'=>'detaylar','placeholder'=>'Detaylar')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('kdvHariçTemelFiyat', 'KDV Hariç Temel Fiyat') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('kdvHariçTemelFiyat',Input::old('kdvHariçTemelFiyat'),array('class'=>'form-control','id'=>'kdvHariçTemelFiyat','placeholder'=>'KDV Hariç Temel Fiyat')) }}
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