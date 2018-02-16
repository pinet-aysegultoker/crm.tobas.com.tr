@extends('layouts.common')
@section('title', 'Bir Konutu Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Bir Konutu Görüntüle (<i>Lot: {{ $apartment->lot }}</i>)</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>'#','method'=>'post','autocomplete'=>'off')) }}
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
                                    {{ Form::select('blokAdı', $building_array, $apartment->building_id, array('id'=>'blokAdı','class'=>'form-control','disabled'=>'disabled')) }}
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
                                    {{ Form::text('konutAdı',$apartment->title,array('class'=>'form-control','id'=>'konutAdı','placeholder'=>'Konut Adı','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('kat', 'Kat') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('kat',$apartment->floor,array('class'=>'form-control','id'=>'kat','placeholder'=>'Kat','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('numara', 'Numara') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('numara',$apartment->number,array('class'=>'form-control','id'=>'numara','placeholder'=>'Numara','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('bbKodu', 'BB Kodu') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('bbKodu',$apartment->bb_code,array('class'=>'form-control','id'=>'bbKodu','placeholder'=>'BB Kodu','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::label('netAlan', 'Net Alan') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                    {{ Form::text('netAlan',$apartment->net_area.' m2',array('class'=>'form-control','id'=>'netAlan','placeholder'=>'Net Alan','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('brütAlan', 'Brüt Alan') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                    {{ Form::text('brütAlan',$apartment->gross_area.' m2',array('class'=>'form-control','id'=>'brütAlan','placeholder'=>'Brüt Alan','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('tip', 'Tip') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('tip', $type_array, $apartment->type, array('id'=>'tip','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('durum', 'Durum') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, $apartment->status, array('id'=>'durum','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                {{ Form::label('odaSayısı', 'Oda Sayısı') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('odaSayısı', $room_array, $apartment->room, array('id'=>'odaSayısı','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('cephe', 'Cephe') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('cephe', $front_array, $apartment->front, array('id'=>'cephe','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('önManzarası', 'Ön Manzarası') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('önManzarası', $view_array, $apartment->front_view, array('id'=>'önManzarası','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('arkaManzarası', 'Arka Manzarası') }}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('arkaManzarası', $view_array, $apartment->back_view, array('id'=>'arkaManzarası','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-lg btn-info btn-block" href="{{ route('apartment.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Konut Kat Planları</h1></div>
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
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Konut Resimleri</h1></div>
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
                    <div class="panel-heading"><h1>Bu Konut İçin Verilen Teklifleri Görüntüle</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-crm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Müşteri</th>
                                    <th>Konut</th>
                                    <th>Oluşturan</th>
                                    <th>Geçerlilik Tarihi</th>
                                    <th>Oluşturma Zamanı</th>
                                    <th class="col-sm-1">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($offers as $offer)
                                    <?php
                                    $customer = Customer::find($offer->customer_id);
                                    $apartment = Apartment::find($offer->apartment_id);
                                    $building = Building::find($apartment->building_id);
                                    $user = User::find($offer->creator_id);
                                    ?>
                                    <tr>
                                        <th scope="row">{{ $offer->id }}</th>
                                        <td>{{ $customer->first_name }} <b>{{ $customer->last_name }}</b></td>
                                        <td>{{ $building->title }} > {{ $apartment->number }}</td>
                                        <td>{{ $user->first_name }} <b>{{ $user->last_name }}</b></td>
                                        <td>{{ Carbon::parse($offer->start_date)->formatLocalized('%d/%m/%Y') }} - {{ Carbon::parse($offer->finish_date)->formatLocalized('%d/%m/%Y') }}</td>
                                        <td>{{ Carbon::parse($offer->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-justified" role="group">
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn btn-xs btn-info" href="{{ route('pdf.offer.show', $offer->id) }}" role="button"><span class="fa fa-file-pdf-o" aria-hidden="true"></span></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Hızlı Satış Rakamları</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="active">KDV Hariç Temel Fiyat</th>
                                        <th class="active">12% Toplu Satış İndirimli Fiyat</th>
                                        <th class="warning">10% Peşin</th>
                                        <th class="warning">Vade/60 Ay</th>
                                        <th class="info">15% Peşin</th>
                                        <th class="info">Vade/72 Ay</th>
                                        <th class="warning">20% Peşin</th>
                                        <th class="warning">Vade/84 Ay</th>
                                        <th class="info">25% Peşin</th>
                                        <th class="info">Vade/96 Ay</th>
                                        <th class="warning">30% Peşin</th>
                                        <th class="warning">Vade/120 Ay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="active">{{ number_format($apartment->price, 2, ',', '.') }} ₺</td><?php $sales_price = $apartment->price-($apartment->price*0.12);  ?>
                                        <td class="active">{{ number_format($sales_price, 2, ',', '.') }} ₺</td>
                                        <td class="warning">{{ number_format($sales_price*0.1, 2, ',', '.') }} ₺</td>
                                        <td class="warning">{{ number_format(($sales_price-($sales_price*0.1))/60, 2, ',', '.') }} ₺</td>
                                        <td class="info">{{ number_format($sales_price*0.15, 2, ',', '.') }} ₺</td>
                                        <td class="info">{{ number_format(($sales_price-($sales_price*0.15))/72, 2, ',', '.') }} ₺</td>
                                        <td class="warning">{{ number_format($sales_price*0.2, 2, ',', '.') }} ₺</td>
                                        <td class="warning">{{ number_format(($sales_price-($sales_price*0.2))/84, 2, ',', '.') }} ₺</td>
                                        <td class="info">{{ number_format($sales_price*0.25, 2, ',', '.') }} ₺</td>
                                        <td class="info">{{ number_format(($sales_price-($sales_price*0.25))/96, 2, ',', '.') }} ₺</td>
                                        <td class="warning">{{ number_format($sales_price*0.3, 2, ',', '.') }} ₺</td>
                                        <td class="warning">{{ number_format(($sales_price-($sales_price*0.3))/120, 2, ',', '.') }} ₺</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection