<!-- Stored in resources/views/child.blade.php -->
@extends('layouts.admin')

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
                <div class="breadcrumb-title pe-3">Dash Board</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">이용내역보기</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">

                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-body">
                                <form name="search" action="{{ $PHP_SELF ?? '' }}?>">
                                    <div class='row'>
                                        <div class="col-md-5 col-sm-12 col-xs-12 mt-1">
                                            <div class="row">
                                                <div class="col-6">
                                                    <select class="single-select form-control-sm col-12" name="estimate" id="estimate">
                                                        <option value="" @if ( isset($estimate) && $estimate == "" ) selected @endif>사용중</option>
                                                        <option value="Y" @if ( isset($estimate) && $estimate == "Y" ) selected @endif>종료</option>
                                                    </select>
                                                </div>


                                                <div class="col-6">
                                                    <select class="single-select form-control-sm col-12" name="estimate" id="estimate">
                                                        <option value="" @if ( isset($estimate) && $estimate == "" ) selected @endif>전체상품</option>
                                                        <option value="Y" @if ( isset($estimate) && $estimate == "" ) selected @endif>기간권</option>
                                                        <option value="Y" @if ( isset($estimate) && $estimate == "" ) selected @endif>시간권</option>
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
                                        <div class="col-md-3 col-sm-3 col-xs-12 mt-1">
                                            <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                                <option value="">사용자명, 상품명</option>
                                                <option value="nickname" <?php if( isset($param['fd']) && $param['fd'] == "m_name" ) {?> selected<?}?>>사용자명</option>
                                                <option value="id" <?php if( isset($param['fd']) && $param['fd'] == "m_id" ) {?> selected<?}?>>회원ID</option>
                                                <option value="p_name" <?php if( isset($fd) && $param['fd'] == "p_name" ) {?> selected<?}?>>가맹점명</option>
                                            </select>
                                        </div>
                                        <div class="col-md-7 col-sm-5 col-xs-12 mt-1">
                                            <input type="text" name="q" value="{{ $param['q'] ?? '' }}" class="form-control form-control-sm col-12">
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                            <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">가맹점</th>
                                    <th scope="col">사용자명</th>
                                    <th scope="col">성별</th>
                                    <th scope="col">연령</th>
                                    <!--th scope="col">룸/좌석</th-->
                                    <th scope="col">사물함</th>
                                    <th scope="col">상태</th>
                                    <th scope="col">입실/퇴실시간</th>
                                    <th scope="col">예약일시</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $reserves )
                                @foreach( $reserves as $pi => $reserve )                                    
                                <tr>
                                    <th scope="row">{{ $reserve['rv_no'] }}</th>
                                    <td>{{ $reserve['p_name'] }}</td>
                                    <td>{{ $reserve['nickname'] }}</td>
                                    <td>
                                        @if($reserve['rv_sex']=="M" ) 남자 @endif
                                        @if($reserve['rv_sex']=="F" ) 여자 @endif
                                    </td>
                                    <td>
                                        @if($reserve['rv_ageType']=="A" ) 성인 @endif
                                        @if($reserve['rv_ageType']=="S" ) 학생 @endif
                                    </td>
                                    <!--td>{{ $reserve['rv_room'] }} / {{ $reserve['rv_seat'] }}</td-->
                                    <td>{{ $reserve['rv_locker'] }}</td>
                                    <td>
                                        @if( $reserve['rv_state_seat'] == "") <button class="btn btn-xs btn-info"  data-bs-toggle="modal" data-bs-target="#useInfoModal">사용전</button>@endif
                                        @if( $reserve['rv_state_seat'] == "IN" ||  $reserve['rv_state_seat'] == "OUT") <button class="btn btn-xs btn-warning"  data-bs-toggle="modal" data-bs-target="#useInfoModal">사용전</button>@endif
                                        @if( $reserve['rv_state_seat'] == "END") <button class="btn btn-xs btn-secondary"  data-bs-toggle="modal" data-bs-target="#useInfoModal">사용완료</button>@endif                                        
                                    </td>
                                    <td>{{ substr($reserve['rv_sdate'],2,14) }} ~ {{ substr($reserve['rv_edate'],2,14) }}</td>
                                    <td>{{ substr($reserve['reserved_at'],2,14) }}</td>
                                </tr>
                                @endforeach
                                @endif                                

                                </tbody>
                            </table>
                        </div>
                    </div>

                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    <div class="card-body d-flex justify-content-center">
                        {{ $reserves->appends($param)->links() }}
                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection


