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
                <div class="breadcrumb-title pe-3">고객센터</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">고객리뷰</li>
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
                            <form name="search" action="">
                                <input type="hidden" name="mode" value="list">
                                <div class='row'>

                                    <div class="col-md-2 col-sm-3 col-xs-12 mt-1">
                                        <select class="single-select form-control-sm col-12" name="fd" id="fd">
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?php }?>>제목+내용+작성자</option>
                                            <option value="p_name" <?php if( isset($fd) && $fd == "p_name" ) {?> selected<?php }?>>제목</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?php }?>>내용</option>
                                            <option value="p_emp_name" <?php if( isset($fd) && $fd == "p_emp_name" ) {?> selected<?php }?>>작성자</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-5 col-xs-12 mt-1">
                                        <input type="text" name="key" value="{{ $key ?? '' }}" class="form-control form-control-sm col-12">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1">
                                        <button type="submit" class="btn btn-secondary px-2 btn-sm col-12">찾기</button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6 mt-1 justify-content-right">
                                        <a href="javascript:;" class="btn btn-warning px-2 btn-sm col-12" data-bs-toggle="modal" data-bs-target="#reviewFormModal">신규작성</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div>총 {{ isset($total) ? number_format($total) : '' }} 건</div>
                            <table class="table mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">지점</th>
                                    <th scope="col" class="text-center">내용</th>
                                    <th scope="col" class="text-center">작성자</th>
                                    <th scope="col" class="text-center">평점</th>
                                    <th scope="col" class="text-center">작성일시</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $reviews )
                                    @foreach( $reviews as $bi => $review )
                                        <tr>
                                            <th scope="row" class="col-2 text-center">{{ ($start - $bi) }}</th>
                                            <td class="text-center">{{$review['p_name']}}</td>
                                            <td class="text-center">{{$review['rv_contents']}}</td>

                                           @if($review['rv_member']==0)
                                            <td class="text-center">임시작성자</td>
                                            @else
                                            <td class="text-center">임시작성자</td>
                                            @endif

                                            @if($review['rv_point']==1)
                                                <td class="text-center"><i class="bx bx-star"></i></td>
                                            @elseif($review['rv_point']==2)
                                                <td class="text-center"><i class="bx bx-star"><i class="bx bx-star"></i></td>
                                            @elseif($review['rv_point']==3)
                                                <td class="text-center"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"></i></td>
                                            @elseif($review['rv_point']==4)
                                                <td class="text-center"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"></i></td>
                                            @elseif($review['rv_point']==5)
                                                <td class="text-center"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"><i class="bx bx-star"></i></td>
                                            @elseif($review['rv_point']==0)
                                                <td class="text-center">평점없음</td>
                                            @endif
                                            <td class="text-center">{{$review['created_at']}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="modal fade" id="reviewFormModal" tabindex="-2" aria-labelledby="reviewFormModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewFormModalLabel">리뷰작성</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" name="review_form" id="review_form">
                        {{csrf_field()}}
                        <input type="hidden" name="no" id="no" value="">
                        <div class="col-xs-12 mt-3">
                            <input type="hidden" name="review_partner" id="review_partner" value="">
                            <input name="partner_name" id="partner_name" style="ime-mode:disabled;" class="input_partner form-control form-control-sm mb-3 col-6" type="text" placeholder="클릭하여 가맹점검색" aria-label=".form-control-sm example" data-bs-toggle="modal" data-bs-target="#partnerSearchModal" search_mode="review">
                        </div>

                        <div class="startRadio">
                            <label class="startRadio__box">
                                <input type="radio" name="star" id="1" value="1">
                                <span class="startRadio__img"><span class="blind">별 1개</span></span>
                            </label>
                            <label class="startRadio__box">
                                <input type="radio" name="star" id="2" value="2">
                                <span class="startRadio__img"><span class="blind">별 2개</span></span>
                            </label>
                            <label class="startRadio__box">
                                <input type="radio" name="star" id="3" value="3">
                                <span class="startRadio__img"><span class="blind">별 3개</span></span>
                            </label>
                            <label class="startRadio__box">
                                <input type="radio" name="star" id="4" value="4">
                                <span class="startRadio__img"><span class="blind">별 4개</span></span>
                            </label>
                            <label class="startRadio__box">
                                <input type="radio" name="star" id="5" value="5">
                                <span class="startRadio__img"><span class="blind">별 5개</span></span>
                            </label>
                        </div>
                        <div class="col-xs-12 mt-3">
                            <textarea name="contents" class="form-control"></textarea>
                        </div>

                        <div class="col-12 text-center text-danger" id="reviewDetail_msg"></div>

                        <div class="col-xs-12 mt-3 text-center">
                            <button type="button" class="btn btn-sm btn-primary" id="btn_review">글작성</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('javascript')

    <script>

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#reviewFormModal').on('show.bs.modal', function (e) {
                get_partners();
            });
            $(document).on("click", "#btn_review", function () {
                review_add();
            });

        });

        function get_partners() {
            var req = "";
            $.ajax({
                url: '/api/partner/get_list',
                type: 'get',
                async: true,
                beforeSend: function (xhr) {
                    $("#reviewDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    if (res.result == true) {
                        $('#review_partner option').remove();
                        res.partners.forEach(function(partner) {
                            var option = $('<option value="'+partner.p_no+'">'+partner.p_name+'</option>');
                            $('#review_partner').append(option);
                        });
                    } else {
                        $("#reviewDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {

                    $("#reviewDetail_msg").html(xhr.responseJSON.message);

                }
            });
        }

        function review_add() {
            var req = $("#review_form").serialize();
            $.ajax({
                url: '/community/review/add',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {
                    $("#reviewDetail_msg").html("");
                },
                data: req,
                success: function (res, textStatus, xhr) {
                    console.log(res);
                    if (res.result == true) {
                        document.location.reload();
                    } else {
                        $("#reviewDetail_msg").html(xhr.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    $("#reviewDetail_msg").html(xhr.responseJSON.message);
                }
            });
        }

        function setPartnerSelected_review(no,name){
            $("#review_form #review_partner").val(no);
            $("#review_form #partner_name").val(name);   
        }

</script>
@endsection