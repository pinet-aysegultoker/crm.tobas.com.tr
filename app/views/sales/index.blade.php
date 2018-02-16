@extends('layouts.common')
@section('title', 'Satışları Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Satışları Görüntüle</h1></div>
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
                    <div class="panel-footer">
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-xl btn-success" href="{{ route('offer.index') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Satış Belirt</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection