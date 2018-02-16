@extends('layouts.common')
@section('title', 'Konutları Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-eye" aria-hidden="true"></i> Konutları Görüntüle</h1></div>
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
                                                        <a type="button" class="btn btn-xs btn-info" href="{{ route('apartment.show', $apartment->id) }}" target="_blank" role="button"><span class="fa fa-eye" aria-hidden="true"></span></a>
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
                    <div class="panel-footer">
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-xl btn-success" href="{{ route('apartment.create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Daire Oluştur</a>
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
                {{ Form::open(array('url'=>route('apartment.remove.post'),'method'=>'post','autocomplete'=>'off')) }}
                {{ Form::hidden('id', '', array('id' => 'id')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Bir Daireyi Sil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('daire', 'Daire') }}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                                {{ Form::text('daire',null,array('class'=>'form-control','id'=>'daire','placeholder'=>'Daire','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('blok', 'Blok') }}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                                {{ Form::text('blok',null,array('class'=>'form-control','id'=>'blok','placeholder'=>'Blok','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            {{ Form::submit('Sil', array('class' => 'btn btn-danger btn-lg btn-block')) }}
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
        $('#removeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            var daire = button.data('daire');
            var blok = button.data('blok');
            modal.find('.modal-title').text('Bir Konutu Sil -> ' + daire);
            $('#id').val(id);
            modal.find('.modal-body #daire').val(daire);
            modal.find('.modal-body #blok').val(blok);
        })
    </script>
@endsection