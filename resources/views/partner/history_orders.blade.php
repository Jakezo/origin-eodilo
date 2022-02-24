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
                    <button class="btn btn-xs btn-danger btn_manual" rel="10"><i class="lni lni-youtube"></i>도움말</button>
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
                                                    <select class="single-select form-control-sm col-12" name="state" id="state">
                                                        <option value="">사용여부전체</option>
                                                        <option value="A" @if ( isset($state) && $param['pkind'] == "A" ) selected @endif>사용전</option>
                                                        <option value="N" @if ( isset($state) && $param['pkind'] == "N" ) selected @endif>사용중</option>
                                                        <option value="Y" @if ( isset($state) && $param['pkind'] == "Y" ) selected @endif>종료</option>
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

                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">이용번호</th>
                                    <th scope="col">상품</th>
                                    <th scope="col">회원등급</th>
                                    <th scope="col">사용자명</th>
                                    <th scope="col">룸/좌석</th>
                                    <th scope="col">사물함</th>
                                    <th scope="col">사물함금액</th>
                                    <th scope="col">상태</th>
                                    <th scope="col">구매금액</th>
                                    <th scope="col">결제여부</th>
                                    <th scope="col">결제방법</th>
                                    <th scope="col">결제금액</th>
                                    <th scope="col">구매일시</th>
                                    <th scope="col">남은시간</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $orders )
                                @foreach( $orders as $oi => $order )                                    
                                <tr>
                                    <th scope="row">{{ ($start - $oi) }}</th>
                                    <td>{{ $order['o_no'] }}</td>
                                    <td>
                                        @if($order['o_product_kind'] == "A") 
                                            하루이용권 
                                        @elseif($order['o_product_kind'] == "T") 
                                            시간권 {{ $order['o_duration'] }} 시간
                                        @elseif($order['o_product_kind'] == "D") 
                                            기간권 {{ $order['o_duration'] }} 일
                                        @elseif($order['o_product_kind'] == "F") 
                                            고정권  {{ $order['o_duration'] }} M
                                        @elseif($order['o_product_kind'] == "P") 
                                            정액권   {{ $order['o_duration'] }} Points
                                        @endif

                                    </td>
                                    <td>
                                        @if($order['o_ageType'] == "A") 성인 @elseif($order['o_ageType'] == "S") 학생 @endif
                                    </td>
                                    <td member="{{ $order['o_member'] }}">
                                        {{ $order['mb_name'] }}
                                    </td>
                                    <td>{{ $order['o_room'] }} / {{ $order['o_seat'] }}</td>
                                    <td>
                                        @if($order['o_locker']  > 0 ) {{ $order['o_locker_name'] }} @else - @endif
                                    </td>
                                    <td>{{ number_format($order['o_price_locker']) }}</td>                                    
                                    <td><button class="btn btn-xs btn-primary"  data-bs-toggle="modal" data-bs-target="#useInfoModal">사용중</button></td>
                                    <td>{{ number_format($order['o_price_total']) }}</td>
                                    <td>
                                        @if($order['o_pay_state'] == "Y") 
                                            결제완료 
                                        @elseif($order['o_pay_state'] == "N") 
                                            미결제
                                        @else
                                            -
                                        @endif
                                    </td> 
                                    <td>
                                        @if($order['o_pay_kind'] == "LCASH") 
                                            방문현금 
                                        @elseif($order['o_pay_kind'] == "LCARD") 
                                            방문카드
                                        @else
                                            -
                                        @endif
                                    </td>                                     
                                    <td class="align-right">{{ number_format($order['o_pay_money']) }}</td>
                                    <td>{{ $order['created_at'] }}</td>
                                    <td>
                                        @if($order['o_product_kind'] == "A") 
                                            <span class="btn btn-xs @if( $order['o_remainder_day'] > 0 ) btn-info @else btn-secondary @endif">{{ $order['o_remainder_day'] }} / {{ $order['o_duration'] }}</span> 회
                                        @elseif($order['o_product_kind'] == "T") 
                                            <span class="btn btn-xs @if( $order['o_remainder_time'] > 0 ) btn-info @else btn-secondary @endif">{{ $order['o_remainder_time'] }} / {{ $order['o_duration'] }}</span> 시간
                                        @elseif($order['o_product_kind'] == "D") 
                                            <span class="btn btn-xs @if( $order['o_remainder_day'] > 0 ) btn-info @else btn-secondary @endif">{{ $order['o_remainder_day'] }} / {{ $order['o_duration'] }}</span> 일
                                        @elseif($order['o_product_kind'] == "F") 
                                            -
                                        @elseif($order['o_product_kind'] == "P") 
                                            <span class="btn btn-xs @if( $order['o_remainder_point'] > 0 ) btn-info @else btn-secondary @endif">{{ $order['o_remainder_point'] }} / {{ $order['o_duration'] }}</span> P
                                        @endif
                                    </td>                       
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
                            {{ $orders->appends($param)->links() }}
                        </div>

                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection


