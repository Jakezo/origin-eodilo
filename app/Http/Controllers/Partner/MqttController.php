<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use PhpMqtt\Client\Facades\MQTT;

use Salman\Mqtt\MqttClass\Mqtt;
class MqttController extends Controller
{

    public function put(Request $request){
        // $mqtt = MQTT::connection();

        // $mqtt->publish('19/C0', 'O0017', true, 'public');
        // //, true , 'public'

        $topic = '19/C0';
        $message = "{snum:'O0017', id:'1'}";
        $client_id = "q";
        $mqtt = new Mqtt();
        $client_id = 1;
        $output = $mqtt->ConnectAndPublish($topic, $message, $client_id);
        dd($output);
        
        if ($output === true)
        {
            return "published";
        }
        
        return "Failed";
                
    }
}



// class MqttController extends Controller
// {

//     public function put(Request $request){
//          $mqtt = MQTT::connection();

//          $mqtt->publish("19/C0", "{snum:'O0017', id:'1'}", true, 'public');
//         // //, true , 'public'

//         //MQTT::publish('19/C0', "{snum:'O0017', id:'1'}", true, 'public');

//     }

// }