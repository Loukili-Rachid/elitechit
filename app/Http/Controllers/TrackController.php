<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CustomHelper;

class TrackController extends Controller
{
    public function indexDhl($trackingNumber = null){
        $data=[];
        return view('track.dhl', compact('data','trackingNumber'));
    }

    public function indexFedex($trackingNumber = null){
        $dataResponse=[];
        return view('track.fedex', compact('dataResponse',"trackingNumber"));
    }

    public function trackFedex(Request $request,$trackingNumber = null)
    {
        $request->validate([
            'tracking_number' => ['required', 'string', 'max:255'],
        ]);
        $tracking_number = $request->tracking_number;

        // Step 1: Generate the access token
        $responseBearerToken = CustomHelper::generateBearerTokenFedex(env("FEDEX_CLIENT_ID"), env("FEDEX_CLIENT_SECRET"));
        
        // Validate access token
        if (strpos($responseBearerToken, '{"access_token":') !== 0) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }

        $data = json_decode($responseBearerToken, true);

        if (!$data || empty($data['access_token'])) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }

        // Access the value of access_token
        $accessToken = $data['access_token'];

        // Step 2: Make the second request with authorization
       
        $response = CustomHelper::trackFedex($accessToken,$tracking_number);
    
        // Validate the response
        if (strpos($response, '{"transactionId":') !== 0) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }

        $dataDecode = json_decode($response, true);

        if (!$dataDecode || empty($dataDecode['output'])) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }

        $dataResponse = $dataDecode["output"]["completeTrackResults"];

        // dd($dataResponse);

        return view('track.fedex', compact('dataResponse','tracking_number',"trackingNumber"));
    }


    public function trackDhl(Request $request,$trackingNumber = null)
    {
        $request->validate([
            'tracking_number' => ['required', 'string', 'max:255'],
        ]);
        $tracking_number = $request->tracking_number;
        $curl = curl_init();

        $url_dhl = env('URL_DHL');

        curl_setopt_array($curl, [
            CURLOPT_URL => $url_dhl . $tracking_number,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "DHL-API-Key: ". env('DHL_API_Key')
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        } else {
          $data = json_decode($response, true);
          return view('track.dhl', compact('data','tracking_number','trackingNumber'));
        }
    }
}
