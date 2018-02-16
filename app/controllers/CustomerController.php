<?php

class CustomerController extends \BaseController {

    public function index()
    {
        $customers = Customer::where('status', '!=', 'removed')->orderBy('id', 'desc')->get();
        return View::make('customer.index')->with('customers', $customers);
    }

    public function create()
    {
        $groups_array = array('' => 'Seçiniz...') + CustomerGroup::lists('title', 'id');
        $customer_details = CustomerDetailType::where('status','active')->get();
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('customer.create')->with('groups_array', $groups_array)->with('status_array', $status_array)->with('customer_details', $customer_details);
    }

    public function createPost()
    {
        $inputs = Input::all();
        $rules = [
            'isim' => 'required|max:63',
            'soyisim' => 'required|max:63',
            'müşteriGrubu' => 'required',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $customer = Customer::create([
                'first_name' => Input::get('isim'),
                'last_name' => Input::get('soyisim'),
                'group_id' => Input::get('müşteriGrubu'),
                'status' => Input::get('durum'),
                'creator_id' => Auth::id(),
                'last_process_time' => Carbon::now(),
            ]);
            $customer_details = CustomerDetailType::where('status','active')->get();
            foreach($customer_details as $customer_detail) {
                CustomerDetailValues::create([
                    'customer_id' => $customer->id,
                    'type_id' => $customer_detail->id,
                    'value' => Input::get($customer_detail->title_id),
                    'creator_id' => Auth::id(),
                ]);
            }
            SystemLogsController::add('create',$customer->id);
            return Redirect::route('customer.index')->withSuccess('Başarıyla Yeni Bir Müşteri Oluşturdunuz!');
        } else {
            App::abort(404);
        }
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        $customer_logs = SystemLog::where('data_id',$id)->get();
        $groups_array = array('' => 'Seçiniz...') + CustomerGroup::lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        $meeting_id = Meeting::where('customer_id',$id)->pluck('id');
        $customer_details = CustomerDetailType::where('status','active')->get();
        $offers = Offer::orderBy('id', 'desc')->where('customer_id', $customer->id)->get();
        SystemLogsController::add('show',$id);
        return View::make('customer.show')->with('groups_array', $groups_array)->with('status_array', $status_array)->with('customer', $customer)->with('customer_logs', $customer_logs)->with('meeting_id',$meeting_id)->with('customer_details', $customer_details)->with('offers', $offers);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        $groups_array = array('' => 'Seçiniz...') + CustomerGroup::lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        $customer_details = CustomerDetailType::where('status','active')->get();
        if (Auth::user()->group_id == 1 || $customer->creator_id == Auth::id()) {
            return View::make('customer.edit')->with('groups_array', $groups_array)->with('status_array', $status_array)->with('customer', $customer)->with('customer_details', $customer_details);
        } else {
            return Redirect::back()->withError('Bu bölüme erişim yetkiniz yoktur!');
        }
    }

    public function editPost()
    {
        $inputs = Input::all();
        $rules = [
            'isim' => 'required|max:63',
            'soyisim' => 'required|max:63',
            'müşteriGrubu' => 'required',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $customer = Customer::find(Input::get('id'));
            if (Auth::user()->group_id == 1 || $customer->creator_id == Auth::id()) {
                Customer::where('id', Input::get('id'))->update([
                    'first_name' => Input::get('isim'),
                    'last_name' => Input::get('soyisim'),
                    'group_id' => Input::get('müşteriGrubu'),
                    'status' => Input::get('durum'),
                    'updater_id' => Auth::id(),
                    'last_process_time' => Carbon::now(),
                ]);
                $customer_details = CustomerDetailType::where('status','active')->get();
                foreach($customer_details as $customer_detail) {
                    $counter = CustomerDetailValues::where('type_id', $customer_detail->id)->where('customer_id',Input::get('id'))->count();
                    if($counter == 1) {
                        CustomerDetailValues::where('type_id', $customer_detail->id)->where('customer_id',Input::get('id'))->update([
                            'value' => Input::get($customer_detail->title_id),
                            'updater_id' => Auth::id(),
                        ]);
                    } else {
                        CustomerDetailValues::create([
                            'customer_id' => $customer->id,
                            'type_id' => $customer_detail->id,
                            'value' => Input::get($customer_detail->title_id),
                            'creator_id' => Auth::id(),
                        ]);
                    }
                }
                SystemLogsController::add('edit',Input::get('id'));
                return Redirect::route('customer.index')->withSuccess('Başarıyla Bir Müşteriyi Düzenlediniz!');
            } else {
                return Redirect::back()->withError('Bu bölüme erişim yetkiniz yoktur!');
            }
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
            $customer = Customer::find(Input::get('id'));
            if (Auth::user()->group_id == 1 || $customer->creator_id == Auth::id()) {
                Customer::where('id', Input::get('id'))->update([
                    'status' => 'removed',
                ]);
                SystemLogsController::add('remove',Input::get('id'));
                return Redirect::route('customer.index')->withSuccess('Başarıyla Bir Müşteriyi Sildiniz!');
            } else {
                return Redirect::back()->withError('Bu bölüme erişim yetkiniz yoktur!');
            }

        } else {
            App::abort(404);
        }
    }

}
