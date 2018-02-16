@extends('layouts.common')
@section('title', 'Yeni Bir Sistem Kullanıcısı Oluştur')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Yeni Bir Sistem Müşteri Detay Alanı Oluştur</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('customer.detail.edit.post'),'method'=>'post','autocomplete'=>'off')) }}
                        {{ Form::hidden('id',$customer_details->id) }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('baslik', 'Başlık')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    {{ Form::text('baslik',$customer_details->title,array('class'=>'form-control','id'=>'baslik','placeholder'=>'Başlık')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('tip', 'Tip')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    <select class="col-md-4" name="detail_type" onchange="validate()" id="tip-maske">
                                        <option value="" disabled selected>Tip</option>
                                        <option value="select" @if($customer_details->type=="select") selected @endif>Select</option>
                                        <option value="text" @if($customer_details->type=="text") selected @endif>Text</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('icerik', 'İçerik')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    @if($customer_details->type_array != "")
                                        <?php
                                            $type_array = unserialize(base64_decode($customer_details->type_array));
                                        ?>
                                     <select name="tags[]" id="tags" class="form-control" style='width:100%;' multiple>
                                        @foreach($type_array as $value)
                                            <option value="{{$value}}" selected>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @else
                                        <select name="tags[]" id="tags" class="form-control" multiple data-fv-field="tags"></select>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('mask', 'Maske')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('mask',$customer_details->mask,array('class'=>'form-control','id'=>'mask','placeholder'=>'Maske')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    <select class="col-md-4" name="durum">
                                        <option value="active" @if($customer_details->status=="active") selected @endif>Aktif</option>
                                        <option value="passive" @if($customer_details->status=="passive") selected @endif>Pasif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::submit('Düzenle',array('class'=>'btn btn-lg btn-success btn-block')) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: "İçerik"
            });
            $("#tags > option").prop("selected","selected"); $("#tags").trigger("change");
        });

    </script>
    <script>
        $(document).ready(function(){
             validate();
        });

        function validate()
        {
        var ddl = document.getElementById("tip-maske");
        var selectedValue = ddl.options[ddl.selectedIndex].value;
        if (selectedValue == "select")
        {
        document.getElementById('tags').disabled = false;
        document.getElementById('mask').disabled = true;
        }
        if (selectedValue == "text")
        {
        document.getElementById('mask').disabled = false;
        document.getElementById('tags').disabled = true;
        }
        }
    </script>

@endsection