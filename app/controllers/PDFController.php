<?php

class PDFController extends \BaseController {

	public function offerShow($id)
	{
        $pdf = PDF::loadView('pdf.offer.show',['id'=>$id])->setOptions(array(
            'enable-javascript' => true,
            'javascript-delay' => 1000,
            'no-stop-slow-scripts' => true,
            'no-background' => false,
            'lowquality' => false,
            'encoding' => 'utf-8',
            'images' => true,
            'cookie' => array(),
            'dpi' => 300,
            'enable-external-links' => true,
            'enable-internal-links' => true
        ));
        $offer = Offer::find($id);
        SystemLogsController::add('show',$offer->customer_id);
        return $pdf->download('teklif-'.$id.'.pdf');
	}

    public function paymentPlanShow($id)
    {
        $pdf = PDF::loadView('pdf.payment-plan.show',['id'=>$id])->setOptions(array(
            'enable-javascript' => true,
            'javascript-delay' => 1000,
            'no-stop-slow-scripts' => true,
            'no-background' => false,
            'lowquality' => false,
            'encoding' => 'utf-8',
            'images' => true,
            'cookie' => array(),
            'dpi' => 300,
            'enable-external-links' => true,
            'enable-internal-links' => true
        ));
        $payment_plan = PaymentPlan::find($id);
        SystemLogsController::add('show',$payment_plan->id);
        return $pdf->download('odeme-plani-'.$id.'.pdf');
    }

    public function qrcodeBuildingShow($id)
    {
        $pdf = PDF::loadView('pdf.qrcode.building.show',['id'=>$id])->setOptions(array(
            'enable-javascript' => true,
            'javascript-delay' => 1000,
            'no-stop-slow-scripts' => true,
            'no-background' => false,
            'lowquality' => false,
            'encoding' => 'utf-8',
            'images' => true,
            'cookie' => array(),
            'dpi' => 300,
            'enable-external-links' => true,
            'enable-internal-links' => true
        ));
        return $pdf->download('karekod-bina-'.$id.'.pdf');
    }

    public function apartmentShow($id)
    {
        $pdf = PDF::loadView('pdf.apartment.show',['id'=>$id])->setOptions(array(
            'enable-javascript' => true,
            'javascript-delay' => 1000,
            'no-stop-slow-scripts' => true,
            'no-background' => false,
            'lowquality' => false,
            'encoding' => 'utf-8',
            'images' => true,
            'cookie' => array(),
            'dpi' => 300,
            'enable-external-links' => true,
            'enable-internal-links' => true
        ));
        return $pdf->download('konut-'.$id.'.pdf');
    }

}
