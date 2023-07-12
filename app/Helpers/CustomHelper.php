<?php

namespace App\Helpers;


class CustomHelper
{
    public static function generateBearerTokenFedex($client_id, $client_secret)
    {
         // Step 1: Generate the access token
         $curl = curl_init();

         curl_setopt_array($curl, array(
             CURLOPT_URL => env('URL_FEDEX_OAUTH'),
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => '',
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => 'POST',
             CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=" . $client_id ."&client_secret=" . $client_secret,
             CURLOPT_HTTPHEADER => array(
             'content-type: application/x-www-form-urlencoded',
             ),
         ));
 
         $response = curl_exec($curl);
 
         curl_close($curl);

         return $response;
 
    }

    public static function trackFedex($bearerToken,$tracking_number)
    {
        // Step 2: Make the second request with authorization
        $curl = curl_init();

        $data = '{
            "includeDetailedScans": true,
            "trackingInfo": [
                {
                    "trackingNumberInfo": {
                        "trackingNumber": "' . $tracking_number . '"
                    }
                }
            ]
        }';

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('URL_FEDEX_TRACK'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
            'content-type: application/json',
            'Authorization: Bearer ' . $bearerToken,
            ),
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);

        return $response;
    }

}
