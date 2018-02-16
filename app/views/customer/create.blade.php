@extends('layouts.common')
@section('title', 'Yeni Bir Müşteri Oluştur')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-plus" aria-hidden="true"></i> Yeni Bir Müşteri Oluştur</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('customer.create.post'),'method'=>'post','autocomplete'=>'off')) }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('isim', 'İsim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('isim',Input::old('isim'),array('class'=>'form-control form-uppercase','id'=>'isim','placeholder'=>'İsim')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('soyisim', 'Soyisim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('soyisim',Input::old('soyisim'),array('class'=>'form-control form-uppercase','id'=>'soyisim','placeholder'=>'Soyisim')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('müşteriGrubu', 'Müşteri Grubu')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                    {{ Form::select('müşteriGrubu', $groups_array, Input::old('müşteriGrubu'), array('id'=>'müşteriGrubu','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, Input::old('durum'), array('id'=>'durum','class'=>'form-control')) }}
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            @foreach($customer_details as $customer_detail)
                                <div class="form-group col-md-3">
                                    {{ Form::label($customer_detail->title_id, $customer_detail->title) }}
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        @if($customer_detail->type=='select')
                                            <?php $type_array = array(''=>'Belirtilmemiş')+ unserialize(base64_decode($customer_detail->type_array)); ?>
                                            {{ Form::select($customer_detail->title_id, $type_array, Input::old($customer_detail->title_id), array('id'=>$customer_detail->title_id,'class'=>'form-control')) }}
                                        @elseif($customer_detail->type=='text')
                                            @if(empty($customer_detail->mask) || !isset($customer_detail->mask))
                                                {{ Form::text($customer_detail->title_id,Input::old($customer_detail->title_id),array('class'=>'form-control','id'=>$customer_detail->title_id,'placeholder'=>$customer_detail->title)) }}
                                            @else
                                                {{ Form::text($customer_detail->title_id,Input::old($customer_detail->title_id),array('class'=>'form-control','id'=>$customer_detail->title_id,'placeholder'=>$customer_detail->title,'data-inputmask'=>"'mask':'".$customer_detail->mask."'")) }}
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::submit('Oluştur',array('class'=>'btn btn-lg btn-success btn-block')) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection