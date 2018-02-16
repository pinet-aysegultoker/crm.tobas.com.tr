<?php

class CustomerDetailController extends \BaseController {

	public function index()
	{
        $customer_details = CustomerDetailType::where('status', '!=', 'removed')->orderBy('id', 'desc')->get();
		return View::make('customer.detail.index')->with('customer_details', $customer_details);
	}

	public function create()
	{
        return View::make('customer.detail.create');
	}

	public function store()
	{
        $inputs = Input::all();
        $rules = [
            'baslik' => 'required|max:63',
            'detail_type' => 'required|max:63',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {

            if (Input::get('tags') !=""){
                $dizi= [];
                foreach (Input::get('tags') as $value){
                    $dizi += [$value => $value];
                }
                $type_array =base64_encode(serialize($dizi));
            }else{
                $type_array="";
            }
            $title_id = str_replace(' ','',lcfirst(Input::get('baslik')));
            $customerDetailType = CustomerDetailType::create([
                'title' => Input::get('baslik'),
                'title_id' => $title_id,
                'type' => Input::get('detail_type'),
                'type_array' => $type_array,
                'mask' =>Input::get('mask'),
                'status' => Input::get('durum'),
            ]);
            SystemLogsController::add('create',$customerDetailType->id);
            return Redirect::route('customer.detail')->withSuccess('Başarıyla Yeni Bir Müşteri Detay Alanı Oluşturdunuz!');
        } else {
            App::abort(404);
        }
	}

	public function edit($id)
	{
        $customer_details = CustomerDetailType::find($id);
        return View::make('customer.detail.edit')->with('customer_details', $customer_details);
	}

	public function update()
	{
        $inputs = Input::all();
        $rules = [
            'baslik' => 'required|max:63',
            'detail_type' => 'required|max:63',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            if (Input::get('tags') !=""){
                $dizi= [];
                foreach (Input::get('tags') as $value){
                    $dizi += [$value => $value];
                }
                $type_array =base64_encode(serialize($dizi));
            }else{
                $type_array="";
            }
            $title_id = str_replace(' ','',lcfirst(Input::get('baslik')));
            CustomerDetailType::where('id', Input::get('id'))->update([
                'title' => Input::get('baslik'),
                'title_id' => $title_id,
                'type' => Input::get('detail_type'),
                'type_array' => $type_array,
                'mask' =>Input::get('mask'),
                'status' => Input::get('durum'),
            ]);
            SystemLogsController::add('edit',Input::get('id'));
            return Redirect::route('customer.detail')->withSuccess('Başarıyla Yeni Bir Müşteri Detay Alanı Düzenlediniz!');
        } else {
            App::abort(404);
        }
	}

	public function destroy()
	{
        $inputs = Input::all();
        $rules = [
            'id' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $customer_detail = CustomerDetailType::find(Input::get('id'));
            if (Auth::user()->group_id == 1) {
                CustomerDetailType::where('id', Input::get('id'))->update([
                    'status' => 'removed',
                ]);
                SystemLogsController::add('remove',Input::get('id'));
                return Redirect::route('customer.detail')->withSuccess('Başarıyla Bir Müşteri Detay Alanı Sildiniz!');
            } else {
                return Redirect::back()->withError('Bu bölüme erişim yetkiniz yoktur!');
            }
        } else {
            App::abort(404);
        }
	}
}
