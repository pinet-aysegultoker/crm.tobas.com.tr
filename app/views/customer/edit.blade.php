@extends('layouts.common')
@section('title', 'Bir Müşteriyi Düzenle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-pencil" aria-hidden="true"></i> Bir Müşteriyi Düzenle</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('customer.edit.post'),'method'=>'post','autocomplete'=>'off')) }}
                        {{ Form::hidden('id',$customer->id) }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('isim', 'İsim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('isim',$customer->first_name,array('class'=>'form-control','id'=>'isim','placeholder'=>'İsim')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('soyisim', 'Soyisim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('soyisim',$customer->last_name,array('class'=>'form-control','id'=>'soyisim','placeholder'=>'Soyisim')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('müşteriGrubu', 'Müşteri Grubu')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                    {{ Form::select('müşteriGrubu', $groups_array, $customer->group_id, array('id'=>'müşteriGrubu','class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, $customer->status, array('id'=>'durum','class'=>'form-control')) }}
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
                                        <?php $type_array = array(''=>'Belirtilmemiş')+ unserialize(base64_decode($customer_detail->type_array)); ?>
                                        {{ Form::select($customer_detail->title_id, $type_array, $customer_value, array('id'=>$customer_detail->title_id,'class'=>'form-control')) }}
                                    @elseif($customer_detail->type=='text')
                                        @if(empty($customer_detail->mask) || !isset($customer_detail->mask))
                                            {{ Form::text($customer_detail->title_id,$customer_value,array('class'=>'form-control','id'=>$customer_detail->title_id,'placeholder'=>$customer_detail->title)) }}
                                        @else
                                            {{ Form::text($customer_detail->title_id,$customer_value,array('class'=>'form-control','id'=>$customer_detail->title_id,'placeholder'=>$customer_detail->title,'data-inputmask'=>"'mask':'".$customer_detail->mask."'")) }}
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::submit('Düzenle',array('class'=>'btn btn-lg btn-warning btn-block')) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection