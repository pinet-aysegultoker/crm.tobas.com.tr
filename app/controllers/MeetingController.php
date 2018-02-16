<?php

class MeetingController extends \BaseController {

    public function create($id)
    {
        $meeting_id = Meeting::create([
            'customer_id' => $id,
            'creator_id' => Auth::id(),
            'status' => 'started',
        ]);
        SystemLogsController::add('create',$id);
        return Redirect::route('customer.show',['id'=>$id])->withSuccess('Başarıyla Yeni Bir Görüşme Başlattınız!');
    }

}
