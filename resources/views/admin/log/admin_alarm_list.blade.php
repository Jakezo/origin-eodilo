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
                <div class="breadcrumb-title pe-3">관리자 알람</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">관리자 알림</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col">
                    <div class="card">

                        <div class="card-body">
                            <form name="search" action="">
                                <div class='row'>

                                    <div class="col-lg-1 col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="kind" id="kind">
                                            <option value="">구분</option>
                                            <option value="B" @if( isset($param["kind"]) && $param["kind"] == 'P' ) selected @endif>구매</option>
                                            <option value="M" @if( isset($param["kind"]) && $param["kind"] == 'M' ) selected @endif>회원</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="q" value="{{ $param['q'] ?? "" }}" placeholder="이름,닉네임,이메일" class="form-control form-control-sm col-12">
                                    </div>
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
                                    <th scope="col">#</th>
                                    <th scope="col">구분</th>
                                    <th scope="col">회원</th>
                                    <th scope="col">내용</th>
                                    <th scope="col">등록일시</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $alarms )
                                @foreach( $alarms as $ai => $alarm )  							
                                <tr>
                                    <th scope="row">{{ ($start - $ai) }}</th>
                                    <td>
                                        @if( $alarm['a_kind'] == "B")
                                        <span class="btn btn-xs btn-primary">구매</span>
                                        @endif


                                        @if($alarm['a_kind']=="P") 
                                        앱푸쉬
                                        @elseif($alarm['a_kind']=="M") 
                                        문자
                                        @elseif($alarm['a_kind']=="K") 
                                        카카오
                                        @endif
                                    </td>
                                    <td>{{ $alarm['a_member'] }} {{ $alarm['nickname'] ?? ( $alarm['name'] ?? $alarm['email'])  }}</td>
                                    <td>{{ $alarm['a_title'] }}</td>
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
    </div>
    <!--end page wrapper -->
@endsection



@section('javascript')

</script>


@endsection