<?php

class SalesController extends \BaseController {

    public function index()
    {
        $sales = Sales::orderBy('id', 'desc')->get();
        return View::make('sales.index')->with('sales', $sales);
    }

    public function create()
    {
        $projects_array = array('' => 'Seçiniz...') + Project::where('status', 'active')->lists('title', 'id');
        $offers_array = array('' => 'Seçiniz...') + Offer::select(DB::raw("CONCAT(id,'-',created_at,'-',creator_id) AS code, id"))->lists('code', 'id');
        $customers_array = array('' => 'Seçiniz...') + Customer::select(DB::raw("CONCAT(first_name,' ', last_name) AS full_name, id"))->where('status', 'active')->lists('full_name', 'id');
        return View::make('sales.create')->with('projects_array', $projects_array)->with('offers_array', $offers_array)->with('customers_array', $customers_array);
    }

    public function createPost()
    {
        $apartment =Apartment::find(Input::get('apartment_id'));
        if ($apartment->status == 'active')
        {
            if (Input::get('creator_id') == Auth::user()->id)
            {
                $inputs = Input::all();
                $rules = [
                    'apartment_id' => 'required',
                    'creator_id' => 'required',
                    'offer_id' => 'required',
                    'customer_id' => 'required',
                    'aciklama' => 'max:2047',
                ];
                $validation = Validator::make($inputs, $rules);
                if ($validation->fails()) {
                    return Redirect::back()->withInput()->withErrors($validation);
                } elseif ($validation->passes()) {
                    $sales = Sales::create([
                        'creator_id' =>Input::get('creator_id'),
                        'apartment_id' => Input::get('apartment_id'),
                        'customer_id' => Input::get('customer_id'),
                        'offer_id' => Input::get('offer_id'),
                        'description' => Input::get('aciklama'),
                    ]);
                    Apartment::where('id', Input::get('apartment_id'))->update([
                        'status' => 'passive',
                    ]);
                    SystemLog::create(['user_id'=>Auth::id(),'user_ip'=>Request::getClientIp(),'route'=>Route::current()->getName(),'type'=>'create','data_id'=>$sales->customer_id]);
                    return Redirect::route('sales.index')->withSuccess('Başarıyla Yeni Bir Satış İşlemi Belirttiniz!');
                } else {
                    App::abort(404);
                }
            }
            else{
                return Redirect::route('offer.index')->withError('Bu işlem için yetkiniz yoktur!');
            }
        }
        else{
            return Redirect::route('offer.index')->withError('İşlem yapmakta olduğumuz daire daha önce satılmıştır!');
        }
    }

}
