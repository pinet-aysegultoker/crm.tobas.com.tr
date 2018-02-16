<?php

class CustomerGroupController extends \BaseController {

    public function index()
    {
        $customer_groups = CustomerGroup::where('status', '!=', 'removed')->orderBy('id', 'desc')->get();
        return View::make('customer.group.index')->with('customer_groups', $customer_groups);
    }

    public function create()
    {
        $groups_array = array('0' => '↳ Ana Grup') + CustomerGroup::lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('customer.group.create')->with('groups_array', $groups_array)->with('status_array', $status_array);
    }

    public function createPost()
    {
        $inputs = Input::all();
        $rules = [
            'üstGrup' => 'required',
            'başlık' => 'required|max:63',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $customer_group = CustomerGroup::create([
                'parent_group_id' => Input::get('üstGrup'),
                'title' => Input::get('başlık'),
                'status' => Input::get('durum'),
            ]);
            SystemLogsController::add('create',$customer_group->id);
            return Redirect::route('customer.group.index')->withSuccess('Başarıyla Yeni Bir Müşteri Grubu Oluşturdunuz!');
        } else {
            App::abort(404);
        }
    }

    public function show($id)
    {
        $customer_group = CustomerGroup::find($id);
        $customers = Customer::where('group_id',$id)->where('status','!=','removed')->get();
        $groups_array = array('0' => '↳ Ana Grup') + CustomerGroup::lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        SystemLogsController::add('show',$id);
        return View::make('customer.group.show')->with('groups_array', $groups_array)->with('status_array', $status_array)->with('customer_group', $customer_group)->with('customers', $customers);
    }

    public function edit($id)
    {
        $customer_group = CustomerGroup::find($id);
        $groups_array = array('0' => '↳ Ana Grup') + CustomerGroup::where('id', '!=', $id)->lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('customer.group.edit')->with('groups_array', $groups_array)->with('status_array', $status_array)->with('customer_group', $customer_group);
    }

    public function editPost()
    {
        $inputs = Input::all();
        $rules = [
            'üstGrup' => 'required',
            'başlık' => 'required|max:63',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            CustomerGroup::where('id', Input::get('id'))->update([
                'parent_group_id' => Input::get('üstGrup'),
                'title' => Input::get('başlık'),
                'status' => Input::get('durum'),
            ]);
            SystemLogsController::add('edit',Input::get('id'));
            return Redirect::route('customer.group.index')->withSuccess('Başarıyla Bir Müşteri Grubunu Düzenlediniz!');
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
            $active_user = Customer::where('status','!=','removed')->where('group_id',Input::get('id'))->count();
            if($active_user==0) {
                CustomerGroup::where('id', Input::get('id'))->update([
                    'status' => 'removed',
                ]);
                SystemLogsController::add('remove',Input::get('id'));
                return Redirect::route('customer.group.index')->withSuccess('Başarıyla Bir Müşteri Grubunu Sildiniz!');
            } else {
                return Redirect::route('customer.group.index')->withError('Bu grubu silebilmek için öncelikle gruptaki kullanıcıları siliniz!');
            }
        } else {
            App::abort(404);
        }
    }

}
