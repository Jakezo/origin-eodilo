<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <!--p>This is appended to the master sidebar.</p-->
@endsection

@section('content')

    <!--start page wrapper -->
    <script language="javaScript" src="/module/nmap/nmap.js" type="text/javascript"></script>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">업체정보관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">업체정보</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">

                <div class="card-body">
                    <h5 class="mb-0 text-primary">
                        @if( $partner && $partner["p_no"] )
                        가맹점명 {{ $partner["p_name"] }}
                        @endif
                    </h5>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs nav-primary" role="tablist">
                        <li class="nav-item" role="presentation"
                        onclick="location.href='/partner/form/{{ $partner["p_no"] }}'">
                            <a class="nav-link" data-bs-toggle="tab" href="/partner/form/{{ $partner["p_no"] }}"
                               role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-home font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">가맹점정보</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation"
                        onclick="location.href='/partner/photo/{{ $partner["p_no"] }}'">
                            <a class="nav-link" data-bs-toggle="tab" href="/partner/photo/{{ $partner["p_no"] }}"
                               role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">가맹점사진정보</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation"
                        onclick="location.href='/partner/reserve/{{ $partner["p_no"] }}'">
                            <a class="nav-link active" data-bs-toggle="tab" href="#"
                               role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-microphone font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">이용현황</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation"
                        onclick="location.href='/partner/calculate/{{ $partner["p_no"] }}'">
                            <a class="nav-link" data-bs-toggle="tab" href="#"
                               role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bxs-microphone font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">정산내역</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <form name="search" action="{{ $PHP_SELF ?? '' }}?>">
                        <div class='row'>
                            <div class="col-md-5 col-sm-12 col-xs-12 mt-1">
                                <div class="row">
                                    <div class="col-6">
                                        <select class="single-select form-control-sm col-12" name="state" id="state">
                                            <option value="">사용여부전체</option>
                                            <option value="A" @if ( isset($param['state']) && $param['state'] == "A" ) selected @endif>사용전</option>
                                            <option value="N" @if ( isset($param['state']) && $param['state'] == "N" ) selected @endif>사용중</option>
                                            <option value="Y" @if ( isset($param['state']) && $param['state'] == "Y" ) selected @endif>종료</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <select class="single-select form-control-sm col-12" name="pkind" id="pkind">
                                            <option value="">전체상품</option>
                                            @foreach( $productType as $pk => $pname )
                                            <option value="{{ $pk }}" @if ( isset($param['pkind']) && $pk == $param['pkind'] ) selected @endif>{{ $pname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                <input type="text" name="sdate" id="sdate" value="{{ $param['sdate'] ?? '' }}" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                <input type="text" name="edate" id="edate" value="{{ $param['edate'] ?? '' }}" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 mt-1">
                                <div class="col-12">
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-d") }}');$('#edate').val('<?=date('Y-m-d')?>');">금일</a>
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-01") }}');$('#edate').val('<?=date('Y-m-t')?>');">이달</a>
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-01-01") }}');$('#edate').val('<?=date('Y-12-31')?>');">금년</a>
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('');$('#edate').val('');">전체</a>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <!--div class="col-md-3 col-sm-3 col-xs-12 mt-1">
                                <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                    <option value="">사용자명, 상품명</option>
                                    <option value="m_name" <?php if( isset($fd) && $param['fd'] == "m_name" ) {?> selected<?}?>>사용자명</option>
                                    <option value="m_id" <?php if( isset($fd) && $param['fd'] == "m_id" ) {?> selected<?}?>>회원ID</option>
                                    <option value="oi_names" <?php if( isset($fd) && $param['fd'] == "oi_names" ) {?> selected<?}?>>상품명</option>
                                </select>
                            </div-->
                            <div class="col-md-7 col-sm-5 col-xs-12 mt-1">
                                <input type="text" name="q" value="{{ $param['q'] ?? '' }}" class="form-control form-control-sm col-12">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                            @if( $FrenchReserves )
                            @foreach( $FrenchReserves as $ri => $reserv )                                       
                            <tr>
                                <th scope="row">{{ ($start - $ri) }}</th>
                                <td>{{ $reserv['rv_no'] }}</td>

                                <td member="{{ $reserv['o_member'] }}">
                                    <span class="btn btn-xs @if( $reserv['rv_ageType'] == "S") btn-student @else btn-adult @endif">{{ $ageType[$reserv['rv_ageType']] ?? "" }}</span>
                                    <span class="btn btn-xs @if( $reserv['rv_sex'] == "F") btn-female @else btn-male @endif">{{ $sexType[$reserv['rv_sex']] ?? "" }}</span>
                                    
                                    {{ $fromType[$reserv['rv_member_from']] ?? "" }}
                                    {{ $reserv['o_member_name'] }}
                                </td>
                                <td><span room="{{ $reserv['rv_room'] }}">{{ $reserv['r_name'] }}</span> / <span seat="{{ $reserv['s_name'] }}">{{ $reserv['rv_seat'] }}</span></td>
                                <td>{{ $reserv['rv_locker'] }}</td>
                                <td>
                                    @if($reserv['rv_state'] == "A") 
                                        <span class="btn btn-xs btn-warning btn-R" data-bs-toggle="modal" data-bs-target="#useInfoModal">예약</span>
                                    @elseif($reserv['rv_state'] == "U") 
                                        <span class="btn btn-xs btn-primary btn-U" data-bs-toggle="modal" data-bs-target="#useInfoModal">사용중</span>
                                    @elseif($reserv['rv_state'] == "X") 
                                        <span class="btn btn-xs btn-secondary btn-X" data-bs-toggle="modal" data-bs-target="#useInfoModal">종료</span>
                                    @endif
                                </td>
                                <td>
                                    @if($reserv['rv_state_seat'] == "IN") 
                                        <span class="btn btn-xs btn-in">{{ $reserv['rv_state_seat'] }}</span>
                                    @elseif($reserv['rv_state_seat'] == "OUT") 
                                        <span class="btn btn-xs btn-out">{{ $reserv['rv_state_seat'] }}</span>
                                    @endif
                                </td>
                                <td>{{ substr($reserv['rv_sdate'],5,11) }} ~ {{ substr($reserv['rv_edate'],5,11) }}</td>
                                <td>{{ $reserv['created_at'] }}</td>
                            </tr>
                            @endforeach
                            @endif                                    

                            </tbody>
                        </table>

                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                        <div class="card-body d-flex justify-content-center">
                            {{ $FrenchReserves->appends($param)->links() }}
                        </div>  

                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    <?
    //include $CFG['module_dir']."/zipcode/zipcode.inc.php";
    ?>
    <!--end page wrapper -->
@endsection


@section('javascript')

    <script>


    </script>

@endsection