<?php
return [
	'host'      => env('mqtt_host','118.67.142.63'),
    'password'  => env('mqtt_password',''),
    'username'  => env('mqtt_username',''),
    'certfile'  => env('mqtt_cert_file',''),
    'localcert' => env('mqtt_local_cert', ''),
    'localpk'   => env('mqtt_local_pk', ''),
    'port'      => env('mqtt_port','1883'),
    'debug'     => env('mqtt_debug',true), //Optional Parameter to enable debugging set it to True
    'qos'       => env('mqtt_qos', 0), // set quality of service here
    'retain'    => env('mqtt_retain', 0) // it should be 0 or 1 Whether the message should be retained.- Retain Flag
];
?>