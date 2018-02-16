@extends('layouts.common')
@section('title', 'Teklifleri Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Ödeme Planlarını Görüntüle</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-crm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Müşteri</th>
                                        <th>Konut</th>
                                        <th>Peşinat (%)</th>
                                        <th>Oluşturan</th>
                                        <th>Oluşturma Zamanı</th>
                                        <th class="col-sm-1">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($payment_plans as $payment_plan)
                                    <?php
                                    $customer = Customer::find($payment_plan->customer_id);
                                    $apartment = Apartment::find($payment_plan->apartment_id);
                                    $building = Building::find($apartment->building_id);
                                    $user = User::find($payment_plan->creator_id);
                                    ?>
                                    <tr>
                                        <th scope="row">{{ $payment_plan->id }}</th>
                                        <td>{{ $customer->first_name }} <b>{{ $customer->last_name }}</b></td>
                                        <td>{{ Project::where('id',$building->project_id)->pluck('title') }} > {{ $building->title }} > {{$apartment->number}}</td>
                                        <td>{{ $payment_plan->advance }}%</td>
                                        <td>{{ $user->first_name }} <b>{{ $user->last_name }}</b></td>
                                        <td>{{ Carbon::parse($payment_plan->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-justified" role="group">
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn btn-xs btn-info" href="{{ route('pdf.payment-plan.show', $payment_plan->id) }}" role="button"><span class="fa fa-file-pdf-o" aria-hidden="true"></span></a>
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
                                <a type="button" class="btn btn-xl btn-success" href="{{ route('payment-plan.create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Ödeme Planı Oluştur</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection