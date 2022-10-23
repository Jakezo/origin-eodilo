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
                <div class="breadcrumb-title pe-3">정산</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">월별정산내역</li>
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
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="y" id="y">
                                            <option value="ALL">전체</option>
                                            @for($yi=2022;$yi<=date('Y');$yi++)
                                            <option value="{{ $yi }}" @if( isset($param['y']) && $yi == $param['y'] ) selected @endif>{{ $yi }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="m" id="m">
                                            <option value="ALL">전체</option>
                                            @for($mi=1;$mi<=12;$mi++)
                                            <option value="{{ sprintf('%02d',$mi) }}" @if( isset($param['m']) && $mi == $param['m'] ) selected @endif>{{ $mi }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12 mt-1">
                                        <div class="col-12">
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#y').val('{{ date("Y") }}');$('#m').val('{{ date('m') }}');">이달</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#y').val('{{ date("Y") }}');$('#m').val('ALL');">금년</a>
                                            <a href="javascript:;" class="btn btn-secondary btn-sm col" onclick="$('#y').val('ALL');$('#m').val('ALL');">전체</a>
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
                                    <th scope="col">정산월</th>
                                    <th scope="col">가맹점</th>
                                    <th scope="col">사용인원</th>
                                    <th scope="col">누적사용시간</th>
                                    <th scope="col">누적매출</th>
                                    <th scope="col">수수료</th>
                                    <th scope="col">가맹점정산</th>
                                    <th scope="col">내역보기</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( isset( $sales ) )
                                @foreach( $sales as $si => $sale )
                                <tr>
                                    <td scope="row">{{ (count($sales)-$si) }}</td>
                                    <td>{{ $sale['std_date'] }}</td>
                                    <td><i class="bx bx-building"></i> {{ $sale['p_name'] }}</td>
                                    <td class="text-right">{{ $sale['count_rv'] }}</td>
                                    <td class="text-right">{{ $sale['sum_time'] }}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td><button class="btn btn-xs btn-danger">내역보기</button></td>
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
                            {{ $sales->appends($param)->links() }}
                        </div>    
                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection


