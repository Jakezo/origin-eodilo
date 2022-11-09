<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.manager')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <!--p>This is appended to the master sidebar.</p-->
@endsection

@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">업무관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">업무마감</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button class="btn btn-xs btn-danger btn_manual" rel="10"><i class="lni lni-youtube"></i>도움말</button>
                </div>
            </div>
            <!--end breadcrumb-->

            <!--end row-->
            <div class="row">
                <form method="post" name="form1" id="form1" class="row g-3">
                {{csrf_field()}}
                <input type="hidden" name="mode" value="modify">
                <div class="col-12 d-lg-flex align-items-lg-stretch">
                    <div class="card radius-10">
                        <div class="card-body">
                            <h4>2020 년 07월 20일 업무마감</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="command1" name="command1">
                                <label class="form-check-label" for="gridCheck2">고정석 입실된 회원을 모두 퇴실 및 소등 시키고 고정석 회원 상태를 결석으로 초기화</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="command2" name="command2">
                                <label class="form-check-label" for="gridCheck2">좌석 조명을 전체 소등</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="command3" name="command3">
                                <label class="form-check-label" for="gridCheck2">시간제 업무 마감 진행(체크시 시간제를 사용하는 모든 좌석이 퇴실 처리 되며 해당 좌석의 조명이 소등됩니다.)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="command4" name="command4">
                                <label class="form-check-label" for="gridCheck2">IOT 기기 종료</label>
                            </div>

                            <div class="row col-12 mt-3">
                                <div class="col-12">
                                    <div class="alert alert-warning">
                                        <div>* 업무마감 시작 버튼을 클릭후 확인을 누르시면 업무마감이 시작됩니다.</div>
                                        <div>* 지문인식기 명령 미처리건수, 조명 명령 미처리건수가 0이; 되어야 업무마감 완료입니다.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-warning px-5" id="btn_day_end">업무마감</button>
                            </div>


                            <div class="row col-12 mt-3">
                                <div class="col-12">
                                    <div class="alert alert-secondary">
                                        <div style="font-size:1.1rem">지문인식기 명령 미처리건수 : 0건</div>
                                        <div style="font-size:1.1rem">조명 명령 미처리건수 : 0건</div>
                                    </div>
                                </div>
                                <div class="col-12" id="result_msg">

                                </div>
                            </div>


                        </div>


                    </div>
                </div>
                </form>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection



@section('javascript')
<script>
var is_start = false;

$(document).ready(function () {
    $(document).on("click", "#btn_day_end", function () {
        if( is_start ) {
            day_end('start')
        } else {
            day_end('stop')
        }
    });
});

function day_end(mode) {
    var form = $('#form1')[0];
    var formData = new FormData(form);
    formData.append("mode",mode);

    $.ajax({
        url: '/work/day_end/action/'+mode,
        processData: false,
        contentType: false,
        data: formData,                
        type: 'POST',
        async: true,
        beforeSend: function (xhr) {
            $("#result_msg").html("");
        },
        data: formData,
        success: function (res, textStatus, xhr) {
            if (res.result == true) {
                document.location.reload();
            } else {
                $("#result_msg").html(res.message);
                console.log("실패.");
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log('PUT error.');
        }
    });
}

</script>
@endsection