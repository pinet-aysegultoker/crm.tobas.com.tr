<?php

class ApartmentExcelController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $messages =[
            'required' =>'Excel Dosyası Gönderiniz!',
            'mimes' =>'Excel Dosyası Gönderiniz!'
        ];
        $validator = Validator::make(Input::all(),[
            'import_file' => 'required|max:50000|mimes:xlsx,xls'
        ],$messages);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        elseif ($validator->passes()) {

            if(Input::hasFile('import_file')){
                $path = Input::file('import_file')->getRealPath();
                $data = Excel::selectSheets('daire_ekleme_formu')->load($path)->get();

                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {

                        if (!Project::where('title',$value->projeadi)->first())
                        {
                            $project = Project::create([
                                'creator_id' => Auth::id(),
                                'title' => $value->projeadi,
                                'status' => 'active',
                            ]);
                        }

                        $blok =  $value->bloktipi."-".$value->blokno;


                       if (!Building::where('title',$blok)->first())
                       {
                           $project_id = Project::where('title',$value->projeadi)->pluck('id');
                           $building = Building::create([
                               'project_id' => $project_id,
                               'creator_id' => Auth::id(),
                               'island' => $value->ada,
                               'parcel' => $value->parsel,
                               'title' => $blok,
                               'status' => 'active',
                           ]);
                       }

                       $blok_id = Building::where('title',$blok)->pluck('id');

                       if ($value->tip =='Apartman')
                       {
                            $tip= "apartment";
                       }
                       else if($value->tip =='Dubleks')
                       {
                           $tip= "duplex";
                       }
                       else if($value->tip =='Villa')
                       {
                           $tip= "villa";
                       }
                       else if($value->tip =='Tripleks')
                       {
                           $tip= "triplex";
                       }
                       else if($value->tip =='Ofis')
                       {
                           $tip= "office";
                       }

                        $apartment = Apartment::create([
                            'building_id' => $blok_id,
                            'creator_id' => Auth::id(),
                            'bb_code' => $value->bbkod,
                            'title' => $value->numara,
                            'lot' => $value->lot,
                            'floor' => $value->kat,
                            'number' => $value->numara,
                            'net_area' => $value->netalan,
                            'gross_area' => $value->brutalan,
                            'type' => $tip,
                            'room' => $value->odasayisi,
                            'front' => $value->cephe,
                            'details' => $value->detaylar,
                            'price' => $value->kdvharicfiyat,
                            'status' => 'active',
                        ]);

                    }

                }
            }
        }

        return Redirect::back()->withSuccess('Daireler Başarıyla Eklendi!');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
