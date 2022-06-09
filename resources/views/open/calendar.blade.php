@extends('layouts.open')
	<div class="event-inner clearfix">

		<div class="event-cal2">
			<div class="cal_month">
				<a href="{{ $cal_url_prev ?? "" }}" class="prev" title="1개월 앞의 달력을 보여줍니다.">«</a>
				&nbsp;
				<a href="#" title="현재 달의 달력을 보여줍니다.">{{ $LYEAR ?? "" }}년 {{ $LMON ?? "" }}월</a>
				&nbsp;
				<a href="{{ $cal_url_next ?? "" }}" class="next" title="1개월 뒤의 달력을 보여줍니다.">»</a>
			</div>			

			<table class="table table-bordered table-condensed tt-calendar2" cellpadding="0" cellspacing="1" >
			<thead>
			  <tr>
						<th class="cal_week2">일</th>
						<th class="cal_week1">월</th>
						<th class="cal_week1">화</th>
						<th class="cal_week1">수</th>
						<th class="cal_week1">목</th>
						<th class="cal_week1">금</th>
						<th class="cal_week1">토</th>
			  </tr>
			</thead>
			<tbody>
				{{ $blank_s }}
						@for( $i=1; $i <= $LAST_DAY; $i++)
						<?php
							$CONTEXT ="";
							$THIS_WEEKDAY = date("D",mktime(0,0,0,$LMON,$i,$LYEAR)); 
							$THIS_WEEKEND = date("w",mktime(0,0,0,$LMON,$i,$LYEAR)); 
							$THIS_DATE = date("Y-m-d",mktime(0,0,0,$LMON,$i,$LYEAR)) ?? ""; 
							
						?>

							@if( $i == 1 || $THIS_WEEKDAY == 'Sun' ) 
								<tr class="cal_week">
							@endif

							@if( $i == 1 && $blank_s ) 
								@for( $s = 0; $s <= $blank_s; $s++ ) 
								<td class="cal_day2">&nbsp;</td>
								@endfor
							@endif

							<?php
							$tmpDAY = sprintf("%02d",$i);
							$VAR = "$LYEAR$LMON$tmpDAY";


							if( $THIS_WEEKEND == 0 ) {
								$cal_style = " cal_day_sunday";
							} elseif( $THIS_WEEKEND == 6 ) {
								$cal_style = " cal_day4";
							} else {
								$cal_style = " cal_day3";
							}

							## 행사가 있다면...
							if( isset($events[$THIS_DATE]) ) {
								$cal_style = " cal_dayEvent";
							}

							$view_script = "";
							?>
							<td class=" cal_day {{$cal_style??""}} cal_date" rel="{{ $THIS_DATE ?? ""}}" id="">
									<?=$i?>
									<?
									if( $events[$THIS_DATE] ) {
										?><br>
										
										<div class="att_date" rp_no="">
											@if( isset($events[$THIS_DATE]) )
												@foreach($events[$THIS_DATE] as $event)
												<div style="padding:1px 0 3px;font-weight:500; font-size:12pt;">@if( trim($event['e_title']) ){{ $event['e_title'] }} @else {{ $event['p_name'] }} @endif</div>
												<div>{{ $event->e_cont }}</div>
												@endforeach
											@endif
										</div>
										<?	
									} 
									?>
							</td>

							@if( $THIS_WEEKDAY == 'Sat' )
							</tr>
							@endif

							@if( $i == $LAST_DAY ) 
								@for( $b=$blank_e; $b >= 1 ; $b-- ) 
								<td class="cal_day2">&nbsp;</td>
								@endfor	
								</tr>
							@endif


						@endfor

				</tbody>
			</table>
		</div>

	</div>
	
		@if( $evs2 ) 
		<div class="att_Sp">
				@foreach($evs2 as $event)
				<div style="padding:1px 0 3px;font-weight:500; font-size:12pt;">{{ $event['p_name'] }}</div>
				<div>{{ $event->e_title }}</div>
				<div>{{ $event->e_cont }}</div>
				@endforeach
		</div>
		@endif 
    <div class="modal fade" id="topicInfoModal" tabindex="-2" aria-labelledby="topicInfoModalLabel" style="display: none;z-index:90000;" aria-hidden="true">
        <div class="modal-dialog modal- md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="topicInfoTitle">오늘 정보</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="col-12">
                        <div class="col-12" id="sp_tab">
                            <div class="alert alert-warning">
                                <h6>긴급</h6>
                                <div id="sp_topic"></div>
                            </div>
                        </div>

                        <div class="col-12 alert popup_topic">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@section('javascript')	
<script>
	$(document).ready(function(){	
		view_topic('{{ date("Y-m-d") }}');
		view_topic_sp();

		$(document).on("click",".cal_day",function(){
			var dt = $(this).attr("rel");
			view_topic(dt);
		});

	});

	function view_topic_sp(){
		if( $(".att_Sp").length )  {
			$("#sp_tab").show();
			$("#sp_tab #sp_topic").html( $(".att_Sp").html() );
		} else {
			$("#sp_tab").html("").hide();

		}
	}

	function view_topic(dt){
		$("#topicInfoModal #topicInfoTitle").html(dt);
		$(".popup_topic").html($(".cal_day[rel='"+dt+"'] .att_date").html());
		$("#topicInfoModal").modal("show");
	}

	$('#topicInfoModal').on('hide.bs.modal', function (e) {
		$("#sp_tab").hide();
		$(".popup_topic").html("");
		$("#sp_topic").html("");
	});	

</script>	
@endsection

<style>
/* 달력 */
.event-cal2 {
}
.tt-calendar2 {
	width:100%;
  margin: 0 auto;
}
.cal_month {
	width:100%;
	margin: 0 auto;
	padding: 20px 0 20px 0;
	font-size: 12px;
	text-align: center;
	font-weight: 700;
}
.cal_month .prev,
.cal_month .next {
  padding: -12px 5px;
  font-size: 12px;
  font-family: consolas;
  background-color: #fafafa;
  border: 1px solid #dedfe0;
}
.cal_month a {
  font-size: 25px;
  color: #000;
  line-height:25px;
}
.tt-calendar2 thead {
  border: solid #ececec;
  border-width: 2px 2px 0 2px;
}
.tt-calendar2 tbody {
  border: solid #ececec;
  border-width: 0px 2px 2px 2px;
}

.tt-calendar2 td{
	width:13%;
}

/*
.tt-calendar2 .cal_week1{
	width:8%;
}
.tt-calendar2 .cal_week2{
	
	width:50px;
}
*/
.tt-calendar2 .cal_week1,
.tt-calendar2 .cal_week2 {
  padding: 10px 0;
  color: #fff;
  font-size: 11px;
  text-align: center;
  background-color: #bdc1c5;
  border: solid #fff;
  border-width: 1px 0 0 1px;
  height:40px;
}
.tt-calendar2 .cal_week2 {
  background-color: #feaa96 !important;
}
.tt-calendar2 .cal_week td {
  padding: 3px;
  color: #555;
  font-size: 10px;
  text-align: center;
  background-color: #f4f4f4;
  border: solid #fff;
  border-width: 1px 0 0 1px;
}
.tt-calendar2 .cal_day div{
	clear:both;
	margin-top: 5px;
}
.tt-calendar2 .cal_day_sunday {
  background-color: #f8f2f2 !important;
}
.tt-calendar2 .cal_day4 {
  background-color: #e6e7ea !important;
}
.tt-calendar2 .cal_dayEvent {
  background-color: #f4f4f5 !important;
}
.tt-calendar2 .cal_dayEvent img {
	width: 60px;
	height: 40px;
	border:1px solid #c9c9c9;
}
.tt-calendar2 .cal_week td {
  padding: 6px;
  color: #555;
  font-size: 14px;
  text-align: left;
  background-color: #f4f4f4;
  border: solid #fff;
  border-width: 1px 0 0 1px;
  height:70px;
}
.tt-calendar2 .media div {
  min-height: 165px;
  padding: 25px 0;
  border-top: 1px solid #dbdbdb;
}
.tt-calendar2 .cal-title p {
  width:40px;
}

</style>    
