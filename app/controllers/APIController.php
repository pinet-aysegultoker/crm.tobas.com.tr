<?php

class APIController extends \BaseController {

	public function getBuildings()
	{
        if(Input::has('proje'))
        {
            $project_id = Input::get('proje');
            $buildings = Building::orderby('id','asc')->where('project_id', $project_id)->get();
            $buildingsArray = array();
            foreach ($buildings as $building)
            {
                array_push($buildingsArray, array(
                    "id" => $building->id,
                    "title" => $building->title,
                ));
            }
            echo json_encode($buildingsArray);
        } else {
            App::abort(404);
        }
	}

	public function getApartments()
	{
        if(Input::has('blok'))
        {
            $building_id = Input::get('blok');
            $apartments = Apartment::orderby('id','asc')->where('status', 'active')->where('building_id', $building_id)->get();
            $apartmentsArray = array();
            foreach ($apartments as $apartment)
            {
                array_push($apartmentsArray, array(
                    "id" => $apartment->id,
                    "title" => $apartment->title,
                    "price" => $apartment->price,
                ));
            }
            echo json_encode($apartmentsArray);
        } else {
            App::abort(404);
        }
	}

    public function getApartment()
    {
        if(Input::has('konut'))
        {
            $apartment_id = Input::get('konut');
            $apartment = Apartment::find($apartment_id);
            $apartmentArray = array();
            array_push($apartmentArray, array(
                "id" => $apartment->id,
                "title" => $apartment->title,
                "price" => number_format($apartment->price, 2, ',', '.')." TL",
            ));
            echo json_encode($apartmentArray);
        } else {
            App::abort(404);
        }
    }

    public function getCustomerGroups()
    {
            $groups = CustomerGroup::get();
            $groupsArray = array();
            foreach ($groups as $group)
            {
                $parent_group = CustomerGroup::where('id',$group->parent_group_id)->pluck('title');
                if($parent_group) {
                    $parent_group_title = $parent_group;
                } else {
                    $parent_group_title = '↳ Ana Grup';
                }
                array_push($groupsArray, array(
                    "id" => $group->id,
                    "title" => $group->title,
                    "parent" => $parent_group_title,
                ));
            }

            echo json_encode($groupsArray);
    }

    public function getOffers()
    {
        if(Input::has('konut'))
        {
            $offers = Offer::where('apartment_id',Input::get('konut'))->leftJoin('customers', 'offers.customer_id', '=', 'customers.id')->select(DB::raw("CONCAT(offers.id,'-',offers.created_at,'-',offers.creator_id,'-',customers.first_name,' ',customers.last_name) AS offer_name"), 'offers.id as offer_id')->get();
            $offersArray = array();
            foreach ($offers as $offer) {
                array_push($offersArray, array(
                    "id" => $offer->offer_id,
                    "title" => $offer->offer_name
                ));
            }
            echo json_encode($offersArray);
        } else {
            App::abort(404);
        }
    }

    public function getReminder()
    {
        if(Input::has('reminder'))
        {
            $reminder_id = Input::get('reminder');
            $reminder = CustomerReminder::find($reminder_id);
            $customer = Customer::find($reminder->customer_id);
            $reminderArray = array();
            array_push($reminderArray, array(
                "id" => $reminder->id,
                "customer" => $customer->first_name.' '.$customer->last_name,
                "description" => $reminder->description,
                "time" => Carbon::parse($reminder->time)->formatLocalized('%d/%m/%Y %H:%M:%S'),
                "created_at" => Carbon::parse($reminder->created_at)->formatLocalized('%d/%m/%Y %H:%M:%S'),
            ));
            echo json_encode($reminderArray);
        } else {
            App::abort(404);
        }
    }

    public function getCustomers()
    {
        $customers = Customer::orderby('id','asc')->get();
        $customerArray = array();
        foreach($customers as $customer)
        {
            $customer_details = CustomerDetailValues::where('customer_id',$customer->id)->get();
            $x=1;
            foreach($customer_details as $customer_detail)
            {
                $detail_type = CustomerDetailType::where('id',$x)->pluck('title');
                $detail_types[$x] = $customer_detail->value;
                $x++;

            }
            array_push($customerArray, array(
                'id' =>  $customer->id,
                'name'  => $customer->first_name,
                'last_name' =>  $customer->last_name,
                'status' => $customer->status,
                'cinsiyet' =>  $detail_types[1],
                'tckimlikno' =>  $detail_types[2],
                'evtelefonu' =>  $detail_types[3],
                'ceptelefonu' =>  $detail_types[4],
                'istelefonu' =>  $detail_types[5],
                'evadresi' =>  $detail_types[6],
                'isadresi' =>  $detail_types[7],
                'müsaitsaatleri' =>  $detail_types[8],
                'meslek' =>  $detail_types[9],
                'eposta' =>  $detail_types[10],
                'ailebireysayisi' =>  $detail_types[11],
                'ikametedilenkonutalani' =>  $detail_types[12],
                'konutsahiplikdurumu' =>  $detail_types[13],
                'talepedilenkonuttipi' =>  $detail_types[14],
                'talepedilenkonutodasayisi' =>  $detail_types[15],
                'talepedilenkonutalani' =>  $detail_types[16],
                'talepedilenkonutfiyataraligi' =>  $detail_types[17],
                'talepedilenkonutodemesekli' =>  $detail_types[18],

            ));
        }
        echo json_encode($customerArray);
    }

}
