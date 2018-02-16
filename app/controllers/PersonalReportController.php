<?php

class PersonalReportController extends \BaseController {

	public function index()
	{
        $offers = Offer::where('creator_id',Auth::user()->id)->orderBy('id', 'desc')->get();
        $sales = Sales::where('creator_id',Auth::user()->id)->orderBy('id', 'desc')->get();
        $processes = UserProcess::all();
		return View::make('personal-report.index')->with('sales', $sales)->with('offers',$offers)->with('processes', $processes);
	}

}
