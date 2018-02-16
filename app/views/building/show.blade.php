@extends('layouts.common')
@section('title', 'Bir Bloğu Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Bir Bloğu Görüntüle</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>'#','method'=>'post','autocomplete'=>'off')) }}
                        {{ Form::hidden('id',$building->id) }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('başlık', 'Başlık')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('başlık',$building->title,array('class'=>'form-control','id'=>'başlık','placeholder'=>'Başlık','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                {{ Form::label('ada', 'Ada')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('ada',$building->island,array('class'=>'form-control','id'=>'ada','placeholder'=>'Ada','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                {{ Form::label('parsel', 'Parsel')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('parsel',$building->parcel,array('class'=>'form-control','id'=>'parsel','placeholder'=>'Parsel','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, $building->status, array('id'=>'durum','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('proje', 'Proje')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i></span>
                                    {{ Form::select('proje', $project_array, $building->proje_id, array('id'=>'proje','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                {{ Form::label('detaylar', 'Detaylar')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    {{ Form::textarea('detaylar',$building->details,array('class'=>'form-control','id'=>'detaylar','placeholder'=>'Detaylar','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-lg btn-info btn-block" href="{{ route('building.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="panel-footer">
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-xl btn-info" href="{{ route('pdf.qrcode.building.show', $building->id) }}" role="button"><i class="fa fa-arrow-down" aria-hidden="true"></i> Karekodları İndir</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Blok Kat Planları</h1></div>
                    <div class="panel-body">
                        <div class="row">
                            <?php
                                $kat_planlari = File::allFiles(base_path('public/files/building/'.$building->id.'/kat-planlari'));
                                $kat_planlari_count = count($kat_planlari);
                            ?>
                            @if(File::exists((string)$kat_planlari[0]))
                                @foreach ($kat_planlari as $kat_plani)
                                    @if ($kat_planlari_count > 1)
                                        <div class="col-md-4">
                                            <img src="{{ asset('files/building/'.$building->id.'/kat-planlari/'.basename((string)$kat_plani)) }}" class="img-responsive img-thumbnail center-block" />
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <img src="{{ asset('files/building/'.$building->id.'/kat-planlari/'.basename((string)$kat_plani)) }}" class="img-responsive img-thumbnail center-block" />
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <img src="{{ base_path('public/assets/images/no-image.jpg') }}" class="img-responsive img-thumbnail center-block" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Blok Resimleri</h1></div>
                    <div class="panel-body">
                        <div class="row">
                            <?php
                                $resimler = File::allFiles(base_path('public/files/building/'.$building->id.'/resimler'));
                                $resimler_count = count($resimler);
                            ?>
                            @if(File::exists((string)$resimler[0]))
                                @foreach ($resimler as $resim)
                                    @if ($resimler_count > 1)
                                        <div class="col-md-4">
                                            <img src="{{ asset('files/building/'.$building->id.'/resimler/'.basename((string)$resim)) }}" class="img-responsive img-thumbnail center-block" />
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <img src="{{ asset('files/building/'.$building->id.'/resimler/'.basename((string)$resim)) }}" class="img-responsive img-thumbnail center-block" />
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <img src="{{ base_path('public/assets/images/no-image.jpg') }}" class="img-responsive img-thumbnail center-block" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Blokta Yer Alan Konutlar</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-crm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Lot</th>
                                    <th>Kat</th>
                                    <th>Blok</th>
                                    <th>Net /Brüt (m<sup>2</sup>)</th>
                                    <th>Oda Sayısı</th>
                                    <th>Cephe</th>
                                    <th>Değeri (KDV Hariç)</th>
                                    <th class="col-sm-1">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($apartments as $apartment)
                                    <?php
                                        $building = Building::find($apartment->building_id);
                                    ?>
                                    @if($apartment->status=='active')
                                        <tr class="success">
                                    @elseif($apartment->status=='reserved')
                                        <tr class="warning">
                                    @else
                                        <tr class="danger">
                                    @endif
                                            <td><b>{{ $apartment->id }}</b></td>
                                            <td><b>{{ $apartment->lot }}</b></td>
                                            <td><b>{{ $apartment->floor }}</b></td>
                                            <td><b>{{ Project::where('id',$building->project_id)->pluck('title') }} > {{ $building->title }} > {{$apartment->number}}</b></td>
                                            <td><b>{{ $apartment->net_area }}/{{ $apartment->gross_area }}</b></td>
                                            <td><b>{{ $apartment->room }}</b></td>
                                            <td><b>{{ $apartment->front }}</b></td>
                                            <td><b>{{ number_format($apartment->price, 2, ',', '.') }} ₺</b></td>
                                            <td>
                                                @if($apartment->status=='passive')
                                                    <div class="btn-group btn-group-justified" role="group">
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn btn-xs btn-info disabled" onclick="return false;" href="#" role="button"><span class="fa fa-eye" aria-hidden="true"></span></a>
                                                        </div>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn btn-xs btn-warning disabled" onclick="return false;" href="#" role="button"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                                                        </div>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn btn-xs btn-danger disabled" onclick="return false;" href="#" role="button">
                                                                <span class="fa fa-trash-o" aria-hidden="true"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="btn-group btn-group-justified" role="group">
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn btn-xs btn-info" href="{{ route('apartment.show', $apartment->id) }}" role="button"><span class="fa fa-eye" aria-hidden="true"></span></a>
                                                        </div>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn btn-xs btn-warning" href="{{ route('apartment.edit', $apartment->id) }}" role="button"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                                                        </div>
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#removeModal" data-id="{{ $apartment->id }}" data-daire="{{ $apartment->title }}" data-blok="{{ $apartment->building_id }}">
                                                                <span class="fa fa-trash-o" aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
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
@endsection