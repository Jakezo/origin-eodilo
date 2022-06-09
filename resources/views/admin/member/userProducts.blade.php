@extends('layouts.manager_popup')

@section('title', 'Page Title')

@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">회원정보</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    @if( isset( $member['name'] ) )
                    <li class="breadcrumb-item active" aria-current="page">{{ $member['name']  ?? '' }} ({{ $member['id']  ?? '' }})</li>
                    @else
                    <li class="breadcrumb-item active" aria-current="page">신규가입</li>
                    @endif
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
       
        <div class="col">

            <ul class="nav nav-tabs nav-primary navbar-sm" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/user_info?id={{ $user['id'] }}" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                            </div>
                            <div class="tab-title">기본정보</div>
                        </div>
                    </a>
                </li>
                @if( isset( $user['id'] ) )                
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" href="/member/user_buyProducts?id={{ $user['id'] }}" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                            </div>
                            <div class="tab-title">구매내역</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/user_reserveSeats?id={{ $user['id'] }}" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">이용내역</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/user_customs?id={{ $user['id'] }}" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">1:1문의</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#primaryalarm" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">알람내역</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#points" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">포인트</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/member/user_cashes?id={{ $user['id'] }}" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bxs-microphone font-18 me-1"></i>
                            </div>
                            <div class="tab-title">캐쉬</div>
                        </div>
                    </a>
                </li>
                @endif                
            </ul>
            
            
            <div class="card">
                <div class="card-body">

                    <table class="table mb-0 table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">구매일</th>
                            <th scope="col">구매상품</th>
                            <th scope="col">잔여</th>
                            <th scope="col">상태</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if( $orders )
                            @foreach( $orders as $oi => $order )         
                            <tr>
                                <th scope="row">{{ (count($orders) - $oi) }}</th>
                                <td>{{ $order['created_at'] }}</td>
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
                                <td><button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#memberRegModal">사용중</button></td>
                            </tr>

                            @endforeach
                            @endif  
                        </tbody>
                    </table>

                </div>
                <div class="card-body d-flex justify-content-center">
                    {{ $orders->appends($param)->links() }}
                </div>

            </div>
        </div>
    </div>
    <!--end row-->
</div>

@endsection

@section('javascript')
@section('javascript')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });


    </script>

@endsection
