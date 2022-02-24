<?php

return [
    /*
    |--------------------------------------------------------------------------
    | NAVER CLOUD PLATFORM API
    |--------------------------------------------------------------------------
    |
    | Go to My Page > Manage Accoutn > Manage Auth Key
    | You can use a previously created authentication key or create a new api authentication key.
    |
    */
    'access_key' => env('NCLOUD_ACCESS_KEY', 'hfSRKJQsqJPPbeULrNz7'),
    'secret_key' => env('NCLOUD_SECRET_KEY', 'PetGINhs70gyted1fJPJCPoJIAOi7itI5HCEpXl1'),

    /*
     * Service ID issued when you add a project
     */
    'service_id' => 'ncp:kkobizmsg:kr:2740790:biz_msg',

    /*
     * KakaoTalk Channel ID ((Old) Plus Friend ID)
     */
    'plus_friend_id' => '@enha_boss',
];
