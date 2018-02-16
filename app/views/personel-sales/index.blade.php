@extends('layouts.common')
@section('title', 'Satışları Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i>Kişisel Satışları Görüntüle</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-crm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Müşteri</th>
                                    <th>Konut</th>
                                    <th>Teklif</th>
                                    <th>İşlem Tarihi</th>
                                    <th class="col-sm-1">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sales as $sale)
                                    <?php
                                    $apartment = Apartment::find($sale->apartment_id);
                                    $building = Building::find($apartment->building_id);
                                    $project = Project::find($building->project_id);
                                    $offer = Offer::find($sale->offer_id);
                                    $customer = Customer::find($offer->customer_id);
                                    $user = User::find($offer->creator_id);
                                    ?>
                                    <tr>
                                        <th scope="row">{{ $sale->id }}</th>
                                        <td><a href="{{ route('customer.show', $customer->id) }}" target="_blank">{{ $customer->first_name }} <b>{{ $customer->last_name }}</b></a></td>
                                        <td><a href="{{ route('apartment.show', $apartment->id) }}" target="_blank">{{ $project->title }} > {{ $building->title }} > {{ $apartment->number }}</a></td>
                                        <td><a href="{{ route('pdf.offer.show', $offer->id) }}">{{ $offer->id }}-{{ Carbon::parse($offer->created_at)->formatLocalized('%d%m%Y-%H%M%S') }}-{{ $user->id }}</a></td>
                                        <td>{{ Carbon::parse($sale->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-justified" role="group">
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn btn-xs btn-info" href="#" role="button"><span class="fa fa-file-pdf-o" aria-hidden="true"></span></a>
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i>Kişisel Teklifleri Görüntüle</h1></div>
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
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#removeModal" data-customer="{{$offer->customer_id}}" data-id="{{$offer->id}}" data-creatorid="{{$offer->creator_id}}" data-apartmentid="{{$offer->apartment_id}}" data-isim="{{$customer->first_name}} {{$customer->last_name}}">
                                                        <span class="fa fa-check-square-o" aria-hidden="true">Satış</span>
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
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(array('url'=>route('sales.create.post'),'method'=>'post','autocomplete'=>'off')) }}
                {{ Form::hidden('offer_id', '', array('id' => 'offer_id')) }}
                {{ Form::hidden('apartment_id', '', array('id' => 'apartment_id')) }}
                {{ Form::hidden('creator_id', '', array('id' => 'creator_id')) }}
                {{ Form::hidden('customer_id', '', array('id' => 'customer_id')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Bir Satış Gerçekleştir</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('isim', 'İsim Soyisim')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                {{ Form::text('isim',null,array('class'=>'form-control','id'=>'isim','placeholder'=>'İsim','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('aciklama', 'Açıklama')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                {{ Form::text('aciklama',null,array('class'=>'form-control','id'=>'aciklama','placeholder'=>'Açıklama')) }}
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                {{ Form::submit('Satışı Gerçekleştir', array('class' => 'btn btn-success btn-lg btn-block')) }}
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
    </div>
    <script>
        $('#removeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            var creatorid = button.data('creatorid');
            var apartmentid = button.data('apartmentid');
            var isim = button.data('isim');
            var customer = button.data('customer');
            modal.find('.modal-title').text('Bir Satışı Gerçekleştir -> ' + isim);
            $('#offer_id').val(id);
            $('#apartment_id').val(apartmentid);
            $('#creator_id').val(creatorid);
            $('#customer_id').val(customer);
            modal.find('.modal-body #isim').val(isim);
        })
    </script>
@endsection