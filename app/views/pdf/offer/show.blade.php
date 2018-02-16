@extends('layouts.pdf')
@section('content')
    <?php
        $offer = Offer::find($id);
        $customer = Customer::find($offer->customer_id);
        $user = User::find($offer->creator_id);
        $apartment = Apartment::find($offer->apartment_id);
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
                    <h3 class="text-center pdf-title">KuzeyKent Konut Teklif Formu</h3>
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
                    <i>{{ $project->title }}</i> > <i>{{ $building->title }}</i> > <b>{{ $apartment->number }}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 pdf-border text-right">
                    <b>Konu:</b>
                </div>
                <div class="col-xs-4 pdf-border">
                    {{ $offer->subject }}
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Teklif Süresi:</b>
                </div>
                <div class="col-xs-4 pdf-border">
                    {{ Carbon::parse($offer->start_date)->formatLocalized('%d/%m/%Y') }} - {{ Carbon::parse($offer->finish_date)->formatLocalized('%d/%m/%Y') }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 pdf-border text-right">
                    <b>Teklifi Veren:</b>
                </div>
                <div class="col-xs-4 pdf-border">
                    {{ $user->first_name }} {{ $user->last_name }}
                </div>
                <div class="col-xs-2 pdf-border text-right">
                    <b>Teklif Kodu:</b>
                </div>
                <div class="col-xs-4 pdf-border">
                    <i>{{ $offer->id }}-{{ Carbon::parse($offer->created_at)->formatLocalized('%d%m%Y-%H%M%S') }}-{{ $user->id }}</i>
                </div>
            </div>
        </div>
    </div>
    <div class="pdf-content">
        <div class="container-fluid">
            <div class="row">
                <div class="row">
                    <div class="col-xs-8">
                        <h4>1. Konut Bilgileri</h4>
                    </div>
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
                    {{ $apartment->title }} | <b>LOT:</b> <i>{{ $apartment->lot }}</i>
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
                $kdv_haric_fiyat = $offer->price;
                $indirimli_fiyat = $offer->price-$offer->discount;
                $kdv_bedeli = $indirimli_fiyat*0.01;
            ?>
            <div class="row">
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
                <div class="col-xs-2 pdf-border text-right">
                    <b>KDV Bedeli (1%):</b>
                </div>
                <div class="col-xs-2 pdf-border">
                    {{ number_format($kdv_bedeli, 2, ',', '.') }} TL
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
                    <h4>2. Kat Planı</h4>
                </div>
            </div>
            <div class="row">
                <?php
                    $kat_planlari = File::allFiles(base_path('public/files/building/'.$building->id.'/kat-planlari'));
                    $kat_planlari_count = count($kat_planlari);
                ?>
                @if(File::exists((string)$kat_planlari[0]))
                    @foreach ($kat_planlari as $kat_plani)
                        @if ($kat_planlari_count > 1)
                            <div class="col-xs-6">
                                <img src="{{ (string)$kat_plani }}" class="img-responsive margin-top-5" />
                            </div>
                        @else
                            <div class="col-xs-12">
                                <img src="{{ (string)$kat_plani }}" class="img-responsive margin-top-5" />
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <img src="{{ base_path('public/assets/images/no-image.jpg') }}" class="img-responsive" />
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="pdf-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h4>3. Konut Resimleri</h4>
                </div>
            </div>
            <div class="row">
                <?php
                    $resimler = File::allFiles(base_path('public/files/building/'.$building->id.'/resimler'));
                    $resimler_count = count($resimler);
                ?>
                @if(File::exists((string)$resimler[0]))
                    @foreach ($resimler as $resim)
                        @if ($resimler_count > 1)
                            <div class="col-xs-6">
                                <img src="{{ (string)$resim }}" class="img-responsive margin-top-5" />
                            </div>
                        @else
                            <div class="col-xs-12">
                                <img src="{{ (string)$resim }}" class="img-responsive margin-top-5" />
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <img src="{{ base_path('public/assets/images/no-image.jpg') }}" class="img-responsive" />
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="pdf-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h4>4. TOKİ Alternatif Ödeme Planları</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 pdf-border padding-zero">
                    <table class="table pdf-table col-xs-12">
                        <thead>
                            <tr>
                                <th class="warning">Plan</th>
                                <th class="info">Peşinat</th>
                                <th class="info">Aylık Ödeme</th>
                                <th class="info">Toplam Vade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="warning">10% Peşin / 96 Ay Vade</td>
                                <td class="info">{{ number_format($indirimli_fiyat*0.1, 2, ',', '.') }} TL</td>
                                <td class="info">{{ number_format(($indirimli_fiyat-($indirimli_fiyat*0.1))/96, 2, ',', '.') }} TL</td>
                                <td class="info">96 Ay</td>
                            </tr>
                            <tr>
                                <td class="warning">15% Peşin / 108 Ay Vade</td>
                                <td class="info">{{ number_format($indirimli_fiyat*0.15, 2, ',', '.') }} TL</td>
                                <td class="info">{{ number_format(($indirimli_fiyat-($indirimli_fiyat*0.15))/108, 2, ',', '.') }} TL</td>
                                <td class="info">108 Ay</td>
                            </tr>
                            <tr>
                                <td class="warning">25% Peşin / 120 Ay Vade</td>
                                <td class="info">{{ number_format($indirimli_fiyat*0.25, 2, ',', '.') }} TL</td>
                                <td class="info">{{ number_format(($indirimli_fiyat-($indirimli_fiyat*0.25))/120, 2, ',', '.') }} TL</td>
                                <td class="info">120 Ay</td>
                            </tr>
                        <tr >
                            <td colspan="4" class="success text-center"><b>Ek peşinat verilebilmektedir.</b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pdf-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h4>5. Teklif Onayı</h4>
                    <hr />
                    <p>Teklifinizi onaylamak için aşağıdaki bilgileri doldurup tarafımıza iletiniz.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-2 text-left">
                            <b>Onaylayan</b>
                        </div>
                        <div class="col-xs-2">
                            :
                        </div>
                        <div class="col-xs-2 text-left">
                            <b>Tarih</b>
                        </div>
                        <div class="col-xs-2">
                            :
                        </div>
                        <div class="col-xs-2 text-left">
                            <b>İmza</b>
                        </div>
                        <div class="col-xs-2">
                            :
                        </div>
                    </div>
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