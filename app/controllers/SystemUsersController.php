<?php

class SystemUsersController extends \BaseController {

    public function index()
    {
        $users = User::where('status', '!=', 'removed')->orderBy('id', 'desc')->get();
        return View::make('system.users.index')->with('users', $users);
    }

	public function create()
	{
        $groups_array = array('' => 'Seçiniz...') + UserGroup::lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('system.users.create')->with('groups_array', $groups_array)->with('status_array', $status_array);
	}

    public function createPost()
    {
        $inputs = Input::all();
        $rules = [
            'kullanıcıAdı' => 'required|max:63',
            'eposta' => 'required|email|max:63',
            'isim' => 'required|max:63',
            'soyisim' => 'required|max:63',
            'şifre' => 'required|max:127',
            'erişimGrubu' => 'required',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
           $user = User::create([
                'username' => Input::get('kullanıcıAdı'),
                'email' => Input::get('eposta'),
                'first_name' => Input::get('isim'),
                'last_name' => Input::get('soyisim'),
                'password' => Hash::make(Input::get('şifre')),
                'group_id' => Input::get('erişimGrubu'),
                'status' => Input::get('durum'),
                'creator_id' => Auth::id(),
            ]);
            SystemLogsController::add('create',$user->id);
            return Redirect::route('system.users.index')->withSuccess('Başarıyla Yeni Bir Sistem Kullanıcısı Oluşturdunuz!');
        } else {
            App::abort(404);
        }
    }


	public function show($id)
	{
        $user = User::find($id);
        $user_logs = SystemLog::where('data_id',$id)->orWhere('user_id',$id)->get();
        $groups_array = array('' => 'Seçiniz...') + UserGroup::lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        SystemLogsController::add('show',$user->id);
        return View::make('system.users.show')->with('groups_array', $groups_array)->with('status_array', $status_array)->with('user', $user)->with('user_logs', $user_logs);
	}

	public function edit($id)
	{
        $user = User::find($id);
        $groups_array = array('' => 'Seçiniz...') + UserGroup::lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('system.users.edit')->with('groups_array', $groups_array)->with('status_array', $status_array)->with('user', $user);
	}

    public function editPost()
    {
        $inputs = Input::all();
        $rules = [
            'kullanıcıAdı' => 'required|max:63',
            'eposta' => 'required|email|max:63',
            'isim' => 'required|max:63',
            'soyisim' => 'required|max:63',
            'şifre' => 'required|max:127',
            'erişimGrubu' => 'required',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            User::where('id', Input::get('id'))->update([
                'username' => Input::get('kullanıcıAdı'),
                'email' => Input::get('eposta'),
                'first_name' => Input::get('isim'),
                'last_name' => Input::get('soyisim'),
                'password' => Hash::make(Input::get('şifre')),
                'group_id' => Input::get('erişimGrubu'),
                'status' => Input::get('durum'),
                'updater_id' => Auth::id(),
            ]);
            SystemLogsController::add('edit',Input::get('id'));
            return Redirect::route('system.users.index')->withSuccess('Başarıyla Bir Sistem Kullanıcısı Düzenlediniz!');
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
            User::where('id', Input::get('id'))->update([
                'status' => 'removed',
            ]);

            SystemLogsController::add('remove',Input::get('id'));
            return Redirect::route('system.users.index')->withSuccess('Başarıyla Bir Sistem Kullanıcısı Sildiniz!');
        } else {
            App::abort(404);
        }
	}

}
