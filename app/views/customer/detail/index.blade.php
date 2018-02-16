@extends('layouts.common')
@section('title', 'Sistem Müşteri Detay Alanları')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Sistem Müşteri Detay Alanları</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-crm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Başlık</th>
                                    <th>Tip</th>
                                    <th>İçerik</th>
                                    <th>Maske</th>
                                    <th>Durum</th>
                                    <th class="col-sm-1">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer_details as $customer_detail)
                                    <tr>
                                        <th scope="row"></th>
                                        <td>{{$customer_detail->title}}</td>
                                        <td>{{$customer_detail->type}}</td>
                                    @if($customer_detail->type=='select')
                                        <?php $type_array = array(''=>'İçerik')+ unserialize(base64_decode($customer_detail->type_array)); ?>
                                            <td>{{ Form::select($customer_detail->title_id, $type_array, Input::old($customer_detail->title_id), array('id'=>$customer_detail->title_id,'class'=>'form-control')) }}</td>
                                            <td></td>
                                        @elseif($customer_detail->type=='text')
                                            <td></td>
                                            @if(empty($customer_detail->mask) || !isset($customer_detail->mask))
                                                <td></td>
                                            @else
                                                <td>{{$customer_detail->mask}}</td>
                                            @endif
                                    @else
                                        <td></td>
                                    @endif
                                    @if($customer_detail->status == 'active')
                                        <td>Aktif</td>
                                    @else
                                        <td>Pasif</td>
                                    @endif
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a type="button" class="btn btn-xs btn-warning" href="{{route('customer.detail.edit',$customer_detail->id)}}" role="button"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#removeModal" data-id="{{ $customer_detail->id }}" data-baslik="{{ $customer_detail->title }}" data-tip="{{$customer_detail->type}}">
                                                    <span class="fa fa-trash-o" aria-hidden="true"></span>
                                                </button>
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
                                <a type="button" class="btn btn-xl btn-success" href="{{ route('customer.detail.create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Sistem Müşteri Detay Alanı Oluştur</a>
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
                {{ Form::open(array('url'=>route('customer.detail.remove'),'method'=>'post','autocomplete'=>'off')) }}
                {{ Form::hidden('id', '', array('id' => 'id')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Bir Müşteriy Detay Alanı Sil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('baslik', 'Başlık')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                {{ Form::text('baslik',null,array('class'=>'form-control','id'=>'baslik','placeholder'=>'Başlık','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('tip', 'Tip')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('tip',null,array('class'=>'form-control','id'=>'tip','placeholder'=>'Tip','disabled'=>'disabled')) }}
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
            var baslik = button.data('baslik');
            var tip = button.data('tip');
            modal.find('.modal-title').text('Bir Müşteri Detay Alanı Sil -> ' + baslik );
            $('#id').val(id);
            modal.find('.modal-body #baslik').val(baslik);
            modal.find('.modal-body #tip').val(tip);
        })
    </script>
@endsection