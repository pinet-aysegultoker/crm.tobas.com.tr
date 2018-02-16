<?php

class ReservedController extends \BaseController {

	public function index()
	{
        $reserveds = Reserved::where('status', '!=', 'removed')->orderBy('id', 'desc')->get();
        return View::make('reserved.index')->with('reserveds',$reserveds);
	}

	public function create()
	{
        $projects_array = array('' => 'Seçiniz...') + Project::where('status', 'active')->lists('title', 'id');
        $buildings_array = array('' => 'Seçiniz...') + Building::where('status', 'active')->lists('title', 'id');
        $apartments_array = array('' => 'Seçiniz...') + Apartment::where('status', 'active')->lists('title', 'id');
        $discount_array = array('0' => 'İndirim Yok', '10' => 'Lansman İndirimi (10%)', '12' => 'Toplu Satış İndirimi (12%)');
        $customers_array = array('' => 'Seçiniz...') + Customer::select(DB::raw("CONCAT(first_name,' ', last_name) AS full_name, id"))->where('status', 'active')->lists('full_name', 'id');
        return View::make('reserved.create')->with('projects_array', $projects_array)->with('buildings_array', $buildings_array)->with('apartments_array', $apartments_array)->with('discount_array', $discount_array)->with('customers_array', $customers_array);
	}

	public function store()
	{
        $inputs = Input::all();
        $rules = [
            'konut' => 'required',
            'müşteri' => 'required',
            'açıklama' => 'max:2047',
            'başlangıçTarihi' => 'required',
            'bitişTarihi' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $reserved = Reserved::create([
                'apartment_id' => Input::get('konut'),
                'customer_id' => Input::get('müşteri'),
                'creator_id' => Auth::id(),
                'description' => Input::get('açıklama'),
                'start_date' => Carbon::createFromFormat('d/m/Y',Input::get('başlangıçTarihi')),
                'finish_date' => Carbon::createFromFormat('d/m/Y',Input::get('bitişTarihi')),
            ]);
            Apartment::where('id', Input::get('konut'))->update([
                'status' =>'reserved'
            ]);
            SystemLogsController::add('create',Input::get('müşteri'));
            return Redirect::route('reserved.index')->withSuccess('Başarıyla Yeni Bir Rezerve Oluşturdunuz!');
        } else {
            App::abort(404);
        }
	}

	public function destroy()
	{
        $inputs = Input::all();
        $rules = [
            'reserved_id' => 'required',
            'apartment_id' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $reserved = Reserved::find(Input::get('reserved_id'));
            if (Auth::user()->group_id == 1 || $reserved->creator_id == Auth::id()) {
                Reserved::where('id', Input::get('reserved_id'))->update([
                    'status' => 'removed',
                ]);
                Apartment::where('id', Input::get('apartment_id'))->update([
                    'status' =>'active'
                ]);
                SystemLogsController::add('remove',Input::get('reserved_id'));
                return Redirect::route('reserved.index')->withSuccess('Başarıyla Bir Rezerve Sildiniz!');
            } else {
                return Redirect::back()->withError('Bu bölüme erişim yetkiniz yoktur!');
            }

        } else {
            App::abort(404);
        }
	}

}
