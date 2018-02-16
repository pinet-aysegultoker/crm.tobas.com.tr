@extends('layouts.common')
@section('title', 'Çağrı Merkezi')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Çağrı Merkezi</h1></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-crm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Çağrı No</th>
                                    <th>Kurum Adı</th>
                                    <th>Çağrı Merkezini Arayan Kişi</th>
                                    <th>Bildirim Durumu</th>
                                    <th>Müşteri Talebi</th>
                                    <th>Bildirim Kanalı</th>
                                    <th>Dönüş Yapan Personel</th>
                                    <th>İşlem Zamanı</th>
                                    <th class="col-sm-1">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($calls as $call)
                                    <tr @if($call->is_active === 1)class="success"@endif>
                                        <th scope="row"></th>
                                        <td>{{$call->id}}</td>
                                        <td>{{$call->KurumAdi}}</td>
                                        <td>{{$call->CagriMerkeziniArayanKisi}}</td>
                                        <td> {{$call->BildirimDurumu}}</td>
                                        <td> {{$call->AgacYapisi}}</td>
                                        <td> {{$call->BildirimKanali}}</td>
                                        <td>{{$call->staff}}</td>
                                        <td>{{ Carbon::parse($call->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
                                        <td>

                                            <button type="button"
                                                    @if($call->is_active === 1) class="btn btn-group btn-group-justified disabled"
                                                    @else class="btn btn-group btn-group-justified call-center-status"
                                                    @endif data-key="{{$call->id}}">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <div class="btn-group btn-group-justified" role="group">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-xs btn-primary"
                                                            data-toggle="modal" data-target="#logModal"
                                                            data-kurumadi="{{$call->KurumAdi}}"
                                                            data-bildirimkanali="{{$call->BildirimKanali}}"
                                                            data-gelenbildirim="{{$call->GelenBildirim}}"
                                                            data-talebeyapilanislem="{{$call->TalebeYapilanİslem}}"
                                                            data-bildirimdurumu="{{$call->BildirimDurumu}}"
                                                            data-agacyapisi="{{$call->AgacYapisi}}"
                                                            data-cagrimerkeziniarayankisi="{{$call->CagriMerkeziniArayanKisi}}"
                                                            data-cagrimerkeziniarayannumara="{{$call->CagriMerkeziniArayanNumara}}"
                                                            data-cagrimerkezininarandigiil="{{$call->CagriMerkezininArandigiIl}}"
                                                            data-yapiadi="{{$call->YapiAdi}}"
                                                            data-createdat="{{$call->created_at}}"
                                                    >
                                                        <span class="fa fa-eye" aria-hidden="true"></span>
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
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="logModal" tabindex="-1" role="dialog" aria-labelledby="logModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Bir Sistem Kullanıcısını Sil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('kurumAdi', 'Kurum Adı')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                {{ Form::text('kurumAdi',null,array('class'=>'form-control','id'=>'kurumAdi','placeholder'=>'Kurum Adı','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('bildirimKanali', 'Bildirim Kanalı')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('bildirimKanali',null,array('class'=>'form-control','id'=>'bildirimKanali','placeholder'=>'Bildirim Kanalı','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('gelenBildirim', 'Gelen Bildirim')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::textarea('gelenBildirim',null,array('class'=>'form-control','id'=>'gelenBildirim','placeholder'=>'Gelen Bildirim','disabled'=>'disabled', 'style' => 'height:300px')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('talebeYapilanIslem', 'Talebe Yapılan İşlem')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('talebeYapilanIslem',null,array('class'=>'form-control','id'=>'talebeYapilanIslem','placeholder'=>'Talebe Yapılan İşlem','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('bildirimDurumu', 'Bildirim Durumu')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('bildirimDurumu',null,array('class'=>'form-control','id'=>'bildirimDurumu','placeholder'=>'Bildirim Durumu','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('agacYapisi', 'Bildirim Durumu')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('agacYapisi',null,array('class'=>'form-control','id'=>'agacYapisi','placeholder'=>'Ağaç Yapısı','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('cagriMerkeziniArayanKisi', 'Çağrı Merkezini Arayan Kişi')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('cagriMerkeziniArayanKisi',null,array('class'=>'form-control','id'=>'cagriMerkeziniArayanKisi','placeholder'=>'Çağrı Merkezini Arayan Kişi','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('cagriMerkeziniArayanNumara', 'Çağrı Merkezini Arayan Numara')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('cagriMerkeziniArayanNumara',null,array('class'=>'form-control','id'=>'cagriMerkeziniArayanNumara','placeholder'=>'Çağrı Merkezini Arayan Numara','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('cagriMerkezininArandigiIl', 'Çağrı Merkezinin Arandığı İl')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('cagriMerkezininArandigiIl',null,array('class'=>'form-control','id'=>'cagriMerkezininArandigiIl','placeholder'=>'Çağrı Merkezinin Arandığı İl','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{ Form::label('yapiAdi', 'Yapı Adı')}}
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                {{ Form::text('yapiAdi',null,array('class'=>'form-control','id'=>'yapiAdi','placeholder'=>'Yapı Adı','disabled'=>'disabled')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-lg" data-dismiss="modal"><i
                                        class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.call-center-status').click(function () {
                var id = $(this).data('key');
                var staff = '{{Session::get('staff')}}';
                $.ajax({
                    url: '{{route('status.index')}}',
                    method: 'POST',
                    data: {id: id, staff: staff},
                    success: function (data) {
                        console.log(data);
                        location.reload()
                    },
                    error: function (jqXhr) {
                        console.log(jqXhr)
                    }
                });
            });
            $('#logModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var modal = $(this);
                var kurumadi = button.data('kurumadi');
                var bildirimkanali = button.data('bildirimkanali');
                var gelenbildirim = button.data('gelenbildirim');
                var talebeyapilanislem = button.data('talebeyapilanislem');
                var bildirimdurumu = button.data('bildirimdurumu');
                var agacyapisi = button.data('agacyapisi');
                var cagrimerkeziniarayankisi = button.data('cagrimerkeziniarayankisi');
                var cagrimerkeziniarayannumara = button.data('cagrimerkeziniarayannumara');
                var cagrimerkezininarandigiil = button.data('cagrimerkezininarandigiil');
                var yapiadi = button.data('yapiadi');
                modal.find('.modal-title').text('Ayrıntılar');
                modal.find('.modal-body #kurumAdi').val(kurumadi);
                modal.find('.modal-body #bildirimKanali').val(bildirimkanali);
                modal.find('.modal-body #gelenBildirim').val(gelenbildirim);
                modal.find('.modal-body #talebeYapilanIslem').val(talebeyapilanislem);
                modal.find('.modal-body #bildirimDurumu').val(bildirimdurumu);
                modal.find('.modal-body #agacYapisi').val(agacyapisi);
                modal.find('.modal-body #cagriMerkeziniArayanKisi').val(cagrimerkeziniarayankisi);
                modal.find('.modal-body #cagriMerkeziniArayanNumara').val(cagrimerkeziniarayannumara);
                modal.find('.modal-body #cagriMerkezininArandigiIl').val(cagrimerkezininarandigiil);
                modal.find('.modal-body #yapiAdi').val(yapiadi);
            })
        });

    </script>
@endsection