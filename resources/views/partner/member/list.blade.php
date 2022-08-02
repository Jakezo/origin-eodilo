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
                <div class="breadcrumb-title pe-3">회원관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">회원관리</li>
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
                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="kind" id="kind">
                                            <option value="" <?php if( isset($param['kind']) && $param['kind'] == "" ) {?> selected<?}?>>전체</option>
                                            <option value="p" <?php if( isset($param['kind']) && $param['kind'] == "p" ) {?> selected<?}?>>가맹점회원</option>
                                            <option value="m" <?php if( isset($param['kind']) && $param['kind'] == "m" ) {?> selected<?}?>>모바일회원</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="all" <?php if( isset($param['fd']) && $param['fd'] == "all" ) {?> selected<?}?>>이름, 아이디, 전화번호</option>
                                            <option value="name" <?php if( isset($param['fd']) && $param['fd'] == "name" ) {?> selected<?}?>>이름</option>
                                            <option value="phone" <?php if( isset($param['fd']) && $param['fd'] == "phone" ) {?> selected<?}?>>전화번호</option>
                                            <option value="id" <?php if( isset($param['fd']) && $param['fd'] == "id" ) {?> selected<?}?>>아이디</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="q" value="{{ $param['q'] ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#memberRegModal">신규</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <!--th scope="col">아이디</th-->
                                    <th scope="col">이름</th>
                                    <th scope="col">연락처</th>
                                    <th scope="col" class="d-none d-md-table-cell">이용횟수</th>
                                    <th scope="col" class="d-none d-md-table-cell">최근이용일</th>
                                    <th scope="col" class="d-none d-md-table-cell">가입일</th>
                                    <th scope="col">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $members ?? "" ) 
                                @foreach ( $members as $mi => $member)                                    
                                <tr>
                                    <th scope="row">{{ ($start - $mi) }}</th>
                                    <!--td><span>{{ $member['mb_id'] ?? '' }}</span></td-->
                                    <td><i class="bx bx-mobile-alt"></i><!--i class="bx bx-user"></i--> {{ $member['mb_name'] ?? '' }} <i class="bx bx-tag-alt bxs-tag text-primary"></i></td>
                                    <td>{{ $member['mb_phone'] ?? '' }}</td>
                                    <td class="d-none d-md-table-cell">1회</td>
                                    <td class="d-none d-md-table-cell">{{ $member['mb_no'] ?? '' }}</td>
                                    <td class="d-none d-md-table-cell">{{ $member['created_at'] ?? '' }}</td>
                                    <td><button type="button" class="btn btn-xs btn-primary member_view" no="{{ $member['mb_no'] ?? '' }}">수정</button></td>
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
                            {{ $members->appends($param)->links() }}
                        </div>

                    </div>


                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection

<script>


    
</script>