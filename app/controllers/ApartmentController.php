<?php

use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ApartmentController extends \BaseController {

    public function index()
    {
        $apartments = Apartment::where('status', '!=', 'removed')->orderBy('id', 'asc')->get();
        return View::make('apartment.index')->with('apartments', $apartments);
    }

    public function create()
    {
        $building_array = Building::where('status', 'active')->lists('title', 'id');
        $type_array = array('' => 'Seçiniz...', 'apartment' => 'Apartman', 'duplex' => 'Dubleks', 'triplex' => 'Tripleks', 'villa' => 'Villa', 'office' => 'Ofis');
        $room_array = array('' => 'Seçiniz...', '1+1' => '1+1', '2+1' => '2+1', '3+1' => '3+1', '4+1' => '4+1', '5+1' => '5+1', '6+1' => '6+1', '7+1' => '7+1');
        $front_array = array('' => 'Seçiniz...', 'K' => 'Kuzey Cephe', 'G' => 'Güney Cephe', 'D' => 'Doğu Cephe', 'B' => 'Batı Cephe', 'KD' => 'Kuzey-Doğu Cephe', 'KB' => 'Kuzey-Batı Cephe', 'GD' => 'Güney-Doğu Cephe', 'GB' => 'Güney-Batı Cephe','KB-GD'=>'Kuzey-Batı Güney-Doğu Cephe','GB-KB'=>'Güney-Batı Kuzey-Batı Cephe','KB-KD'=>'Kuzey-Batı Kuzey-Doğu Cephe');
        $view_array = array('' => 'Seçiniz...', 'none' => 'Yok', 'building' => 'Bina', 'retaining' => 'İstinat', 'open' => 'Önü Açık', 'scenic' => 'Manzara', 'garden' => 'Bahçe', 'project' => 'Proje');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('apartment.create')->with('building_array', $building_array)->with('type_array', $type_array)->with('room_array', $room_array)->with('front_array', $front_array)->with('view_array', $view_array)->with('status_array', $status_array);
    }
    public function createPost()
    {
        $inputs = Input::all();
        $rules = [
            'blokAdı' => 'required',
            'konutAdı' => 'required|max:63',
            'kat' => 'required|max:63',
            'numara' => 'required|max:63',
            'bbKodu' => 'required|max:15',
            'netAlan' => 'required|max:10',
            'brütAlan' => 'required|max:10',
            'tip' => 'required|max:63',
            'durum' => 'required',
            'odaSayısı' => 'required|max:63',
            'cephe' => 'required|max:63',
            'detaylar' => 'max:65535',
            'kdvHariçTemelFiyat' => 'required|max:10',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $apartment = Apartment::create([
                'building_id' => Input::get('blokAdı'),
                'creator_id' => Auth::id(),
                'bb_code' => Input::get('bbKodu'),
                'title' => Input::get('konutAdı'),
                'floor' => Input::get('kat'),
                'number' => Input::get('numara'),
                'net_area' => Input::get('netAlan'),
                'gross_area' => Input::get('brütAlan'),
                'type' => Input::get('tip'),
                'room' => Input::get('odaSayısı'),
                'front' => Input::get('cephe'),
                'front_view' => Input::get('önManzarası'),
                'back_view' => Input::get('arkaManzarası'),
                'details' => Input::get('detaylar'),
                'price' => Input::get('kdvHariçTemelFiyat'),
                'status' => 'active',
            ]);
            SystemLogsController::add('create',$apartment->id);
            return Redirect::route('apartment.index')->withSuccess('Başarıyla Yeni Bir Konut Oluşturdunuz!');
        } else {
            App::abort(404);
        }
    }

    public function show($id)
    {
        $apartment = Apartment::find($id);
        $building = Building::find($apartment->building_id);
        $building_array = Building::where('status', 'active')->lists('title', 'id');
        $type_array = array('' => 'Seçiniz...', 'apartment' => 'Apartman', 'duplex' => 'Dubleks', 'triplex' => 'Tripleks', 'villa' => 'Villa', 'office' => 'Ofis');
        $room_array = array('' => 'Seçiniz...', '1+1' => '1+1', '2+1' => '2+1', '3+1' => '3+1', '4+1' => '4+1', '5+1' => '5+1', '6+1' => '6+1', '7+1' => '7+1');
        $front_array = array('' => 'Seçiniz...', 'K' => 'Kuzey Cephe', 'G' => 'Güney Cephe', 'D' => 'Doğu Cephe', 'B' => 'Batı Cephe', 'KD' => 'Kuzey-Doğu Cephe', 'KB' => 'Kuzey-Batı Cephe', 'GD' => 'Güney-Doğu Cephe', 'GB' => 'Güney-Batı Cephe');
        $view_array = array('' => 'Seçiniz...', 'none' => 'Yok', 'building' => 'Bina', 'retaining' => 'İstinat', 'open' => 'Önü Açık', 'scenic' => 'Manzara', 'garden' => 'Bahçe', 'project' => 'Proje');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        $offers = Offer::orderBy('id', 'desc')->where('apartment_id', $apartment->id)->get();
        SystemLogsController::add('show',$apartment->id);
        return View::make('apartment.show')->with('building_array', $building_array)->with('type_array', $type_array)->with('room_array', $room_array)->with('front_array', $front_array)->with('view_array', $view_array)->with('status_array', $status_array)->with('apartment', $apartment)->with('offers', $offers)->with('building', $building);
    }

    public function edit($id)
    {
        $apartment = Apartment::find($id);
        $building_array = Building::where('status', 'active')->lists('title', 'id');
        $type_array = array('' => 'Seçiniz...', 'apartment' => 'Apartman', 'duplex' => 'Dubleks', 'triplex' => 'Tripleks', 'villa' => 'Villa', 'office' => 'Ofis');
        $room_array = array('' => 'Seçiniz...', '1+1' => '1+1', '2+1' => '2+1', '3+1' => '3+1', '4+1' => '4+1', '5+1' => '5+1', '6+1' => '6+1', '7+1' => '7+1');
        $front_array = array('' => 'Seçiniz...', 'K' => 'Kuzey Cephe', 'G' => 'Güney Cephe', 'D' => 'Doğu Cephe', 'B' => 'Batı Cephe', 'KD' => 'Kuzey-Doğu Cephe', 'KB' => 'Kuzey-Batı Cephe', 'GD' => 'Güney-Doğu Cephe', 'GB' => 'Güney-Batı Cephe');
        $view_array = array('' => 'Seçiniz...', 'none' => 'Yok', 'building' => 'Bina', 'retaining' => 'İstinat', 'open' => 'Önü Açık', 'scenic' => 'Manzara', 'garden' => 'Bahçe', 'project' => 'Proje');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('apartment.edit')->with('building_array', $building_array)->with('type_array', $type_array)->with('room_array', $room_array)->with('front_array', $front_array)->with('view_array', $view_array)->with('status_array', $status_array)->with('apartment', $apartment);
    }

    public function editPost()
    {

        $inputs = Input::all();
        $rules = [
            'blokAdı' => 'required',
            'konutAdı' => 'required|max:63',
            'kat' => 'required|max:63',
            'numara' => 'required|max:63',
            'bbKodu' => 'required|max:15',
            'netAlan' => 'required|max:10',
            'brütAlan' => 'required|max:10',
            'tip' => 'required|max:63',
            'durum' => 'required',
            'detaylar' => 'max:65535',
            'kdvHariçTemelFiyat' => 'required|max:10',
            'dairePlani' =>'sometimes|mimes:jpg,jpeg,png',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
             Apartment::where('id', Input::get('id'))->update([
                'building_id' => Input::get('blokAdı'),
                'bb_code' => Input::get('bbKodu'),
                'title' => Input::get('konutAdı'),
                'floor' => Input::get('kat'),
                'number' => Input::get('numara'),
                'net_area' => Input::get('netAlan'),
                'gross_area' => Input::get('brütAlan'),
                'type' => Input::get('tip'),
                'room' => Input::get('odaSayısı'),
                'front' => Input::get('cephe'),
                'front_view' => Input::get('önManzarası'),
                'back_view' => Input::get('arkaManzarası'),
                'details' => Input::get('detaylar'),
                'price' => Input::get('kdvHariçTemelFiyat'),
            ]);
            SystemLogsController::add('edit',Input::get('id'));
            return Redirect::route('apartment.index')->withSuccess('Başarıyla Bir Daireyi Düzenlediniz!');
        } else {
            App::abort(404);
        }
    }

    public function removePost()
    {
        $inputs = Input::all();
        $rules = [
            'id' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
             Apartment::where('id', Input::get('id'))->update([
                'status' => 'removed',
            ]);
            SystemLogsController::add('remove',Input::get('id'));
            return Redirect::route('apartment.index')->withSuccess('Başarıyla Bir Daireyi Sildiniz!');
        } else {
            App::abort(404);
        }
    }

}
