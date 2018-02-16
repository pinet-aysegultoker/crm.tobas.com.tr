<?php

class BuildingController extends \BaseController {

    public function index()
    {
        $buildings = Building::where('status', '!=', 'removed')->orderBy('id', 'desc')->get();
        return View::make('building.index')->with('buildings', $buildings);
    }

    public function create()
    {
        $project_array = Project::where('status', 'active')->lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('building.create')->with('project_array', $project_array)->with('status_array', $status_array);
    }

    public function createPost()
    {
        $inputs = Input::all();
        $rules = [
            'proje' => 'required',
            'ada' => 'required',
            'parsel' => 'required',
            'başlık' => 'required',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $building = Building::create([
                'project_id' => Input::get('proje'),
                'creator_id' => Auth::id(),
                'island' => Input::get('ada'),
                'parcel' => Input::get('parsel'),
                'title' => Input::get('başlık'),
                'details' => Input::get('detaylar'),
                'status' => Input::get('durum'),
            ]);
            SystemLogsController::add('create',$building->id);
            return Redirect::route('building.index')->withSuccess('Başarıyla Yeni Bir Blok Oluşturdunuz!');
        } else {
            App::abort(404);
        }
    }

    public function show($id)
    {
        $building = Building::find($id);
        $apartments = Apartment::where('building_id',$id)->get();
        $project_array = Project::where('status', 'active')->lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        SystemLogsController::add('show',$id);
        return View::make('building.show')->with('project_array', $project_array)->with('building', $building)->with('apartments', $apartments)->with('status_array', $status_array);
    }

    public function edit($id)
    {
        $building = Building::find($id);
        $project_array = Project::where('status', 'active')->lists('title', 'id');
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('building.edit')->with('project_array', $project_array)->with('building', $building)->with('status_array', $status_array);
    }

    public function editPost()
    {
        $inputs = Input::all();
        $rules = [
            'proje' => 'required',
            'ada' => 'required',
            'parsel' => 'required',
            'başlık' => 'required',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            Building::where('id', Input::get('id'))->update([
                'project_id' => Input::get('proje'),
                'island' => Input::get('ada'),
                'parcel' => Input::get('parsel'),
                'title' => Input::get('başlık'),
                'details' => Input::get('detaylar'),
                'status' => Input::get('durum'),
            ]);
            SystemLogsController::add('edit',Input::get('id'));
            return Redirect::route('building.index')->withSuccess('Başarıyla Bir Bloğu Düzenlediniz!');
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
            Building::where('id', Input::get('id'))->update([
                'status' => 'removed',
            ]);
            SystemLogsController::add('remove',Input::get('id'));
            return Redirect::route('building.index')->withSuccess('Başarıyla Bir Bloğu Sildiniz!');
        } else {
            App::abort(404);
        }
    }
}
