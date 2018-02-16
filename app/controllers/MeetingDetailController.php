<?php

class MeetingDetailController extends \BaseController {

	public function index($id)
	{
        $meeting = Meeting::find($id);
        $meeting_details = MeetingDetail::orderBy('id', 'asc')->where('meeting_id',$id)->get();
        $user = Customer::find($meeting->customer_id);
        $status_array = array('' => 'Seçiniz...', 'started' => 'Başlatıldı', 'updated' => 'Güncellendi', 'finished' => 'Tamamlandı');
        SystemLogsController::add('show',$meeting->customer_id);
        return View::make('meeting.detail.index')->with('id', $id)->with('meeting',$meeting)->with('meeting_details',$meeting_details)->with('user',$user)->with('status_array', $status_array);
	}

    public function createPost()
    {
        $inputs = Input::all();
        $rules = [
            'id' => 'required',
            'görüşmeVeyaİşlemKaydı' => 'required|max:65535',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            MeetingDetail::create([
                'meeting_id' => Input::get('id'),
                'creator_id' => Auth::id(),
                'details' => Input::get('görüşmeVeyaİşlemKaydı'),
            ]);
            Meeting::where('id', Input::get('id'))->update([
                'updater_id' => Auth::id(),
                'status' => 'updated',
            ]);
            $customer_id =   Meeting::where('id', Input::get('id'))->pluck('customer_id');
            SystemLogsController::add('create',$customer_id);
            return Redirect::route('meeting.detail.index',['id'=>Input::get('id')])->withSuccess('Başarıyla Yeni Bir Görüşme/İşlem Kaydı Eklediniz!');
        } else {
            App::abort(404);
        }
    }

}
