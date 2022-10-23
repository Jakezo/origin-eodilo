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
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
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
                            <a class="nav-link" data-bs-toggle="tab" href="#"
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
                            <a class="nav-link active" data-bs-toggle="tab" href="#"
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

                    <form name="search" action="">
                        <div class='row'>
                            <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                <input type="text" name="sdate" id="sdate" value="{{ $param['sdate'] ?? '' }}" placeholder="기간시작일" class="form-control form-control-sm datepicker col-12">
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                <input type="text" name="edate" id="edate" value="{{ $param['edate'] ?? ''  }}" placeholder="기간종료일" class="form-control form-control-sm datepicker col-12">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 mt-1">
                                <div class="col-12">
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-d") }}');$('#edate').val('<?=date('Y-m-d')?>');">금일</a>
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-m-01") }}');$('#edate').val('<?=date('Y-m-t')?>');">이달</a>
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('{{ date("Y-01-01") }}');$('#edate').val('<?=date('Y-12-31')?>');">금년</a>
                                    <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#sdate').val('');$('#edate').val('');">전체</a>
                                </div>
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
                                    <th scope="col">정산일</th>
                                    <th scope="col">가맹점</th>
                                    <th scope="col">총사용건수</th>
                                    <th scope="col">정산금액</th>
                                    <th scope="col">집계일시</th>
                                    <th scope="col">가맹점정산</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if( isset( $culculates ) )
                            @foreach( $culculates as $ci => $culculate )
                            <tr>
                                <td scope="row">{{ (count($culculates)-$ci) }}</td>
                                <td>{{ $culculate['cal_date'] }}</td>
                                <td><i class="bx bx-building"></i> {{ $culculate['p_name'] }}</td>
                                <td class="text-right">{{ $culculate['cal_reserve_count'] }}</td>
                                <td class="text-right">{{ number_format($culculate['cal_revenue']) }}</td>
                                <td class="text-right">{{ $culculate['created_at'] }}</td>
                                <td class="text-right">
                                    @if( $culculate['cal_status'] == "A" ) 
                                        <span class="btn btn-xs btn-danger btn_calculate" cal="{{ $culculate['cal_no'] }}">미정산</span>
                                    @elseif( $culculate['cal_status'] == "Y" ) 
                                        <span class="btn btn-xs btn-primary btn_calculate" cal="{{ $culculate['cal_no'] }}">정산완료</span>
                                    @else

                                    @endif
                                </td>
                            </tr>                                    

                            @endforeach
                            @endif                                    

                            </tbody>
                        </table>


                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                        <div class="card-body d-flex justify-content-center">
                            {{ $culculates->appends($param)->links() }}
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