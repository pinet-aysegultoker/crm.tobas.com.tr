<?php


use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class CustomerExcelController extends \BaseController {

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


	    //Download
	    /*
        $data =CustomerDetailType::where('status','active')->get()->toArray();
        return Excel::create('Müşteri Ekleme Formu', function($excel) use ($data) {
            $musteri_detay = ['isim','soyisim','musteri_grubu','tc_kimlik','ev_telefonu','cep_telefonu','is_telefonu','ev_adresi','is_adresi','meslek','e_posta','aile_birey_sayisi','ikamet_edilen_konut_alani','konut_sahiplik_durumu','talep_edilen_konut_tipi','talep_edilen_konut_oda_sayisi','talep_edilen_konut_alani','talep_edilen_konut_fiyat_araligi','talep_edilen_konut_odeme_sekli'];

            $excel->sheet('musteri_ekleme_formu', function($sheet) use ($musteri_detay)
            {
                $sheet->fromArray($musteri_detay);
            });

            $excel->sheet('musteri_detay', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
	    */
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
        } elseif ($validator->passes()) {
            if(Input::hasFile('import_file')){
                $path = Input::file('import_file')->getRealPath();
                $data = Excel::selectSheets('musteri_ekleme_formu')->load($path)->get();

                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {
                        if (strlen("$value->musterigrubu") > 0){
                            $group_id = CustomerGroup::where('title',"$value->musterigrubu")->pluck('id');
                        }else{
                            $group_id = '';
                        }

                        if(strlen($value->durum) > 0){
                            ($value->durum == 'Aktif') ? $status = 'active' : $status = 'passive';
                        }else{
                            $status = '';
                        }

                        $customer = Customer::create([
                            'first_name' => $value->isim,
                            'last_name' => $value->soyisim,
                            'group_id' => $group_id,
                            'status' => $status,
                            'creator_id' => Auth::id(),
                            'last_process_time' => Carbon::now(),
                        ]);

                        $customer_details = CustomerDetailType::where('status','active')->get();
                        foreach($customer_details as $customer_detail) {
                            $data = $customer_detail->title_id;
                            CustomerDetailValues::create([
                                'customer_id' => $customer->id,
                                'type_id' => $customer_detail->id,
                                'value' => $value->$data,
                                'creator_id' => Auth::id(),
                            ]);
                        }

                        SystemLogsController::add('create',$customer->id);
                    }
                }
            }
        }

        return Redirect::back()->withSuccess('Müşteriler Başarıyla Eklendi!');
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
