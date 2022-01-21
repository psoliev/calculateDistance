<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MoveMoveIo\DaData\Enums\Language;
use MoveMoveIo\DaData\Facades\DaDataAddress;

class ApiFunctionController extends Controller
{
    function getaddress(Request $request){
        $_location = $request->input('_location');

        if(!isset($_location)){
            return [];
        }

        $dadata = DaDataAddress::prompt($_location, 10, Language::RU);

        $mas = [];
        if(isset($dadata['suggestions']) and count($dadata['suggestions'])>0){
            foreach($dadata['suggestions'] as $key=>$addresses){
                $mas[$key] = $addresses['value'];
            }
        }

        return $mas;
    }
}
