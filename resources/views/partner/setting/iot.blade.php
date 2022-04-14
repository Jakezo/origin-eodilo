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
                <div class="breadcrumb-title pe-3">설정</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">IOT정보</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#useInfoModal"><i class="lni lni-youtube"></i>도움말</button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->


            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" role="form" name="frm_iot" id="frm_iot">
                        {{csrf_field()}} 
                        <div style="clear:both"></div>

                        <div class="form-group mt-2">
                            <label for="name" class="col-sm-12 control-label">IOT1</label>
                            <div class="col-sm-12 text-left">
                                <input type="text" name="iot[]" id="iot_0" value="" size="30" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="email" class="col-sm-12 control-label">IOT2</label>
                            <div class="col-sm-12 text-left">
                                <input type="text" name="iot[]" id="iot_1" value="" value="love12545@naver.com" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="phone" class="col-sm-12 control-label">IOT3</label>
                            <div class="col-sm-12 text-left">
                                <input type="text" name="iot[]" id="iot_2" value="" size="30" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="phone" class="col-sm-12 control-label">IOT4</label>
                            <div class="col-sm-12 text-left">
                                <input type="text" name="iot[]" id="iot_3" value="" size="30" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div style="clear:both"></div>

                        <br>
                        <table width="100%">
                            <tbody><tr>
                                <td height="25" class="class_admin_table_blank" colspan="2" align="center">

                                    <button type="button" class="btn btn-sm btn-primary" id="btn_admin_update">확인</button>
                                </td>
                            </tr>
                            </tbody></table>
                    </form>

                </div>


            </div>
        </div>
        <!--end row-->
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

            $(document).on("click", "#btn_room_update", function () {
                iot_update();
            });


        });

        function iot_update() {
            var req = $("#frm_iot").serialize();
            $.ajax({
                url: '/setting/iot/update',
                type: 'POST',
                async: true,
                beforeSend: function (xhr) {

                },
                data: req,
                success: function (res, textStatus, xhr) {

                    if (res.result == true) {
                        document.location.reload();
                    } else {

                    }
                },
                error: function (xhr, textStatus, errorThrown) {

                }
            });
        }

    </script>


@endsection