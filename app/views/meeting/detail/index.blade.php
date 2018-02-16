@extends('layouts.common')
@section('title', 'Bir Görüşmeyi Görüntüle')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1><i class="fa fa-comments-o" aria-hidden="true"></i> Bir Görüşmeyi Görüntüle</h1></div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>'#','method'=>'post','autocomplete'=>'off')) }}
                        {{ Form::hidden('id',$id) }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('görüşmeKodu', 'Görüşme Kodu')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-id-badge" aria-hidden="true"></i></span>
                                    {{ Form::text('görüşmeKodu',$meeting->id.'-'.Carbon::parse($meeting->created_at)->formatLocalized('%d%m%Y-%H%M%S'),array('class'=>'form-control','id'=>'görüşmeKodu','placeholder'=>'Görüşme Kodu','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('başlangıçZamanı', 'Başlangıç Zamanı')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                    {{ Form::text('başlangıçZamanı',Carbon::parse($meeting->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S'),array('class'=>'form-control','id'=>'başlangıçZamanı','placeholder'=>'Başlangıç Zamanı','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('sonGüncellemeZamanı', 'Son Güncelleme Zamanı')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                    {{ Form::text('sonGüncellemeZamanı',Carbon::parse($meeting->updated_at)->formatLocalized('%d/%m/%Y %H:%M:%S'),array('class'=>'form-control','id'=>'sonGüncellemeZamanı','placeholder'=>'Son Güncelleme Zamanı','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('isim', 'İsim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    {{ Form::text('isim',$user->first_name,array('class'=>'form-control','id'=>'görüşmeKodu','placeholder'=>'İsim','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('soyisim', 'Soyisim')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    {{ Form::text('soyisim',$user->last_name,array('class'=>'form-control','id'=>'soyisim','placeholder'=>'Soyisim','disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('durum', 'Durum')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
                                    {{ Form::select('durum', $status_array, $meeting->status, array('id'=>'durum','class'=>'form-control','disabled'=>'disabled')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-lg btn-info btn-block" href="{{ route('customer.show', $user->id) }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="panel-body">
                        @foreach($meeting_details as $meeting_detail)
                            <?php
                                $creator = User::find($meeting_detail->creator_id);
                            ?>
                                <div class="comments">
                                    <div class="comments-head text-right">
                                         <b>Temsilci:</b> {{ $creator->first_name . ' ' . $creator->last_name }} | <b>Güncelleme:</b> {{ Carbon::parse($meeting_detail->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }} | <b>Görüşme Kodu:</b> <i>{{ $meeting_detail->id }}-{{Carbon::parse($meeting_detail->created_at)->formatLocalized('%d%m%Y-%H%M%S')}}</i>
                                    </div>
                                    <div class="comments-body">
                                        {{{ $meeting_detail->details }}}
                                    </div>
                                </div>
                        @endforeach
                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('url'=>route('meeting.detail.create.post'),'method'=>'post','autocomplete'=>'off')) }}
                        {{ Form::hidden('id',$meeting->id) }}
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ Form::label('görüşmeVeyaİşlemKaydı', 'Görüşme Veya İşlem Detayları')}}
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    {{ Form::textarea('görüşmeVeyaİşlemKaydı',Input::old('görüşmeVeyaİşlemKaydı'),array('class'=>'form-control','id'=>'görüşmeVeyaİşlemKaydı','placeholder'=>'Görüşme Veya İşlem Detayları')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::submit('Güncellemeyi Ekle',array('class'=>'btn btn-lg btn-success btn-block')) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection