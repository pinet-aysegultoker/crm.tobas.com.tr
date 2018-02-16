@extends('layouts.common')
@section('title', 'Bir Konutu Düzenle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-pencil" aria-hidden="true"></i> Bir Konutu Düzenle</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('apartment.edit.post'),'method'=>'post','autocomplete'=>'off','enctype'=>'multipart/form-data')) }}
                        {{ Form::hidden('id',$apartment->id) }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('projeAdı', 'Proje Adı') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('projeAdı',Project::where('id',Building::where('id',$apartment->building_id)->pluck('project_id'))->pluck('title'),array('class'=>'form-control','id'=>'projeAdı','placeholder'=>'Proje Adı','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('blokAdı', 'Blok Adı') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('blokAdı', $building_array, $apartment->building_id, array('id'=>'blokAdı','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('oluşturan', 'Oluşturan') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('oluşturan', User::where('id',$apartment->creator_id)->pluck('first_name').' '.User::where('id',$apartment->creator_id)->pluck('last_name'),array('class'=>'form-control','id'=>'oluşturan','placeholder'=>'Oluşturan','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::label('konutAdı', 'Konut Adı') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('konutAdı',$apartment->title,array('class'=>'form-control','id'=>'konutAdı','placeholder'=>'Konut Adı')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('kat', 'Kat') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('kat',$apartment->floor,array('class'=>'form-control','id'=>'kat','placeholder'=>'Kat')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('numara', 'Numara') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('numara',$apartment->number,array('class'=>'form-control','id'=>'numara','placeholder'=>'Numara')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('bbKodu', 'BB Kodu') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('bbKodu',$apartment->bb_code,array('class'=>'form-control','id'=>'bbKodu','placeholder'=>'BB Kodu')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::label('netAlan', 'Net Alan (m2)') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('netAlan',$apartment->net_area,array('class'=>'form-control','id'=>'netAlan','placeholder'=>'Net Alan')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('brütAlan', 'Brüt Alan (m2)') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('brütAlan',$apartment->gross_area,array('class'=>'form-control','id'=>'brütAlan','placeholder'=>'Brüt Alan')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('tip', 'Tip') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('tip', $type_array, $apartment->type, array('id'=>'tip','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('durum', 'Durum') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, $apartment->status, array('id'=>'durum','class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::label('odaSayısı', 'Oda Sayısı') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::text('odaSayısı',$apartment->room, array('id'=>'odaSayısı','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('cephe', 'Cephe') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::text('cephe',$apartment->front, array('id'=>'cephe','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('önManzarası', 'Ön Manzarası') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('önManzarası', $view_array, $apartment->front_view, array('id'=>'önManzarası','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('arkaManzarası', 'Arka Manzarası') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('arkaManzarası', $view_array, $apartment->back_view, array('id'=>'arkaManzarası','class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('lot', 'Lot') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::text('lot', $apartment->lot, array('id'=>'lot','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('detaylar', 'Detaylar')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    {{ Form::textarea('detaylar',$apartment->details,array('class'=>'form-control','id'=>'detaylar','placeholder'=>'Detaylar')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('kdvHariçTemelFiyat', 'KDV Hariç Temel Fiyat') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('kdvHariçTemelFiyat',$apartment->price,array('class'=>'form-control','id'=>'kdvHariçTemelFiyat','placeholder'=>'KDV Hariç Temel Fiyat')) }}
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