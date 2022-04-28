<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PartnerApplyController;
use App\Http\Controllers\PartnerRegController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\Custom2Controller;
use App\Http\Controllers\CustomdevController;
use App\Http\Controllers\CustomFaqController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Partner_ReviewController;
use App\Http\Controllers\PartnerCouponController;
use App\Http\Controllers\StandardProductController;
use App\Http\Controllers\StandardPriceController;
use App\Http\Controllers\VodboardController;
use App\Http\Controllers\HelpboardController;
use App\Http\Controllers\UserMessageController;

use App\Http\Controllers\Partner\MainController;
use App\Http\Controllers\Partner\FrenchBoardController;
use App\Http\Controllers\Partner\FrenchNoticeController;
use App\Http\Controllers\Partner\FrenchManagerController;
use App\Http\Controllers\Partner\FrenchEventController;
use App\Http\Controllers\Partner\FrenchCustomController;
use App\Http\Controllers\Partner\FrenchReviewController;
use App\Http\Controllers\Partner\FrenchContactController;
use App\Http\Controllers\Partner\FrenchLaptopController;
use App\Http\Controllers\Partner\FrenchMemberController;
use App\Http\Controllers\Partner\FrenchProductOrderController;
use App\Http\Controllers\Partner\FrenchReservationController;
use App\Http\Controllers\Partner\FrenchHistoryController;
use App\Http\Controllers\Partner\FrenchHelpboardController;
use App\Http\Controllers\Partner\FrenchVodboardController;
use App\Http\Controllers\Partner\FrenchStatisticsController;
use App\Http\Controllers\Partner\FrenchAccountBookController;

use App\Http\Controllers\Partner\SettingController;
use App\Http\Controllers\Partner\SettingIotController;
use App\Http\Controllers\Partner\SettingRoomController;
use App\Http\Controllers\Partner\SettingSeatLevelController;
use App\Http\Controllers\Partner\SettingSeatController;
use App\Http\Controllers\Partner\SettingLockerAreaController;
use App\Http\Controllers\Partner\SettingLockerController;
use App\Http\Controllers\Partner\SettingProductController;

use App\Http\Controllers\Partner\MqttController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Partner\FrenchLoginController;



use App\Http\Controllers\MobileController;


use App\Http\Middleware\Authenticate;
use App\Http\Middleware\PartnerAuthenticate;
use App\Http\Middleware\UserAuthenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::domain('mobile.boss.sogero.kr')->group(function () {
//     Route::get('/', [MobileController::class, 'index'])->name("userhome");    
//     Route::get('/mypage', function () {
//         return view('mobile.mypage');
//     });    


//     Route::get('/userlogin', [LoginController::class, 'showUserLoginForm'])->name("userlogin");
//     Route::post('/userloginok', [LoginController::class, 'userLogin']);
//     Route::get('/userlogout', [LoginController::class, 'userlogout']);
// });

Route::prefix('/mqtt')->group(function () {
    Route::any('/put', [MqttController::class, 'put']);
});

Route::domain('api.eodilo.com')->group(function () {
    Route::get('/partner/get_list', [PartnerController::class, 'get_list']);
});

// 시스템관리자
Route::domain('admin.eodilo.com')->group(function () {

    /*
        Route::get('/', function () {
            return Inertia::render('Welcome', [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);
        });
        Auth::routes();
    */
    //  Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //      return Inertia::render('Dashboard');
    //  })->name('dashboard');


    Route::get('/adminlogin', [LoginController::class, 'showAdminLoginForm'])->name("adminlogin");
    Route::post('/adminloginok', [LoginController::class, 'adminLogin']);
    Route::get('/logout', [AdminController::class, 'logout']);

    //Auth::routes();

    Route::prefix('/api')->group(function () {

        Route::any('/partner/search', [PartnerController::class, 'search']);
        Route::get('/partner/get_list', [PartnerController::class, 'get_list']);
        Route::any('/partner/get_new_last_date', [PartnerController::class, 'get_new_last_date']);

    });

    Route::prefix('/nmap')->group(function () {
        Route::any('/nmap_get_point', [PartnerController::class, 'nmap_get_point']);
    });


    Route::group(['middleware' => ['admin']], function () {

        Route::get('/', [IndexController::class, 'index'])->name("adminhome");
        Route::get('index2', [IndexController::class, 'index2']);

        Route::get('/history', function () {
            return view('admin.history');
        });

        Route::group(['prefix' => '/partner'],function () {

            //Route::any('/login', [PartnerController::class, 'login']);
            Route::get('/form/{no?}',  [PartnerController::class, 'form']);
            Route::get('/photo/{no?}',  [PartnerController::class, 'photo']);
            Route::post('/photo/{no?}/upload',  [PartnerController::class, 'photo_upload']);
            Route::post('/photo/{no?}/list',  [PartnerController::class, 'photo_list']);
            Route::post('/photo/{no?}/delete',  [PartnerController::class, 'photo_delete']);

            Route::any('/update', [PartnerController::class, 'update']);
            Route::any('/delete', [PartnerController::class, 'delete']);

            Route::get('/apply', [PartnerApplyController::class, 'index']);
            Route::any('/apply/store', [PartnerApplyController::class, 'store']);

            Route::get('/reg', [PartnerRegController::class, 'index']);

            Route::any('/reg/update', [PartnerRegController::class, 'update']);

            // Route::get('/standard', function () {
            //     return view('admin.partner.standard');
            // });

            Route::any('/set_favorite',  [PartnerController::class, 'set_favorite']);
            Route::any('/set_visit',  [PartnerController::class, 'set_visit']);
            
            Route::group(['prefix' => '/standard'],function () {

                Route::get('/' ,function () {
                    return view('admin.partner.standard');
                });

                Route::prefix('/price')->group(function () {
                    Route::any('/', [StandardPriceController::class, 'index']);
                    Route::any('/update', [StandardPriceController::class, 'update']);
                });

                Route::prefix('/product')->group(function () {
                    Route::any('/', [StandardProductController::class, 'index']);
                    Route::any('/update', [StandardProductController::class, 'update']);
                });
            });

            Route::get('/', [PartnerController::class, 'index']);
            Route::get('/deleted', [PartnerController::class, 'deleted_index']);
        });

        Route::prefix('/member')->group(function () {
            Route::get('/list',  [UserController::class, 'index']);            
            Route::get('/form/{id?}',  [UserController::class, 'form']);
            Route::any('/update', [UserController::class, 'update']);
            Route::get('/sms', [UserMessageController::class, 'index']);
            Route::get('/buy', function () {
                return view('admin.member.buy_list');
            });
            Route::get('/refund', function () {
                return view('admin.member.refund_list');
            });
        });

        Route::prefix('/statistics')->group(function () {

            Route::get('/day', function () {
                return view('admin.statistics.day');
            });
            Route::get('/month', function () {
                return view('admin.statistics.month');
            });

        });

        Route::prefix('/calculate')->group(function () {
            Route::get('/day', function () {
                return view('admin.calculate.day');
            });
            Route::get('/month', function () {
                return view('admin.calculate.month');
            });
        });

        Route::prefix('/community')->group(function () {

            Route::get('/review', [Partner_ReviewController::class, 'index']);
            Route::any('/review/add', [Partner_ReviewController::class, 'store']);

            Route::get('/faq', [CustomFaqController::class, 'index']);
            Route::any('/faq/getInfo', [CustomFaqController::class, 'getInfo']);
            Route::get('/faq/view/{no}', [CustomFaqController::class, 'view']);
            Route::post('/faq/update', [CustomFaqController::class, 'update']);
            Route::post('/faq/delete', [CustomFaqController::class, 'delete']);
            
            Route::get('/{b_id}', [BoardController::class, 'index']);
            Route::get('/{b_id}/form/{no?}', [BoardController::class, 'form']);
            Route::get('/{b_id}/view/{no?}', [BoardController::class, 'form']);
            Route::post('/{b_id}/update', [BoardController::class, 'update']);

        });

        Route::prefix('/event')->group(function () {
            Route::post('/getInfo', [EventController::class, 'getInfo']);

            // 가맹점이벤트
            Route::get('/partner', [EventController::class, 'index_partner']);

            // 전체이벤트
            Route::get('/list', [EventController::class, 'index']);

            Route::post('/update', [EventController::class, 'update']);
        });

        Route::prefix('/coupon')->group(function () {
            Route::get('/' ,[CouponController::class, 'index']);
            Route::any('/getInfo', [CouponController::class, 'getInfo']);
            Route::post('/update', [CouponController::class, 'update']);
            Route::post('/delete', [CouponController::class, 'delete']);
        });

        Route::prefix('/customer')->group(function () {
            Route::get('/partner', [Custom2Controller::class, 'index']);
            Route::get('/partner/view/{no}', [Custom2Controller::class, 'view']);
            Route::post('/partner/update', [Custom2Controller::class, 'update']);
            Route::post('/partner/answer', [Custom2Controller::class, 'answer']);

            Route::get('/member', [CustomController::class, 'index']);
            Route::get('/member/view/{no}', [CustomController::class, 'view']);
            Route::post('/member/update', [CustomController::class, 'update']);
            Route::post('/member/answer', [CustomController::class, 'answer']);

            Route::get('/dev', [CustomdevController::class, 'index']);
            Route::get('/dev/view/{no}', [CustomdevController::class, 'view']);
            Route::get('/dev/answerform/{no}', [CustomdevController::class, 'answerform']);
            Route::post('/dev/update', [CustomdevController::class, 'update']);
            Route::post('/dev/delete', [CustomdevController::class, 'delete']);
            Route::post('/dev/answer', [CustomdevController::class, 'answer']);
        });

        Route::prefix('/comments')->group(function () {
            Route::any('update', [CustomdevController::class, 'comm_update']);
            Route::any('delete', [CustomdevController::class, 'comm_delete']);
            Route::any('list', [CustomdevController::class, 'comm_list']);
        });

        Route::prefix('/manual')->group(function () {

            Route::get('/board', [HelpboardController::class, 'index']);
            Route::get('/board/form/{no?}', [HelpboardController::class, 'form']);
            Route::any('/board/update', [HelpboardController::class, 'update']);

            Route::get('/vod', [VodboardController::class, 'index']);
            Route::get('/vod/form/{no?}', [VodboardController::class, 'form']);
            Route::any('/vod/update', [VodboardController::class, 'update']);

        });

        Route::prefix('/emp')->group(function () {
            Route::get('/', [AdminController::class, 'index']);
            Route::post('/getInfo', [AdminController::class, 'getInfo']);
            Route::any('/update', [AdminController::class, 'store']);
            Route::post('/delete', [AdminController::class, 'delete']);
        });

    });   



});


// 시스템관리자
Route::domain('{account}.partner.eodilo.com')->group(function () {

    Route::prefix('/partner_api')->group(function () {
        Route::get('/room/get_list', [SettingRoomController::class, 'get_list']);
        Route::any('/seat_level/get_list', [SettingSeatLevelController::class, 'get_list']);
        Route::get('/locker_area/get_list', [SettingLockerAreaController::class, 'get_list']);

        Route::any('/seat/editor_getMapInfo', [SettingSeatController::class, 'editor_getMapInfo']);
    });

    Route::group(['prefix' => '/reservation'],function () {
        Route::any('/getSeatInfo', [FrenchReservationController::class, 'getSeatInfo']);

        // 예약
        Route::any('/reserveSeat', [FrenchReservationController::class, 'reserveSeat']);
    });

    // Route::prefix('/mqtt')->group(function () {
    //     Route::any('/put', [MqttController::class, 'put']);
    // });

    Route::get('/noPartner', function () {
        return view('nopartner.nopartner');
    });

    Route::get('/partnerlogin', [FrenchLoginController::class, 'showPartnerLoginForm'])->name("partnerlogin");
    Route::post('/partnerloginok', [FrenchLoginController::class, 'partnerLogin']);
    Route::get('/logout', [FrenchLoginController::class, 'logout']);

    Route::any('/editor/update', [SettingSeatController::class, 'map_save']);
    
    Route::group(['middleware' => ['partner']], function () {

        Route::get('/', [MainController::class, 'main'])->name("partnerhome");
        Route::get('/seatState', [FrenchReservationController::class, 'seatState']);

        Route::get('/history', [FrenchHistoryController::class, 'order_list']);
        Route::get('/history/orders', [FrenchHistoryController::class, 'order_list']);
        Route::get('/history/reservs', [FrenchHistoryController::class, 'reserv_list']);

        Route::prefix('/member')->group(function () {

            Route::any('/popupReg', [FrenchMemberController::class, 'regForm']);
            Route::any('/popupInfo', [FrenchMemberController::class, 'viewInfo']);

            Route::any('/list', [FrenchMemberController::class, 'index']);
            Route::any('/search', [FrenchMemberController::class, 'search']);
            Route::any('/update', [FrenchMemberController::class, 'update']);
            Route::any('/delete', [FrenchMemberController::class, 'delete']);
            Route::any('/getInfo', [FrenchMemberController::class, 'getInfo']);
            Route::any('/productsList', [FrenchMemberController::class, 'productsList']);
            Route::any('/productState', [FrenchMemberController::class, 'productState']); // 상품구매

            Route::get('/sms', function () {
                return view('partner.member.sms_list');
            });
            Route::get('/refund', function () {
                return view('partner.member.refund_list');
            });
        });

        Route::prefix('/product')->group(function () {
            Route::any('/setSeatLevel', [FrenchProductOrderController::class, 'setSeatLevel']); // 상품구매
            Route::any('/buyProduct', [FrenchProductOrderController::class, 'buyProduct']); // 상품구매
            Route::any('/searchLocker', [SettingLockerController::class, 'searchLocker']); // 좌석검색
        });

        Route::prefix('/statistics')->group(function () {
            Route::any('/day', [FrenchStatisticsController::class, 'sales_day']); // 일매출
            Route::any('/month', [FrenchStatisticsController::class, 'sales_month']); // 월매출
        });

        Route::prefix('/calculate')->group(function () {
            Route::get('/day', function () {
                return view('partner.calculate.day');
            });
            Route::get('/month', function () {
                return view('partner.calculate.month');
            });
        });

        Route::prefix('/cash')->group(function () {
            Route::get('/', [FrenchAccountBookController::class, 'index']);
            Route::any('/getInfo', [FrenchAccountBookController::class, 'getInfo']);
            Route::any('/update', [FrenchAccountBookController::class, 'update']);
            Route::any('/delete', [FrenchAccountBookController::class, 'delete']);

            Route::any('/div/update', [FrenchAccountBookController::class, 'div_update']); // 항목저장
            Route::any('/div/delete', [FrenchAccountBookController::class, 'div_delete']); // 항목삭제
            Route::any('/div/list', [FrenchAccountBookController::class, 'div_list']); // 항목리스트
        });

        Route::prefix('/event')->group(function () {
            Route::get('/' ,[FrenchEventController::class, 'index']);
            Route::post('/getInfo', [FrenchEventController::class, 'getInfo']);
            Route::post('/update', [FrenchEventController::class, 'update']);
        });

        Route::prefix('/coupon')->group(function () {
            Route::get('/' ,[PartnerCouponController::class, 'index']);
            Route::post('/getInfo', [PartnerCouponController::class, 'getInfo']);
            Route::post('/update', [PartnerCouponController::class, 'update']);
            Route::post('/delete', [PartnerCouponController::class, 'delete']);
        });

        Route::prefix('/work')->group(function () {

            Route::get('/work_board', [FrenchBoardController::class, 'index']);
            Route::get('/work_board/form/{no?}', [FrenchBoardController::class, 'form']);
            Route::get('/work_board/view/{no?}', [FrenchBoardController::class, 'view']);
            Route::post('/work_board/update', [FrenchBoardController::class, 'update']);

            Route::get('/day_end', function () {
                return view('partner.work.day_end');
            });
            Route::get('/entry_exit', function () {
                return view('partner.work.entry_exit');
            });
            Route::get('/remaining_time', function () {
                return view('partner.work.remaining_time');
            });
        });

        Route::prefix('/comments')->group(function () {
            Route::any('update', [FrenchBoardController::class, 'comm_update']);
            Route::any('delete', [FrenchBoardController::class, 'comm_delete']);
            Route::any('list', [FrenchBoardController::class, 'comm_list']);
        });

        Route::prefix('/article')->group(function () {
            Route::get('/laptop' ,[FrenchLaptopController::class, 'index']);
            Route::post('/laptop/update', [FrenchLaptopController::class, 'update']);
            Route::post('/laptop/getInfo', [FrenchLaptopController::class, 'getInfo']);

            Route::get('/contact' ,[FrenchContactController::class, 'index']);
            Route::post('/contact/update' ,[FrenchContactController::class, 'update']);
            Route::post('/contact/getInfo' ,[FrenchContactController::class, 'getInfo']);
        });

        Route::prefix('/community')->group(function () {
            Route::get('/{b_id}', [FrenchNoticeController::class, 'index']);
            Route::get('/{b_id}/form/{no?}', [FrenchNoticeController::class, 'form']);
            Route::get('/{b_id}/view/{no?}', [FrenchNoticeController::class, 'view']);
            Route::post('/{b_id}/update', [FrenchNoticeController::class, 'update']);
        });

        Route::prefix('/customer')->group(function () {

            // Route::get('/board/notice', [FrenchNoticeController::class, 'index'],['b_id' => 'notice']);
            // Route::post('/board/notice/view', [FrenchNoticeController::class, 'view'],['b_id' => 'notice']);

            Route::get('/review', [FrenchReviewController::class, 'index']);

            Route::get('/form', function () {
                return view('partner.customer.form');
            });

            Route::get('/qna' ,[FrenchCustomController::class, 'index']);
            Route::get('/qna/view/{no}', [FrenchCustomController::class, 'view']);
            Route::post('/qna/update', [FrenchCustomController::class, 'update']);
            Route::get('/qna/form/{no?}', [FrenchCustomController::class, 'edit']);

        });

        Route::prefix('/manual')->group(function () {
            Route::get('/board', [FrenchHelpboardController::class, 'index']);
            Route::get('/board/view/{no?}', [FrenchHelpboardController::class, 'view']);
            Route::any('/board/update', [FrenchHelpboardController::class, 'update']);

            Route::get('/vod', [FrenchVodboardController::class, 'index']);
            Route::get('/vod/form/{no?}', [FrenchVodboardController::class, 'form']);
            Route::get('/vod/gethtml/{no?}', [FrenchVodboardController::class, 'gethtml']);
            Route::any('/vod/update', [FrenchVodboardController::class, 'update']);
        });

        Route::prefix('/setting')->group(function () {

            Route::get('/info', [SettingController::class, 'info']);    // 정보폼
            //return view('partner.setting.info');

            Route::post('/infoUpdate', [SettingController::class, 'info_update']);    // 정보업데이트

            Route::prefix('/iot')->group(function () {
                Route::any('/', [SettingIotController::class, 'index']);
                Route::any('/getInfo', [SettingIotController::class, 'getInfo']);
                Route::post('/update', [SettingIotController::class, 'update']);
                Route::post('/delete', [SettingIotController::class, 'delete']);                

            });

            Route::prefix('/emp')->group(function () {
                Route::get('/', [FrenchManagerController::class, 'index']);
                Route::post('/getInfo', [FrenchManagerController::class, 'getInfo']);
                Route::any('/update', [FrenchManagerController::class, 'store']);
                Route::post('/delete', [FrenchManagerController::class, 'delete']);
            });

            Route::prefix('/room')->group(function () {
                Route::get('/', [SettingRoomController::class, 'index']);
                Route::any('/getInfo', [SettingRoomController::class, 'getInfo']);
                Route::post('/update', [SettingRoomController::class, 'update']);
                Route::post('/delete', [SettingRoomController::class, 'delete']);
            });

            Route::prefix('/seat_level')->group(function () {
                Route::get('/', [SettingSeatLevelController::class, 'index']);
                Route::any('/getInfo', [SettingSeatLevelController::class, 'getInfo']);
                Route::post('/update', [SettingSeatLevelController::class, 'update']);
                Route::post('/delete', [SettingSeatLevelController::class, 'delete']);

                Route::any('/price_make', [SettingSeatLevelController::class, 'price_make']);
                Route::any('/price_save', [SettingSeatLevelController::class, 'price_save']);

                Route::any('/getStandardPrice', [SettingSeatLevelController::class, 'getStandardPrice']);
            });

            Route::prefix('/seat')->group(function () {
                Route::get('/', [SettingSeatController::class, 'index']);
                Route::post('/update', [SettingSeatController::class, 'update']);
                Route::post('/delete', [SettingSeatController::class, 'delete']);
                Route::post('/getInfo', [SettingSeatController::class, 'getInfo']);
                Route::post('/changeLevel', [SettingSeatController::class, 'changeLevel']);

                Route::get('/editor', [SettingSeatController::class, 'editor']);
                Route::any('/editor/update', [SettingSeatController::class, 'map_save']);
                Route::any('/editor/bg_upload', [SettingSeatController::class, 'map_bg_upload']);
            });

            Route::prefix('/locker_area')->group(function () {
                Route::get('/', [SettingLockerAreaController::class, 'index']);
                Route::any('/update', [SettingLockerAreaController::class, 'update']);
                Route::post('/delete', [SettingLockerAreaController::class, 'delete']);
                Route::post('/getInfo', [SettingLockerAreaController::class, 'getInfo']);
            });

            Route::prefix('/locker')->group(function () {
                Route::get('/', [SettingLockerController::class, 'index']);
                Route::any('/update', [SettingLockerController::class, 'update']);
                Route::post('/delete', [SettingLockerController::class, 'delete']);
                Route::post('/getInfo', [SettingLockerController::class, 'getInfo']);

                Route::get('/map_editor', function () {
                    return view('partner.setting.locker_map_editor');
                });
            });

            Route::prefix('/product')->group(function () {
                Route::any('/', [SettingProductController::class, 'index']);
                Route::any('/update', [SettingProductController::class, 'update']);
                Route::any('/getStandardProduct', [SettingProductController::class, 'getStandardProduct']);

                Route::any('/getProduct', [SettingProductController::class, 'getProduct']); // 상품목록가져오기
            });

        });
    });


});//->middleware(\App\Http\Middleware\CheckPartner::class)

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
