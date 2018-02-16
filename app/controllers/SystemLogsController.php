<?php

class SystemLogsController extends \BaseController
{

    public function index()
    {
        $system_logs = SystemLog::orderBy('id', 'desc')->take(1000)->get();
        return View::make('system.logs.index')->with('system_logs', $system_logs);
    }

    public static function add($type = "", $data_id = "")
    {
        $system_log = new SystemLog();
        $system_log->user_id = Auth::id();
        $system_log->user_ip = Request::getClientIp();
        $system_log->route = Route::current()->getName();
        $system_log->type = $type;
        if ($data_id != "") {
            $system_log->data_id = $data_id;
        } else if ($type = 'auth') {
            $system_log->data_id = Auth::id();
        } else {
            $system_log->data_id = Input::get('id');
        }
        $system_log->save();

        $currentDate = \Carbon\Carbon::now()->format('y-m-d');



        $dateGet = UserProcess::where('name', Session::get('staff'))->pluck('date');
        $dateCheck = date('y-m-d', strtotime($dateGet));
        if ($currentDate != $dateCheck) {
            $count = 0;
            $userProcess = new UserProcess();
            $userProcess->name = Session::get('staff');
            $userProcess->date = \Carbon\Carbon::now()->format('y-m-d');
            $userProcess->proces_number = $count + 1;
            $userProcess->save();
        } else {
            if (UserProcess::where('name', Session::get('staff'))->first()) {
                $count = UserProcess::where('name', Session::get('staff'))->pluck('proces_number');
                $data = [
                    'proces_number' => $count + 1
                ];
                UserProcess::where('name', Session::get('staff'))->update($data);
            } else {
                $count = 0;
                $userProcess = new UserProcess();
                $userProcess->name = Session::get('staff');
                $userProcess->date = \Carbon\Carbon::now()->format('y-m-d');
                $userProcess->proces_number = $count + 1;
                $userProcess->save();
            }


        }
        return true;
    }

    public static function logType($route, $id = null)
    {
        $controller = explode('.', $route);
        $data = [];
        if ($controller[0] == "customer" && $controller[1] != "detail" && $controller[1] != "group" && $controller[1] != "reminder") {
            $data = [
                'type' => 'Müşteri',
                'field1' => Customer::where('id', $id)->pluck('first_name'),
                'field2' => Customer::where('id', $id)->pluck('last_name'),
            ];
            return $data;
        } else if ($controller[0] == "customer" && $controller[1] == "detail") {
            $data = [
                'type' => 'Müşteri Detay Alanı',
                'field1' => CustomerDetailType::where('id', $id)->pluck('title'),
                'field2' => CustomerDetailType::where('id', $id)->pluck('type'),
            ];
            return $data;
        } else if ($controller[0] == "customer" && $controller[1] == "group") {
            $data = [
                'type' => 'Müşteri Grubu',
                'field1' => CustomerGroup::where('id', $id)->pluck('title'),
                'field2' => '',
            ];
            return $data;
        } else if ($controller[0] == "customer" && $controller[1] == "reminder") {
            $data = [
                'type' => 'Müşteri Hatırlatıcı',
                'field1' => Customer::where('id', $id)->pluck('first_name'),
                'field2' => Customer::where('id', $id)->pluck('last_name'),
            ];
            return $data;
        } else if ($controller[0] == "offer" || $controller[0] == "pdf") {
            $data = [
                'type' => 'Teklif',
                'field1' => Customer::where('id', $id)->pluck('first_name'),
                'field2' => Customer::where('id', $id)->pluck('last_name'),
            ];
            return $data;
        } else if ($controller[0] == "reserved") {
            $data = [
                'type' => 'Rezerve',
                'field1' => Customer::where('id', $id)->pluck('first_name'),
                'field2' => Customer::where('id', $id)->pluck('last_name'),
            ];
            return $data;
        } else if ($controller[0] == "meeting") {
            $data = [
                'type' => 'Görüşme',
                'field1' => Customer::where('id', $id)->pluck('first_name'),
                'field2' => Customer::where('id', $id)->pluck('last_name'),
            ];
            return $data;
        } else if ($controller[0] == "payment-plan") {
            $data = [
                'type' => 'Müşteri Ödeme Planı',
                'field1' => Customer::where('id', $id)->pluck('first_name'),
                'field2' => Customer::where('id', $id)->pluck('last_name'),
            ];
            return $data;
        } else if ($controller[0] == "messages") {
            $data = [
                'type' => 'Mesaj',
                'field1' => Message::where('id', $id)->pluck('name'),
                'field2' => Message::where('id', $id)->pluck('email'),
            ];
            return $data;
        } else if ($controller[0] == "sales") {
            $data = [
                'type' => 'Satış',
                'field1' => Customer::where('id', $id)->pluck('first_name'),
                'field2' => Customer::where('id', $id)->pluck('last_name'),
            ];
            return $data;
        } else if ($controller[0] == "building") {
            $project_id = Building::where('id', $id)->pluck('project_id');
            $project = Project::where('id', $project_id)->pluck('title');
            $data = [
                'type' => 'Blok',
                'field1' => Building::where('id', $id)->pluck('title'),
                'field2' => $project,
            ];
            return $data;
        } else if ($controller[0] == "project") {
            $data = [
                'type' => 'Proje',
                'field1' => Project::where('id', $id)->pluck('title'),
                'field2' => '',
            ];
            return $data;
        } else if ($controller[0] == "apartment") {
            $building_id = Apartment::where('id', $id)->pluck('building_id');
            $building = Building::where('id', $building_id)->pluck('title');
            $project_id = Building::where('id', $building_id)->pluck('project_id');
            $project = Project::where('id', $project_id)->pluck('title');
            $data = [
                'type' => 'Daire',
                'field1' => $building,
                'field2' => Apartment::where('id', $id)->pluck('number'),
                'field3' => $project
            ];
            return $data;
        } else {
            $data = [
                'type' => 'Kullanıcı',
                'field1' => User::where('id', $id)->pluck('first_name'),
                'field2' => User::where('id', $id)->pluck('last_name'),
            ];
            return $data;
        }

    }
}
