<?php

class ProfileController extends \BaseController {

	public function index()
	{
        $user = User::find(Auth::id());
        $reminders = CustomerReminder::where('creator_id', $user->id)->get();
        return View::make('profile.index')->with('user', $user)->with('reminders', $reminders);
	}

    public function editPost()
    {
        $inputs = Input::all();
        $rules = [
            'yeniParolanız' => 'required|min:8|max:63',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            User::where('id', Auth::id())->update([
                'password' => Hash::make(Input::get('yeniParolanız')),
                'updater_id' => Auth::id(),
            ]);
            Auth::logout();
            return Redirect::route('auth.login')->withSuccess('Parolanız başarıyla değiştirilmiştir. Lütfen sisteme yeni parolanız ile tekrar giriş yaptınız!');
        } else {
            App::abort(404);
        }
    }

}
