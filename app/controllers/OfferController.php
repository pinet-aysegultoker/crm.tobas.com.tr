<?php

class OfferController extends \BaseController {

    public function index()
    {
        $offers = Offer::orderBy('id', 'desc')->get();
        return View::make('offer.index')->with('offers', $offers);
    }

    public function create()
    {
        $projects_array = array('' => 'Seçiniz...') + Project::where('status', 'active')->lists('title', 'id');
        $buildings_array = array('' => 'Seçiniz...') + Building::where('status', 'active')->lists('title', 'id');
        $apartments_array = array('' => 'Seçiniz...') + Apartment::where('status', 'active')->lists('title', 'id');
        $discount_array = array('0' => 'İndirim Yok', '10' => 'Lansman İndirimi (10%)', '12' => 'Toplu Satış İndirimi (12%)');
        $customers_array = array('' => 'Seçiniz...') + Customer::select(DB::raw("CONCAT(first_name,' ', last_name) AS full_name, id"))->where('status', 'active')->lists('full_name', 'id');
        return View::make('offer.create')->with('projects_array', $projects_array)->with('buildings_array', $buildings_array)->with('apartments_array', $apartments_array)->with('discount_array', $discount_array)->with('customers_array', $customers_array);
    }

    public function createPost()
    {
        if (Apartment::where('id',Input::get('konut'))->pluck('status') =='reserved')
        {
            return Redirect::route('offer.index')->withError('Bu daire daha önce rezerve edilmiştir.');

        }
        else{
            $inputs = Input::all();
            $rules = [
                'konut' => 'required',
                'müşteri' => 'required',
                'konu' => 'active',
                'açıklama' => 'max:2047',
                'başlangıçTarihi' => 'required',
                'bitişTarihi' => 'required',
            ];
            $validation = Validator::make($inputs, $rules);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation);
            } elseif ($validation->passes()) {
                $price = Apartment::where('id',Input::get('konut'))->pluck('price');
                $discount = $price*(Input::get('indirim',0)/100);
                $offer = Offer::create([
                    'apartment_id' => Input::get('konut'),
                    'customer_id' => Input::get('müşteri'),
                    'creator_id' => Auth::id(),
                    'subject' => Input::get('konu'),
                    'description' => Input::get('açıklama'),
                    'start_date' => Carbon::createFromFormat('d/m/Y',Input::get('başlangıçTarihi')),
                    'finish_date' => Carbon::createFromFormat('d/m/Y',Input::get('bitişTarihi')),
                    'price' => $price,
                    'discount' => $discount,
                ]);
                SystemLogsController::add('create',Input::get('müşteri'));
                return Redirect::route('offer.index')->withSuccess('Başarıyla Yeni Bir Teklif Oluşturdunuz!');
            } else {
                App::abort(404);
            }
        }

    }

}
