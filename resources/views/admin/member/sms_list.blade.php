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
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">SMS 발송</li>
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
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>                            
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">구분</th>
                                    <th scope="col">수신자</th>
                                    <th scope="col">제목/내용</th>
                                    <th scope="col">발송일</th>
                                    <th scope="col">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $messages )
                                @foreach( $messages as $mi => $message )                                    
                                <tr>
                                    <th scope="row">{{ ($start - $mi) }}</th>
                                    <td>SMS</td>
                                    <td>{{ $message['msg_member'] }}</td>
                                    <td>{{ $message['msg_title'] }}</td>
                                    <td>{{ $message['msg_sended_at'] }}</td>
                                    <td>
                                        @if( $message['msg_success'] == "Y")
                                        <button type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#memberRegModal">전송성공</button>
                                        @elseif( $message['msg_success'] == "N")
                                        <button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#memberRegModal">전송실패</button>
                                        @else
                                        <button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#memberRegModal">전송준비</button>
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
                            {{ $messages->appends($param)->links() }}
                        </div>                        
                    </div>



                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection


