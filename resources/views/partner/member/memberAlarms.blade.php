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
                    <li class="breadcrumb-item active" aria-current="page">신규가입</li>
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
                    <form name="search" action="">
                        <input type="hidden" name="no" id="no" value="{{ $member['mb_no']  ?? '' }}">
                        <div class='row'>

                            <div class="col-lg-2 col-md-1 col-sm-3 col-xs-12 mt-1">
                                <input type="text" name="sdate" id="sdate" value="{{ $param["sdate"] }}" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                            </div>
                            <div class="col-lg-2 col-md-1 col-sm-3 col-xs-12 mt-1">
                                <input type="text" name="edate" id="edate" value="{{ $param["edate"] }}" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 mt-1">
                                <div class="col-12">
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-d") }}');$('#edate').val('<?=date('Y-m-d')?>');">금일</a>
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-01") }}');$('#edate').val('<?=date('Y-m-t')?>');">이달</a>
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-01-01") }}');$('#edate').val('<?=date('Y-12-31')?>');">금년</a>
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('');$('#edate').val('');">전체</a>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-6 mt-1">
                                <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                            </div>

                        </div>
                    </form>
                </div>                        

                <div class="card-body">
                    <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>                            
                    <table class="table mb-0 table-striped">
                        <thead>
                        <tr>
                            <th scope="col" class="col-1">#</th>
                            <th scope="col" class="col-1">구분</th>
                            <th scope="col" class="col-1">회원</th>
                            <th scope="col" class="col-2">제목</th>
                            <th scope="col" class="col-3">내용</th>
                            <th scope="col" class="col-1">발송일시</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( $alarms )
                        @foreach( $alarms as $ai => $alarm )  							
                        <tr>
                            <th scope="row">{{ ($start - $ai) }}</th>
                            <td>
                                @if($alarm['a_kind']=="P") 
                                앱푸쉬
                                @elseif($alarm['a_kind']=="M") 
                                문자
                                @elseif($alarm['a_kind']=="K") 
                                카카오
                                @endif
                            </td>
                            <td>{{ $alarm['nickname'] ?? ( $alarm['name'] ?? $alarm['email'])  }}</td>
                            <td>{{ $alarm['a_title'] }}</td>
                            <td>{{ $alarm['a_body'] }}</td>
                            <td>{{ $alarm['created_at'] }}</td>
                        </tr>
                        @endforeach
                        @endif     
                        </tbody>
                    </table>
                </div>
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
                <div class="card-body d-flex justify-content-center">
                    {{ $alarms->appends($param)->links() }}
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


    </script>

@endsection
