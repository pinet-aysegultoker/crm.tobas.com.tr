@extends('layouts.pdf')
@section('content')
<?php
    $payment_plan = PaymentPlan::find($id);
    $customer = Customer::find($payment_plan->customer_id);
    $user = User::find($payment_plan->creator_id);
    $apartment = Apartment::find($payment_plan->apartment_id);
    $building = Building::find($apartment->building_id);
    $project = Project::find($building->project_id);
?>
    <div class="pdf-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-2">
                    <img src="{{ base_path('public/assets/images/pdf-logo.png') }}" height="64px" />
                </div>
                <div class="col-xs-8">
                    <h3 class="text-center pdf-title">KuzeyKent Konut Ödeme Planı</h3>
                </div>
                <div class="col-xs-2">
                    {{ QrCode::size(96)->generate(Request::url()) }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 pdf-border text-right">
                    <b>İsim Soyisim:</b>
                </div>
                <div class="col-xs-4 pdf-border">
                    {{ $customer->first_name }} {{ $customer->last_name }}
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Konut:</b>
                </div>
                <div class="col-xs-4 pdf-border">
                    <i>{{ $project->title }}</i> > <i>{{ $building->title }}</i> > <b>{{ $apartment->number }}</b> | <b>LOT:</b> <i>{{ $apartment->lot }}</i>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 pdf-border text-right">
                    <b>Planı Veren:</b>
                </div>
                <div class="col-xs-4 pdf-border">
                    {{ $user->first_name }} {{ $user->last_name }}
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Plan Kodu:</b>
                </div>
                <div class="col-xs-4 pdf-border">
                    <i>{{ $payment_plan->id }}-{{ Carbon::parse($payment_plan->created_at)->formatLocalized('%d%m%Y-%H%M%S') }}-{{ $user->id }}</i>
                </div>
            </div>
        </div>
    </div>
    <div class="pdf-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h4>1. Konut Bilgileri</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 pdf-border text-right">
                    <b>Proje Adı:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ $project->title }}
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Blok Adı:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ $building->title }}
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Konut Adı:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ $apartment->title }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 pdf-border text-right">
                    <b>Kat:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ $apartment->floor }}
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Numara:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ $apartment->number }}
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>B.B. Kodu:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ $apartment->bb_code }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 pdf-border text-right">
                    <b>Brüt Alan:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ $apartment->gross_area }} m<sup>2</sup>
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Net Alan:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ $apartment->net_area }} m<sup>2</sup>
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Tip:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ Lang::get('common.'.$apartment->type) }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 pdf-border text-right">
                    <b>Oda Sayısı:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ $apartment->room }}
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Cephe:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ $apartment->front }}
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Manzara(Ön/Arka):</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ Lang::get('common.'.$apartment->front_view) }} / {{ Lang::get('common.'.$apartment->back_view) }}
                </div>
            </div>
            <?php
                $kdv_haric_fiyat = $payment_plan->price;
                $indirimli_fiyat = $payment_plan->price-$payment_plan->discount;
                $pesinat_yuzde = $payment_plan->advance;
                if ($apartment->net_area >= 150) {
                    $kdv_bedeli = $indirimli_fiyat*0.18;
                } else {
                    $kdv_bedeli = $indirimli_fiyat*0.01;
                }
                $son_fiyat = $indirimli_fiyat + $kdv_bedeli;
            ?>
            <div class="row">
                @if($payment_plan->discount==0)
                    <div class="col-xs-6 pdf-border text-right">
                        <b>KDV Hariç Fiyat:</b>
                    </div>
                    <div class="col-xs-2 pdf-border">
                        {{ number_format($kdv_haric_fiyat, 2, ',', '.') }} TL
                    </div>
                @else
                    <div class="col-xs-2 pdf-border text-right">
                        <b>KDV Hariç Fiyat:</b>
                    </div>
                    <div class="col-xs-2 pdf-border">
                        {{ number_format($kdv_haric_fiyat, 2, ',', '.') }} TL
                    </div>
                    <div class="col-xs-2 pdf-border text-right">
                        <b>İndirimli Fiyat:</b>
                    </div>
                    <div class="col-xs-2 pdf-border">
                        {{ number_format($indirimli_fiyat, 2, ',', '.') }} TL
                    </div>
                @endif
                <div class="col-xs-2 pdf-border text-right">
                    @if($apartment->net_area >= 150)
                        <b>KDV Bedeli (18%):</b>
                    @else
                        <b>KDV Bedeli (1%):</b>
                    @endif
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ number_format($kdv_bedeli, 2, ',', '.') }} TL
                </div>
            </div>
            <div class="row">
                <div class="col-xs-10 pdf-border text-right">
                    <b>Toplam Fiyat:</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ number_format($son_fiyat, 2, ',', '.') }} TL
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 pdf-border margin-top-20 padding-top-5">
                    <ul>

                        @if($apartment->net_area>=150)
                            <li></li>
                        @else
                            <li>KDV tutarı Net kullanım alanı 150 m2’ nin altındaki konutlarda %1’dir.</li>
                        @endif
                        <li>KDV tutarı konut teslimi aşamasında, sözleşme yapılan banka tarafından peşin olarak tahsil edilecektir.</li>
                        <li>KDV tutarı konut teslimi aşamasında, sözleşme yapılan banka tarafından peşin olarak tahsil edilecektir.</li>

                        <li>Açık artırma Teminat bedeli 10.000 TL dir. Teminat bedeli T. Halk Bankası A.Ş.’nin tüm şubelerine yatırılabilmektedir.</li>
                        <li>Satış işlemleri, T.Halk Bankası A.Ş. Ankara MithatPaşa Şubesi aracılığıyla yapılacaktır.</li>
                        <li>Konut satış bedellerine, KDV, Banka Komisyonu vb. dâhil edilmemiştir.</li>
                        <li>Borç bakiyesi ve aylık taksitler her yılın Ocak ve Temmuz aylarında olmak üzere yılda iki kez, bir önceki 6 aylık dönemdeki memur maaş artış oranı, dikkate alınarak İdarece belirlenecek oranda artırılacaktır.</li>
                        <li>Kat/Daire Planları ve resimler bilgilendirme amaçlıdır. Proje konut büyüklükleri ve mahal listelerinde bir çelişki olduğu takdirde, uygulama projesi ve sözleşmedeki bilgiler esastır.</li>
                        <li>Konut alıcıları Sözleşmeden doğan haklarını üçüncü şahsa devir edebileceklerdir.</li>
                        <li>İdare gerek görmesi halinde satışa sunulan konutlardan bir kısmını veya tamamını satıştan çekmeye yetkilidir.</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="pdf-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h4>2. Size Özel Ödeme Planları</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 pdf-border padding-zero">
                    <table class="table pdf-table col-xs-12">
                        <thead>
                            <tr>
                                <th class="warning">Plan</th>
                                <th class="info">Peşinat(%{{ $pesinat_yuzde }})</th>
                                <th class="info">Aylık Ödeme</th>
                                <th class="info">Toplam Vade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="warning">{{ $pesinat_yuzde }}% Peşinat / 60 Ay Vade</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100), 2, ',', '.') }} TL</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100)/60, 2, ',', '.') }} TL</td>
                                <td class="info">60 Ay</td>
                            </tr>
                            <tr>
                                <td class="warning">{{ $pesinat_yuzde }}% Peşinat / 72 Ay Vade</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100), 2, ',', '.') }} TL</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100)/72, 2, ',', '.') }} TL</td>
                                <td class="info">72 Ay</td>
                            </tr>
                            <tr>
                                <td class="warning">{{ $pesinat_yuzde }}% Peşinat / 84 Ay Vade</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100), 2, ',', '.') }} TL</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100)/84, 2, ',', '.') }} TL</td>
                                <td class="info">84 Ay</td>
                            </tr>
                            <tr>
                                <td class="warning">{{ $pesinat_yuzde }}% Peşinat / 96 Ay Vade</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100), 2, ',', '.') }} TL</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100)/96, 2, ',', '.') }} TL</td>
                                <td class="info">96 Ay</td>
                            </tr>
                            <tr>
                                <td class="warning">{{ $pesinat_yuzde }}% Peşinat / 108 Ay Vade</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100), 2, ',', '.') }} TL</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100)/108, 2, ',', '.') }} TL</td>
                                <td class="info">96 Ay</td>
                            </tr>
                            <tr>
                                <td class="warning">{{ $pesinat_yuzde }}% Peşinat / 120 Ay Vade</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100), 2, ',', '.') }} TL</td>
                                <td class="info">{{ number_format(($indirimli_fiyat*$pesinat_yuzde/100)/120, 2, ',', '.') }} TL</td>
                                <td class="info">120 Ay</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pdf-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <p class="text-center"><b><i class="fa fa-location-arrow" aria-hidden="true"></i> Yeşiltepe Mh. Kuzey Ankara 2. Etap Rekreasyon Alanı Küme Evleri No:9  Keçiören / Ankara<br /><i class="fa fa-phone" aria-hidden="true"></i> (850) 305 5353 | <i class="fa fa-envelope" aria-hidden="true"></i> info@kuzeykent.com.tr | <i class="fa fa-internet-explorer" aria-hidden="true"></i>kuzeykent.com.tr</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection