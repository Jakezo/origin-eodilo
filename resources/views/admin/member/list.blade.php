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
                <div class="breadcrumb-title pe-3">회원관리</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">회원관리</li>
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
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>
                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="" @if( isset($fd) && $fd == "" ) selected @endif>이름, 아이디, 전화번호</option>
                                            <option value="name" @if( isset($fd) && $fd == "name" ) selected @endif>이름</option>
                                            <option value="phone" @if( isset($fd) && $fd == "phone" ) selected @endif>전화번호</option>
                                            <option value="user_id" @if( isset($fd) && $fd == "user_id" ) selected @endif>아이디</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="q" value="{{ $param['q'] ?? "" }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="/member/form" class="btn btn-warning px-2 btn-sm col-12">신규</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">아이디</th>
                                    <th scope="col">이름</th>
                                    <th scope="col">연락처</th>
                                    <th scope="col">생년월일</th>
                                    <th scope="col">성별</th>
                                    <th scope="col">최근이용일</th>
                                    <th scope="col">가입일</th>
                                    <th scope="col">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $users )
                                @foreach( $users as $ui => $user )
                                <tr>
                                    <th scope="row">{{ ($start - $ui) }}</th>
                                    <td>{{ $user['email'] }}</td>
                                    <td><i class="bx bx-mobile-alt"></i> {{ $user['nickname'] }} <i class="bx bx-tag-alt bxs-tag text-primary"></i></td>
                                    <td>{{ $user['phone'] }}
                                        @if( strlen( $user['push_token'] ) > 10 )
                                            <input type="button" class='btn btn-info btn-xs' value="Push" onclick="open_member_push('{{ $user['id'] }}')">
                                        @endif

                                    </td>
                                    <td>{{ $user['birth'] }} ( {{ $user['age'] }}, {{ $user['ageTypeText'] }} )</td>
                                    <td>{{ $user['sex'] }}</td>
                                    <td>{{ substr($user['login_last'],0,10) }}</td>
                                    <td>{{ $user['created_at'] }}</td>
                                    <td><button type="button" class="btn btn-xs btn-primary user_view" id="{{ $user['id'] ?? '' }}">정보</button></td>
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
                            {{ $users->appends($param)->links() }}
                        </div>
                    </div>




                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection


