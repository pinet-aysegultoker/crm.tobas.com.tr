<?php

class CustomerReminderController extends \BaseController {

    public function createPost()
    {
        $inputs = Input::all();
        $rules = [
            'id' => 'required',
            'açıklama' => 'required|max:2047',
            'hatırlatmaZamanı' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $reminder = CustomerReminder::create([
                'customer_id' => Input::get('id'),
                'creator_id' => Auth::id(),
                'description' => Input::get('açıklama'),
                'time' => Carbon::createFromFormat('d/m/Y H:i:s',Input::get('hatırlatmaZamanı')),
            ]);
            SystemLogsController::add('create',Input::get('id'));
            return Redirect::route('customer.show',['id'=>Input::get('id')])->withSuccess('Başarıyla Yeni Bir Hatırlatıcı Oluşturdunuz!');
        } else {
            App::abort(404);
        }
    }

    public function reminderPassive($id)
    {
        $reminder = CustomerReminder::where('id', $id)->update([
            'status' => 'passive',
        ]);
        return Redirect::route('dashboard.index')->withSuccess('Hatırlatıcı Kapatıldı!');
    }

}
