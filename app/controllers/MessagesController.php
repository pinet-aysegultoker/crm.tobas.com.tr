<?php

class MessagesController extends \BaseController {

	public function index()
	{
        $messages = Message::where('status', '!=', 'removed')->orderBy('id', 'desc')->get();
        return View::make('message.index')->with('messages', $messages);
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
            $customer = Message::find(Input::get('id'));
            if (Auth::user()->group_id == 1 || $customer->creator_id == Auth::id()) {
                Message::where('id', Input::get('id'))->update([
                    'status' => 'removed',
                ]);
                SystemLogsController::add('remove',Input::get('id'));
                return Redirect::route('messages.index')->withSuccess('Başarıyla Bir Mesajı Sildiniz!');
            } else {
                return Redirect::back()->withError('Bu bölüme erişim yetkiniz yoktur!');
            }

        } else {
            App::abort(404);
        }
	}


}
