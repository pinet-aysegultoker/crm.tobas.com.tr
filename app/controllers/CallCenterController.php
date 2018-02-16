<?php

class CallCenterController extends \BaseController
{

    public function index()
    {
        $calls = CallCenter::where('AgacYapisi', 'KÖK->GERİ DÖNÜŞ İSTEĞİ')
        ->orderBy('id', 'desc')
        ->get();
        return View::make('call-center.index')->with('calls', $calls);
    }

    public function store()
    {
        $inputs = Input::all();
        $rules = [];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Response::json(['status' => 'error', 'message' => 'Eksik bilgi gönderildiği için kayıt alınamadı!'], 203);
        } elseif ($validation->passes()) {

            $callcenter = CallCenter::create([
                'KurumAdi' => Input::get('KurumAdi'),
                'BildirimKanali' => Input::get('BildirimKanali'),
                'GelenBildirim' => Input::get('GelenBildirim'),
                'TalebeYapilanIslem' => Input::get('TalebeYapilanIslem'),
                'BildirimDurumu' => Input::get('BildirimDurumu'),
                'AgacYapisi' => Input::get('AgacYapisi'),
                'CagriMerkeziniArayanKisi' => Input::get('CagriMerkeziniArayanKisi'),
                'CagriMerkeziniArayanNumara' => Input::get('CagriMerkeziniArayanNumara'),
                'CagriMerkezininArandigiIl' => Input::get('CagriMerkezininArandigiIl'),
                'YapiAdi' => Input::get('YapiAdi'),
                'databir' => Input::get('Bize Nereden Ulaşıldı (Otobüs Giydirmesi, Bilboard Vb.)'),
                'dataiki' => Input::get('SMS Gönderilmesini İstiyor Mu? (Evet - Hayır)'),

            ]);
            $callcenterlog = CallCenterLog::create([
                'ip' => Request::getClientIp(),
                'result' => 'Kayıt başarıyla alındı.',
            ]);
            //SystemLogsController::add('create',$apartment->id);
            return Response::json(['status' => 'success', 'message' => 'Çağrı kaydı başarıyla kayıt edildi!'], 200);
        } else {
            App::abort(404);
        }
    }

    public function messageStatus()
    {
        $data = [
            'is_active' => 1,
            'staff' => Input::get('staff')

        ];
        CallCenter::where('id', Input::get('id'))->update($data);


    }


}
