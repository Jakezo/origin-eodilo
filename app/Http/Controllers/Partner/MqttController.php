<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

class MqttController extends Controller
{

    public function put(Request $request){
        $mqtt = MQTT::connection();

        $mqtt->publish('19/C1', 'F0001', true, 'public');
        //, true , 'public'
    }

}