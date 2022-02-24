<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <!--p>This is appended to the master sidebar.</p-->
@endsection

@section('content')

    <?php


?>



    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">가맹점관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">가맹점 정보</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form name="search" action="">
                            <input type="hidden" name="mode" value="list">
                            <div class='row'>
                                <div class="col-lg-1 col-md-2 col-sm-6 col-xs-12 mt-1">
                                    <select class="single-select form-control-sm col-12" name="state" id="state">
                                        <option value="">상태전체</option>
                                        <option value="Y" @if( isset($param['state']) && $param['state'] == 'Y' ) selected @endif>공개</option>
                                        <option value="N" @if( isset($param['state']) && $param['state'] == 'N' ) selected @endif>비공개</option>
                                    </select>
                                </div>
                                <div class="col-lg-1 col-md-2 col-sm-6 col-xs-12 mt-1">
                                    <select class="single-select form-control-sm col-12" name="last" id="last">
                                        <option value="">잔여기간</option>
                                        <option value="A" @if( isset($param['last']) && $param['last'] == 'A' ) selected @endif>사용중</option>
                                        <option value="B" @if( isset($param['last']) && $param['last'] == 'B' ) selected @endif>임박</option>
                                        <option value="C" @if( isset($param['last']) && $param['last'] == 'C' ) selected @endif>1일전</option>
                                        <option value="D" @if( isset($param['last']) && $param['last'] == 'D' ) selected @endif>종료</option>
                                    </select>
                                </div>
                                <!--div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                    <select class="single-select form-control-sm col-12" name="open" id="open">
                                        <option value="">상태전체</option>
                                        <option value="Y" @if( isset($param['open']) && $param['open'] == 'Y' ) selected @endif>공개</option>
                                        <option value="N" @if( isset($param['open']) && $param['open'] == 'S' ) selected @endif>비공개</option>
                                    </select>
                                </div-->
                                <div class="col-lg-1 col-md-2 col-sm-6 col-xs-12 mt-1">
                                    <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                        <option value="" @if( !isset($param['fd']) || $param['fd'] == "" ) selected @endif>전체</option>
                                        <option value="p_name" @if( isset($request->fd) && $param['fd'] == "p_name" ) selected @endif>업체명</option>
                                        <option value="p_emp_name" @if( isset($request->fd) && $param['fd'] == "p_emp_name" ) selected @endif>담당자명</option>
                                    </select>
                                </div>


                                <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 mt-1">
                                    <input type="text" name="q" value="{{ $param['q'] ?? '' }}" class="form-control form-control-sm col-12">
                                </div>
                                <div class="col-lg-1 col-lg-2 col-md-2 col-sm-3 col-xs-6 mt-1">
                                    <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                </div>
                                <div class="col-lg-1 col-lg-2 col-md-2 col-sm-3 col-xs-6 mt-1 justify-content-right">
                                    <a href="/partner/form" class="btn btn-warning px-2 btn-sm col-12">신규</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
                        <table class="table mb-0">
                            <thead class="table-dark">
                            <tr>
                                <th class="d-none d-md-table-cell" scope="col">번호</th>
                                <th scope="col" class="text-center">상태</th>
                                <th scope="col" class="d-none d-lg-table-cell text-center">시스템</th>
                                <th scope="col" class="d-none d-md-table-cell text-center">ID</th>
                                <th scope="col" class="text-center">가맹점명</th>
                                <th class="d-none d-lg-table-cell" scope="col">지역</th>
                                <th class="d-none d-md-table-cell" scope="col">연락처</th>
                                <th class="d-none d-md-table-cell" scope="col">대표</th>
                                <th class="d-none d-lg-table-cell" scope="col">가맹기간</th>
                                <th class="d-none d-lg-table-cell" scope="col">등록일</th>
                                <th class="" scope="col">들어가기</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if( $partners )
                            @foreach( $partners as $pi => $partner )
                            <tr>
                                <td class="d-none d-md-table-cell" scope="row"><a href="/partner/form/{{ $partner['p_no'] ?? '' }}">{{ (count($partners)-$pi) }}</a></td>
                                <td class="text-center">
                                @if( $partner['p_state'] == "Y" )
                                    <span class="btn btn-xs btn-warning">공개</span>
                                @else
                                    <span class="btn btn-xs btn-secondary">비공개</span>
                                @endif
                                </td>

                                <td class="d-none d-lg-table-cell text-center">

                                    @if( $partner['p_open_mobile'] == "Y" )
                                        <span class="btn btn-xs btn-info">M</span>
                                    @else
                                        <span class="btn btn-xs btn-secondary">M</span>
                                    @endif

                                    @if( $partner['p_open_kiosk'] == "Y" )
                                        <span class="btn btn-xs btn-info">K</span>
                                    @else
                                        <span class="btn btn-xs btn-secondary">K</span>
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell "><a href="/partner/form/{{ $partner['p_no'] ?? '' }}">{{ $partner['p_id'] ?? '' }}</span></a></td>
                                <td><a href="/partner/form/{{ $partner['p_no'] ?? '' }}"><span style="font-size:11pt;font-weight:500;color:#000000;">{{ $partner['p_name'] ?? '' }}</span></a></td>
                                <td class="d-none d-lg-table-cell">{{ $partner['p_area'][0] ? $partner['p_area'][0].' '.$partner['p_area'][1] : '' }}</td>
                                <td class="d-none d-md-table-cell">{{ $partner['p_phone'] ?? '' }}</td>
                                <td class="d-none d-md-table-cell">{{ $partner['p_ceo'] ?? '' }}</td>
                                <td class="d-none d-lg-table-cell">

                                    @if( $partner['p_last_dt'] == "0000-00-00" )
                                    <span class="btn btn-xs btn-{{ $partner['reg_color'] }}">{{ $partner['reg_state'] }}</span>
                                    @elseif( $partner['p_last_dt'] >= date('Y-m-d', ) )
                                    <span class="btn btn-xs btn-{{ $partner['reg_color'] }}">{{ $partner['reg_state'] }}</span>
                                    @elseif( $partner['p_last_dt'] >= date('Y-m-d') )
                                    <span class="btn btn-xs btn-{{ $partner['reg_color'] }}">{{ $partner['reg_state'] }}</span>
                                    @elseif($partner['p_last_dt'])
                                    <span class="btn btn-xs btn-{{ $partner['reg_color'] }}">{{ $partner['reg_state'] }}</span>
                                    @endif
                                    {{ substr($partner['p_last_dt'],2,8) ?? ''  }}
                                </td>
                                <td class="d-none d-lg-table-cell">{{ substr($partner['created_at'],2,8) ?? '' }}</td>
                                <td><a href="//{{ $partner['p_id'] ?? '' }}.partner.{{ env('APP_HOST') }}" target="_blank" class="btn btn-primary btn-xs">들어가기</a></td>
                            </tr>
                            @endforeach
                            @endif

                            </tbody>
                        </table>
                        <div class="col-12 text-right mt-2 mb-3">
                            <a href="/partner/deleted" class="btn btn-xs btn-secondary px-5">삭제된파트너보기</a>
                        </div>
                    </div>
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    <div class="card-body d-flex justify-content-center">
                        {{ $partners->appends($param)->links() }}
                    </div>



                </div>
            </div>
        </div>
        <!--end row-->
    </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('javascript')

    <script>
        $(document).ready(function(){
            @if(Session::has('errors'))
            swal(" ", "{{ $error }}", "error");
            @endif
            @if(Session::has('success'))
            swal(" ", "{{ $error }}", "success");
            @endif
        });

    </script>

@endsection
