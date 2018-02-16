<?php

class ProjectController extends \BaseController {

    public function index()
    {
        $projects = Project::where('status', '!=', 'removed')->orderBy('id', 'desc')->get();
        return View::make('project.index')->with('projects', $projects);
    }

    public function create()
    {
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('project.create')->with('status_array', $status_array);
    }

    public function createPost()
    {
        $inputs = Input::all();
        $rules = [
            'başlık' => 'required|max:63',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            $project = Project::create([
                'creator_id' => Auth::id(),
                'title' => Input::get('başlık'),
                'details' => Input::get('detaylar'),
                'status' => Input::get('durum'),
            ]);
            SystemLogsController::add('create',$project->id);
            return Redirect::route('project.index')->withSuccess('Başarıyla Yeni Bir Proje Oluşturdunuz!');
        } else {
            App::abort(404);
        }
    }

    public function show($id)
    {
        $project = Project::find($id);
        $buildings = Building::where('project_id',$id)->get();
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        SystemLogsController::add('show',$project->id);
        return View::make('project.show')->with('project', $project)->with('buildings', $buildings)->with('status_array', $status_array);
    }

    public function edit($id)
    {
        $project = Project::find($id);
        $status_array = array('' => 'Seçiniz...', 'active' => 'Aktif', 'passive' => 'Pasif');
        return View::make('project.edit')->with('project', $project)->with('status_array', $status_array);
    }

    public function editPost()
    {
        $inputs = Input::all();
        $rules = [
            'başlık' => 'required|max:63',
            'durum' => 'required',
        ];
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } elseif ($validation->passes()) {
            Project::where('id', Input::get('id'))->update([
                'title' => Input::get('başlık'),
                'details' => Input::get('detaylar'),
                'status' => Input::get('durum'),
            ]);
            SystemLogsController::add('edit',Input::get('id'));
            return Redirect::route('project.index')->withSuccess('Başarıyla Bir Projeyi Düzenlediniz!');
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
            Project::where('id', Input::get('id'))->update([
                'status' => 'removed',
            ]);
            SystemLogsController::add('remove',Input::get('id'));
            return Redirect::route('project.index')->withSuccess('Başarıyla Bir Projeyi Sildiniz!');
        } else {
            App::abort(404);
        }
    }

}
