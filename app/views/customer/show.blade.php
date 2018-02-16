@extends('layouts.common')
@section('title', 'Bir Müşteriyi Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Bir Müşteriyi Görüntüle</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>'#','method'=>'post','autocomplete'=>'off')) }}
                        {{ Form::hidden('id',$customer->id) }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('isim', 'İsim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('isim',$customer->first_name,array('class'=>'form-control','id'=>'isim','placeholder'=>'İsim','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('soyisim', 'Soyisim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('soyisim',$customer->last_name,array('class'=>'form-control','id'=>'soyisim','placeholder'=>'Soyisim','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('müşteriGrubu', 'Müşteri Grubu')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                    {{ Form::select('müşteriGrubu', $groups_array, $customer->group_id, array('id'=>'müşteriGrubu','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, $customer->status, array('id'=>'durum','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($customer_details as $customer_detail)
                                <?php
                                    $customer_value_count = CustomerDetailValues::where('customer_id',$customer->id)->where('type_id',$customer_detail->id)->count();
                                    if ($customer_value_count==0) {
                                        $customer_value = null;
                                    } else {
                                        $customer_value = CustomerDetailValues::where('customer_id',$customer->id)->where('type_id',$customer_detail->id)->pluck('value');
                                    }
                                ?>
                                <div class="form-group col-md-3">
                                    {{ Form::label($customer_detail->title_id, $customer_detail->title) }}
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        @if($customer_detail->type=='select')
                                            <?php $type_array =array(''=>'Belirtilmemiş')+ unserialize(base64_decode($customer_detail->type_array)); ?>
                                            {{ Form::select($customer_detail->title_id, $type_array, $customer_value, array('id'=>$customer_detail->title_id,'class'=>'form-control','disabled'=>'disabled')) }}
                                        @elseif($customer_detail->type=='text')
                                            {{ Form::text($customer_detail->title_id,$customer_value,array('class'=>'form-control','id'=>$customer_detail->title_id,'placeholder'=>$customer_detail->title,'disabled'=>'disabled')) }}
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="panel-footer">
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-xl btn-info" href="{{ route('customer.index') }}" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön</a>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-xl btn-primary" data-toggle="modal" data-target="#createModal" data-id="{{ $meeting_id }}">
                                    <i class="fa fa-bell-o" aria-hidden="true"></i> Hatırlatıcı Ekle
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                @if($meeting_id)
                                    <a type="button" class="btn btn-xl btn-success btn-block" href="{{ route('meeting.detail.index',['id'=>$meeting_id]) }}" role="button"><i class="fa fa-comments-o" aria-hidden="true"></i> Görüşmeyi Görüntüle</a>
                                @else
                                    <a type="button" class="btn btn-xl btn-success btn-block" href="{{ route('meeting.create',['id'=>$customer->id]) }}" role="button"><i class="fa fa-comments-o" aria-hidden="true"></i> Yeni Bir Görüşme Başlat</a>
                                @endif
                            </div>
                        </div>
                        <hr />
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-xl btn-warning" href="{{ route('customer.edit', $customer->id) }}" role="button"><i class="fa fa-pencil" aria-hidden="true"></i> Bilgilerini Güncelle</a>
                            </div>
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-xl btn-default" href="{{ route('offer.create') }}" role="button"><i class="fa fa-turkish-lira" aria-hidden="true"></i> Teklif Oluştur</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Müşteriye Verilen Teklifleri Görüntüle</h1></div>
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
                    <div class="panel-heading"><h1>Müşterinin Günlüğünü Görüntüle</h1></div>
                    <div class="panel-body">
                        <table class="table table-hover table-crm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>İşlenen Veri</th>
                                <th>İşlem Türü</th>
                                <th>Gerçekleştiren Kullanıcı</th>
                                <th>İşlem Zamanı</th>
                                <th class="col-sm-1">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer_logs as $log)
                                <?php
                                    $user = User::find($log->user_id);
                                    $data = SystemLogsController::logType($log->route,$log->user_id);
                                    Customer::where('id', $log->data_id)->pluck('first_name')
                                ?>
                                <tr>
                                    <th scope="row">{{ $log->id }}</th>
                                    <td>
                                        <?php
                                        echo  Customer::where('id', $log->data_id)->pluck('first_name')." <b>" .Customer::where('id', $log->data_id)->pluck('last_name') ."</b> ->". $data['type'];?>
                                    </td>
                                    <td>{{ Lang::get('common.'.$log->type) }}</td>
                                    <td>{{ $user->first_name }} <b>{{ $user->last_name }}</b></td>
                                    <td>{{ Carbon::parse($log->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-justified" role="group">
                                            <div class="btn-group" role="group">
                                                <a type="button" class="btn btn-xs btn-info" href="#" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(array('url'=>route('customer.reminder.create.post'),'method'=>'post','autocomplete'=>'off')) }}
                {{ Form::hidden('id', $customer->id, array('id' => 'id')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="createModalLabel">Bir Hatırlatıcı Ekle</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('açıklama', 'Açıklama')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                {{ Form::text('açıklama',Input::old('açıklama'),array('class'=>'form-control','id'=>'açıklama','placeholder'=>'Açıklama')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('hatırlatmaZamanı', 'Hatırlatma Zamanı')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                {{ Form::text('hatırlatmaZamanı',Input::old('hatırlatmaZamanı'),array('class'=>'form-control','id'=>'hatırlatmaZamanı','placeholder'=>'Hatırlatma Zamanı')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            {{ Form::submit('Oluştur', array('class' => 'btn btn-success btn-lg btn-block')) }}
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
    <script>
        $(function () {
            $('#hatırlatmaZamanı').datetimepicker({
                locale: 'tr',
                format: 'DD/MM/YYYY HH:mm:ss',
                minDate: moment()
            });
        });
    </script>
@endsection