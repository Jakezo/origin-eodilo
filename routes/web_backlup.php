<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\Custom2Controller;
use App\Http\Controllers\CustomdevController;


use App\Http\Controllers\Partner\MainController;
use App\Http\Controllers\Partner\SettingController;

//kernel . use App\Http\Middleware\CheckPartner;
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


/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::domain('api.boss.sogero.kr')->group(function () {
    Route::get('/partner/get_list', [PartnerController::class, 'get_list']);
});

Route::domain('admin.boss.sogero.kr')->group(function () {

        Route::get('/', function () {
            return view('super.index');
        });

        Route::get('/history', function () {
            return view('super.history');
        });

        Route::prefix('/partner')->group(function () {

            Route::get('/', [PartnerController::class, 'index']);

            Route::get('/form/{no?}',  [PartnerController::class, 'form']);

            Route::any('/update', [PartnerController::class, 'update']);

            Route::get('/apply', function () {
                return view('super.partner.apply');
            });
            Route::get('/reg', function () {
                return view('super.partner.reg');
            });
            Route::get('/standard', function () {
                return view('super.partner.standard');
            });
        });

        Route::prefix('/member')->group(function () {
            Route::get('/list', function () {
                return view('super.member.list');
            });
            Route::get('/sms', function () {
                return view('super.member.sms_list');
            });
            Route::get('/buy', function () {
                return view('super.member.buy_list');
            });
            Route::get('/refund', function () {
                return view('super.member.refund_list');
            });
        });

        Route::prefix('/statistics')->group(function () {
            Route::get('/day', function () {
                return view('super.statistics.day');
            });
            Route::get('/month', function () {
                return view('super.statistics.month');
            });
        });

        Route::prefix('/calculate')->group(function () {
            Route::get('/day', function () {
                return view('super.calculate.day');
            });
            Route::get('/month', function () {
                return view('super.calculate.month');
            });
        });

        Route::prefix('/community')->group(function () {
            Route::get('/{b_id}', [BoardController::class, 'index']);
/*
            Route::get('/qna', function () {
                return view('super.community.qna_list');
            });
            Route::get('/review', function () {
                return view('super.community.review_list');
            });
*/
            Route::any('/{b_id}/update', [BoardController::class, 'update']);

            Route::get('/{b_id}/form/{no?}', [BoardController::class, 'form']);
        });

        Route::prefix('/event')->group(function () {
            Route::get('/partner', function () {
                return view('super.event.event_partner');
            });
            Route::get('/list', function () {
                return view('super.event.event_list');
            });
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


        Route::prefix('/manual')->group(function () {
            Route::get('/board', function () {
                return view('super.manual.manual_board');
            });
            Route::get('/vod', function () {
                return view('super.manual.manual_vod');
            });
        });

        Route::prefix('/emp')->group(function () {
            Route::post('/getInfo', [AdminController::class, 'getInfo']);
            Route::post('/update', [AdminController::class, 'store']);
            Route::post('/delete', [AdminController::class, 'delete']);
            Route::get('/', [AdminController::class, 'index'])->name('super.emp.list');
            /*
            Route::get('/', function () {
                return view('super.emp.list');
            });
            */
        });

        Route::prefix('/api')->group(function () {
            Route::get('/partner/get_list', [PartnerController::class, 'get_list']);
        });
});



Route::domain('{account}.boss.sogero.kr')->group(function () {

    Route::get('/noPartner', function () {
        return view('nopartner.nopartner');
    });

    Route::get('/', [MainController::class, 'main']);


    Route::prefix('/member')->group(function () {
        Route::get('/list', function () {
            return view('partner.member.list');
        });
        Route::get('/sms', function () {
            return view('partner.member.sms_list');
        });
        Route::get('/refund', function () {
            return view('partner.member.refund_list');
        });
    });

    Route::prefix('/statistics')->group(function () {
        Route::get('/day', function () {
            return view('partner.statistics.day');
        });
        Route::get('/month', function () {
            return view('partner.statistics.month');
        });
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
        Route::get('/', function () {
            return view('partner.cash.list');
        });
    });

    Route::prefix('/event')->group(function () {
        Route::get('/', function () {
            return view('partner.event.event_list');
        });
    });

    Route::prefix('/work')->group(function () {
        Route::get('/day_end', function () {
            return view('partner.work.day_end');
        });
        Route::get('/entry_exit', function () {
            return view('partner.work.entry_exit');
        });
        Route::get('/remaining_time', function () {
            return view('partner.work.remaining_time');
        });
        Route::get('/work_diary', function () {
            return view('partner.work.work_diary');
        });
    });

    Route::prefix('/article')->group(function () {
        Route::get('/laptop', function () {
            return view('partner.article.laptop');
        });
        Route::get('/contact', function () {
            return view('partner.article.contact');
        });
    });

    Route::prefix('/community')->group(function () {
        Route::get('/notice', function () {
            return view('partner.community.notice_list');
        });
        Route::get('/qna', function () {
            return view('partner.community.qna_list');
        });
        Route::get('/review', function () {
            return view('partner.community.review_list');
        });


        Route::get('/form', function () {
            return view('partner.community.form');
        });
    });

    Route::prefix('/manual')->group(function () {
        Route::get('/board', function () {
            return view('partner.manual.manual_board');
        });
        Route::get('/vod', function () {
            return view('partner.manual.manual_vod');
        });
    });

    Route::prefix('/setting')->group(function () {


        Route::get('/info', [SettingController::class, 'info']);    // 정보폼
            //return view('partner.setting.info');

        Route::post('/infoUpdate', [SettingController::class, 'info_update']);    // 정보업데이트



        Route::get('/iot', function () {
            return view('partner.setting.iot');
        });
        Route::get('/emp', function () {
            return view('partner.setting.emp');
        });


        Route::get('/room', function () {
            return view('partner.setting.room');
        });
        Route::get('/seat_level', function () {
            return view('partner.setting.seat_level');
        });
        Route::get('/seat', function () {
            return view('partner.setting.seat');
        });

        Route::get('/locker_area', function () {
            return view('partner.setting.locker_area');
        });
        Route::get('/locker', function () {
            return view('partner.setting.locker');
        });
        Route::get('/locker_map_editor', function () {
            return view('partner.setting.locker_map_editor');
        });
        Route::get('/product', function () {
            return view('partner.setting.product');
        });
    });

});//->middleware(\App\Http\Middleware\CheckPartner::class)


