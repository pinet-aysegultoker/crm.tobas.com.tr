<?php

class AuthController extends \BaseController {

	public function login()
	{
        return View::make('auth.login');
	}

	public function logout()
	{
        Auth::logout();
        return Redirect::route('auth.login')->withSuccess(Config::get('app.name') . ' CRM sisteminden başarıyla çıkış yaptınız!');
	}

    public function store()
    {
        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
        {
            SystemLogsController::add('auth',Auth::id());
            User::where('id', Auth::id())->update(['last_login_time' => date("Y-m-d H:i:s"), 'last_login_ip' => Request::getClientIp()]);
            Session::put('staff', Input::get('username'));
            return Redirect::route('dashboard.index')->withSuccess(Config::get('app.name') . ' CRM sisteminde başarıyla oturumunuz açıldı!');
        } else {
            return Redirect::back()->withError('Kullanıcı bilgileriniz doğrulanamadı. Lütfen kullanıcı bilgilerinizi kontrol ederek tekrar deneyiniz!');
        }
    }

}
