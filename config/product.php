<?php

return [

    'productType' => [
        'A' => '하루이용권', // 시간관계없이 금일 마감시까지
        'T' => '시간권',   // 일단위 : 이름과, 일선택, 가격
        'D' => '기간권',   // 일단위 : 이름과, 일선택, 가격
        'P' => '정액권',   // 시간생성 : 이름과 시간, 가격
        'F' => '고정권',   // 일 1 입력후 자동 30일까지 생성 이름, 일/월
        //'K' => '사물함'    // 일요금, 단일.
    ],

    // productType 과 중복되지 않게
    'productTypeStudyRoom' => [
        'S' => '스터디룸', // 1회이용권동일 ( 성인 없고, 신규.기본.연장 )
    ],

    'productBuyType' => [
        'A' => '기본',
        'N' => '신규',
        'X' => '연장'
    ],

    'productAgeType' => [
        'S' => [
            'code' => 'student',
            'name' => '학생'
        ],
        'A' => [
            'code' => 'adult',
            'name' => '성인'
        ]
    ],

    'memberAgeType' => [
        'S' =>  '학생',
        'A' =>  '성인'
    ],

    'memberSexType' => [
        'M' =>  '남자',
        'F' =>  '여자'
    ],

    'memberFromType' => [
        'M' =>  '모바일',
        'A' =>  '가맹점',
    ]

];

?>