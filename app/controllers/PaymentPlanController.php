<?php

class PaymentPlanController extends \BaseController {

	public function index()
	{
        $payment_plans = PaymentPlan::orderBy('id', 'desc')->get();
        return View::make('payment-plan.index')->with('payment_plans', $payment_plans);
	}

	public function create()
	{
        $projects_array = array('' => 'Seçiniz...') + Project::where('status', 'active')->lists('title', 'id');
        $buildings_array = array('' => 'Seçiniz...') + Building::where('status', 'active')->lists('title', 'id');
        $apartments_array = array('' => 'Seçiniz...') + Apartment::where('status', 'active')->lists('title', 'id');
        $discount_array = array('0' => 'İndirim Yok', '10' => 'Lansman İndirimi (10%)', '12' => 'Toplu Satış İndirimi (12%)');
        $advance_array = array('' => 'Seçiniz', '10' => '10%', '15' => '15%', '20' => '20%', '25' => '25%', '30' => '30%', '35' => '35%', '40' => '40%', '45' => '45%', '50' => '50%', '55' => '55%', '60' => '60%', '65' => '65%', '70' => '70%', '75' => '75%', '80' => '80%', '85' => '85%', '90' => '90%');
        $customers_array = array('' => 'Seçiniz...') + Customer::select(DB::raw("CONCAT(first_name,' ', last_name) AS full_name, id"))->where('status', 'active')->lists('full_name', 'id');
        return View::make('payment-plan.create')->with('projects_array', $projects_array)->with('buildings_array', $buildings_array)->with('apartments_array', $apartments_array)->with('discount_array', $discount_array)->with('advance_array', $advance_array)->with('customers_array', $customers_array);
	}

    public function createPost()
    {
        $inputs = Input::all();
        $rules = [
            'konut' => 'required',
            'müşteri' => 'required',
            'indirim' => 'required',
            'peşinat' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $price = Apartment::where('id',Input::get('konut'))->pluck('price');
            $discount = $price*(Input::get('indirim',0)/100);
            $offer = PaymentPlan::create([
                'apartment_id' => Input::get('konut'),
                'customer_id' => Input::get('müşteri'),
                'creator_id' => Auth::id(),
                'price' => $price,
                'discount' => $discount,
                'advance' => Input::get('peşinat'),
            ]);
            SystemLogsController::add('create',$offer->id);
            return Redirect::route('payment-plan.index')->withSuccess('Başarıyla Yeni Bir Ödeme Planı Oluşturdunuz!');
        } else {
            App::abort(404);
        }
    }

}
