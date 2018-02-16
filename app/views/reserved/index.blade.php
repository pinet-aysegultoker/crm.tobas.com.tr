@extends('layouts.common')
@section('title', 'Rezerveleri Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Rezerve Görüntüle</h1></div>
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
                                @foreach($reserveds as $reserved)
                                    <?php
                                    $customer = Customer::find($reserved->customer_id);
                                    $apartment = Apartment::find($reserved->apartment_id);
                                    $building = Building::find($apartment->building_id);
                                    $project = Project::find($building->project_id);
                                    $user = User::find($reserved->creator_id);
                                    ?>
                                    <tr>
                                        <th scope="row">{{ $reserved->id }}</th>
                                        <td>{{ $customer->first_name }} <b>{{ $customer->last_name }}</b></td>
                                        <td>{{$project->title}} > {{ $building->title }} > {{ $apartment->number }}</td>
                                        <td>{{ $user->first_name }} <b>{{ $user->last_name }}</b></td>
                                        <td>{{ Carbon::parse($reserved->start_date)->formatLocalized('%d/%m/%Y') }} - {{ Carbon::parse($reserved->finish_date)->formatLocalized('%d/%m/%Y') }}</td>
                                        <td>{{ Carbon::parse($reserved->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-justified" role="group">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#removeModal" data-customer="{{$reserved->customer_id}}" data-apartment="{{$reserved->apartment_id}}" data-reserved="{{$reserved->id}}" data-creatorid="{{$reserved->creator_id}}" data-apartmentid="{{$reserved->apartment_id}}" data-isim="{{$customer->first_name}} {{$customer->last_name}}">
                                                        <span class="fa fa-check-square-o" aria-hidden="true">Kaldır</span>
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
                    <div class="panel-footer">
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-xl btn-success" href="{{ route('reserved.create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Rezerve Oluştur</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(array('url'=>route('reserved.remove.post'),'method'=>'post','autocomplete'=>'off')) }}
                {{ Form::hidden('apartment_id', '', array('id' => 'apartment_id')) }}
                {{ Form::hidden('reserved_id', '', array('id' => 'reserved_id')) }}
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

                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            {{ Form::submit('Rezerveyi Kaldır', array('class' => 'btn btn-success btn-lg btn-block')) }}
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
            var reserved_id = button.data('reserved');
            var apartment_id = button.data('apartment');
            var group = button.data('group');
            var first_name = button.data('isim');
            modal.find('.modal-title').text('Bir Rezerveyi Kaldır-> ' + first_name );
            $('#reserved_id').val(reserved_id);
            $('#apartment_id').val(apartment_id);
            modal.find('.modal-body #müşteriGrubu').val(group);
            modal.find('.modal-body #isim').val(first_name);
        })
    </script>
@endsection