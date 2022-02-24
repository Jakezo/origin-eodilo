<?php

namespace App\Http\Controllers;

use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Http\Request;

class MqqtController extends Controller
{
    public function put(Request $request){
        MQTT::publish('19/C1', 'F0001');
    }
}
