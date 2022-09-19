@extends('layouts.manager_popup')

@section('title', 'Page Title')

@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">회원정보</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    @if( isset( $member['name'] ) )
                    <li class="breadcrumb-item active" aria-current="page">{{ $member['name']  ?? '' }} ({{ $member['id']  ?? '' }})</li>
                    @else
                    <li class="breadcrumb-item active" aria-current="page">이용내역</li>
                    @endif
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
       
        <div class="col">

            <ul class="nav nav-tabs nav-primary navbar-sm" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/member_info?no={{ $member['mb_no'] }}" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                            </div>
                            <div class="tab-title">기본정보</div>
                        </div>
                    </a>
                </li>             
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/member_buyProducts?no={{ $member['mb_no'] }}" role="tab" aria-selected="true">

                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                            </div>
                            <div class="tab-title">구매내역</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/member_reserveSeats?no={{ $member['mb_no'] }}" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">이용내역</div>
                        </div>
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/member_alarms?no={{ $member['mb_no'] }}" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">알람내역</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#points" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">포인트</div>
                        </div>
                    </a>
                </li>          
            </ul>
            
            
            <div class="card">
                <div class="card-body">

                    <table class="table mb-0 table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">이용번호</th>
                            <th scope="col">사용자명</th>
                            <th scope="col">룸/좌석</th>
                            <th scope="col">사물함</th>
                            <th scope="col">상태</th>
                            <th scope="col">좌석상태</th>
                            <th scope="col">입실/퇴실시간</th>
                            <th scope="col">등록/신청일시</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( $reserves )
                        @foreach( $reserves as $ri => $reserve )                                       
                        <tr>
                            <th scope="row">{{ ($start - $ri) }}</th>
                            <td>{{ $reserve['rv_no'] }}</td>
                            <td member="{{ $reserve['o_member'] }}">
                                <span class="btn btn-xs @if( $reserve['rv_ageType'] == "S") btn-student @else btn-adult @endif">
                                   @if( $reserve['rv_ageType'] =="S" ) 학생 @else 성인 @endif
                                </span>
                                <span class="btn btn-xs @if( $reserve['rv_sex'] == "F") btn-female @else btn-male @endif">
                                    @if( $reserve['rv_ageType'] == "F" ) 여성 @else 남성 @endif
                                </span>
                                {{ $reserve['rv_member_name'] }}
                            </td>
                            <td>@if( isset($reserve['rv_room']) )<span room="{{ $reserve['rv_room'] }}">{{ $reserve['r_name'] }} / </span> @endif  <span seat="{{ $reserve['s_name'] }}">{{ $reserve['rv_seat'] }}</span></td>
                            <td>{{ $reserve['rv_locker'] }}</td>
                            <td>
                                @if($reserve['rv_state'] == "A") 
                                    <span class="btn btn-xs btn-warning btn-R" data-bs-toggle="modal" data-bs-target="#useInfoModal">예약</span>
                                @elseif($reserve['rv_state'] == "U") 
                                    <span class="btn btn-xs btn-primary btn-U" data-bs-toggle="modal" data-bs-target="#useInfoModal">사용중</span>
                                @elseif($reserve['rv_state'] == "X") 
                                    <span class="btn btn-xs btn-secondary btn-X" data-bs-toggle="modal" data-bs-target="#useInfoModal">종료</span>
                                @endif
                            </td>
                            <td>
                                @if($reserve['rv_state_seat'] == "IN") 
                                    <span class="btn btn-xs btn-in">{{ $reserve['rv_state_seat'] }}</span>
                                @elseif($reserve['rv_state_seat'] == "OUT") 
                                    <span class="btn btn-xs btn-out">{{ $reserve['rv_state_seat'] }}</span>
                                @endif
                            </td>
                            <td>{{ substr($reserve['rv_sdate'],5,11) }} ~ {{ substr($reserve['rv_edate'],5,11) }}</td>
                            <td>{{ $reserve['created_at'] }}</td>
                        </tr>
                        @endforeach
                        @endif                                    

                        </tbody>
                    </table>

                </div>                
                <div class="card-body d-flex justify-content-center">
                    {{ $reserves->appends($param)->links() }}
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>

@endsection

@section('javascript')
@section('javascript')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function formcheck(){
            $("#userErrMsg").html("").addClass("d-none");

            formData = $("#form1").serialize();
            console.log(formData); 
            $.ajax({
                url: '/member/update',
                data: formData,
                type: 'POST',
                success: function (res) {
                    console.log(res);
                    if (res.result == true) {
                        if (res.rURL != undefined) {
                            document.location.href = res.rURL;
                        } else {
                            document.location.reload();
                        }
                    } else {
                        $("#userErrMsg").html(res.message).removeClass("d-none");
                    }
                },
                error: function(xhr, status, msg){
                    ajax_error(xhr.responseJSON)
                }
            });
        }

    </script>

@endsection
