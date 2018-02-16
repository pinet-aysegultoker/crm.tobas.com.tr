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
                        {{ Form::open(array('url'=>route('customer.detail.create.post'),'method'=>'post','autocomplete'=>'off')) }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('baslik', 'Başlık')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    {{ Form::text('baslik',Input::old('baslik'),array('class'=>'form-control','id'=>'baslik','placeholder'=>'Başlık')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('tip', 'Tip')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    <select class="col-md-4" name="detail_type" onchange="validate()" id="tip-maske">
                                        <option value="" disabled selected>Tip</option>
                                        <option value="select">Select</option>
                                        <option value="text">Text</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('icerik', 'İçerik')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    <select name="tags[]" id="tags" class="form-control" multiple data-fv-field="tags"></select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{ Form::label('mask', 'Maske')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                    {{ Form::text('mask',Input::old('mask'),array('class'=>'form-control','id'=>'mask','placeholder'=>'Maske')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    <select class="col-md-4" name="durum">
                                        <option value="active">Aktif</option>
                                        <option value="passive">Pasif</option>
                                    </select>
                                </div>
                            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: "İçerik"
            });
        });
    </script>
    <script>
        document.getElementById('tags').disabled = true;
        document.getElementById('mask').disabled = true;
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