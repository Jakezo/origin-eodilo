<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
html { height: 100% }
body { height: 100%; margin: 0px; padding: 0px }
#map_canvas { height: 100% }
</style>
<script  src="//code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript">
var from = '{{ $from ?? '' }}'
</script>

</head>
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style="border:3px solid #565e6b;">
	<tr>
		<td height="44" bgcolor="#565e6b"><table width="100%">
		<tr>
			<td align="left">&nbsp;&nbsp;<B><FONT COLOR="#FFFFFF">좌표가져오기</FONT></B></td>
			<td align="right"><a href="javascript:window.close();"><img src="/assets/images/btn_close.jpg" width="29" height="29" border="0" alt=""></a>&nbsp;&nbsp;</td>
		</tr>
		</table></td>
	</tr>
	<tr>
		<td align="center" style="padding:10px 10px 10px 10px;" valign="top">
			<div id="res" width="100%">{{ $res ?? "" }}</div>

			<table width="100%" border="0"  cellspacing="1" cellpadding="2" class="class_admin_table">
			<tr>
				<form onsubmit="nmap_address2point( $('#query').val() );return false;">
				<input type="hidden" name="from" value="{{ $from ?? '' }}">
				<td align="left" height="25" class="class_admin_table_head">
					검색어
				</td>
				<td align="left" height="25" class="class_admin_table_blank">
					<!--input type="hidden" name="p_no" value="{{ $p_no ?? ""  }}"-->
					<input type="text" name="query" id="query" value="{{ $address ?? "" }}" size="80">
					<!--input type="submit" onclick="" value="검색"-->
					<input type="button" id="btn_search" -onclick="search_address2point()" value="검색">
				</td>
				</form>
			</tr>
			<tr>
				<form action='' method='post' id='geoForm'>
				<input type="hidden" name="p_id" value="{{ $p_id ?? ""  }}">
				<input type="hidden" name="step" value="map_update">
				<td align="left" height="25" class="class_admin_table_head">
					좌표
				</td>
				<td align="left" height="25" class="class_admin_table_blank">
                    Latitude : <input id='lat' type='text' size='20' name='lat' value='{{ $lat?? "" }}' style="background-color: #eee" readonly="readonly" />
                    Longitude : <input id='lon' type='text' size='20' name='lon' value='{{ $lon ?? "" }}' style="background-color: #eee" readonly="readonly" />
						<input type="button" onclick="nmap_select_point();" value="저장" id="update_btn">
				</td>
				</form>


			</tr>
			<!--tr>
				<td align="left" height="25" class="class_admin_table_head">
					좌표주소
				</td>
				<td align="left" height="25" class="class_admin_table_blank">
						<span id="view_address"></span>
				</td>
			</tr-->
			</table>


				<div id="map" style="width:100%;height:400px;"></div>


		</td>
	</tr>
</table>
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('NCP_MAP_CLIENT_ID') }}&submodules=geocoder"></script>

<script type="text/javascript" src="/assets/js/nmap.js?sensor=true"> </script>
<script type="text/javascript">
    function nmap_address2point( address ){

        var myaddress = "";

        if( address == undefined ) {
            myaddress = "{{ $partner['p_address1'] ?? ""}} {{ $partner['p_address2'] ?? "" }}";
        } else {
            myaddress = address;
        }

        //$("#res").html("검색어 : " + myaddress);

        naver.maps.Service.geocode({address: myaddress}, function(status, response) {

            if (status !== naver.maps.Service.Status.OK) {
                return $("#res").append(myaddress + '의 검색 결과가 없거나 기타 네트워크 에러');
            }

            var result = response.result;
            //$("#res").append("<br>결과 : "+result);
            // 검색 결과 갯수: result.total
            // 첫번째 결과 결과 주소: result.items[0].address
            // 첫번째 검색 결과 좌표: result.items[0].point.y, result.items[0].point.x

            var myaddr = new naver.maps.Point(result.items[0].point.x , result.items[0].point.y );

            document.getElementById('lat').value = result.items[0].point.y;
            document.getElementById('lon').value = result.items[0].point.x;

            map.setCenter(myaddr); // 검색된 좌표로 지도 이동

            // 마커 표시
            var marker = new naver.maps.Marker({
                position: myaddr,
                map: map
            });

            // 좌표얻기

            // 마커 클릭 TOPIC 처리
            naver.maps.Event.addListener(marker, "click", function(e) {
                if (infowindow.getMap()) {
                    infowindow.close();
                } else {
                    infowindow.open(map, marker);
                }
            });

            // 마크 클릭시 인포윈도우 오픈
            /*
            var infowindow = new naver.maps.InfoWindow({
                content: '<h4> [네이버 개발자센터]</h4><a href="https://developers.naver.com" target="_blank"><img src="https://developers.naver.com/inc/devcenter/images/nd_img.png"></a>'
            });

             */
        });
    }	
	function nmap_select_point(){
		opener.document.form1.address1.value = document.getElementById('query').value;
		opener.document.form1.map_latitude.value = document.getElementById('lat').value;
		opener.document.form1.map_longitude.value = document.getElementById('lon').value;
		window.close();
	}
	</script>
<script>
	var map = new naver.maps.Map('map', {center: new naver.maps.LatLng('{{ $lat ?? "" }}', '{{ $lon ?? "" }}')});

	function marker_create( lat, lon ){
				var myaddr = new naver.maps.Point( lat, lon );
				map.setCenter(myaddr); // 검색된 좌표로 지도 이동
				// 마커 표시
				var marker = new naver.maps.Marker({
					position: myaddr,
					map: map
				});
	}
	if( $("#lat").val() ) {
		var new_lat = $("#lat").val();
		var new_lon = $("#lon").val();
	}else{
		var new_lat = 37;
		var new_lon = 127;
	}
	nmap_address2point();
	marker_create( new_lat , new_lon );

	geolocation.getCurrentPosition()
	</script>
<script type="text/javascript">
    //marker_create( new_lon , new_y );



    $(document).ready(function(){
        $("#btn_search").on("click",function(){
            nmap_address2point( $("#query").val() );
        });

        $("#btn_search").click();
    });

    document.getElementById("update_btn").focus();


	function onSuccessGeolocation(position) {
		var location = new naver.maps.LatLng(position.coords.latitude,
											 position.coords.longitude);

		map.setCenter(location); // 얻은 좌표를 지도의 중심으로 설정합니다.
		map.setZoom(10); // 지도의 줌 레벨을 변경합니다.

		infowindow.setContent('<div style="padding:20px;">' + 'geolocation.getCurrentPosition() 위치' + '</div>');

		infowindow.open(map, location);
		console.log('Coordinates: ' + location.toString());
	}

	function onErrorGeolocation() {
		var center = map.getCenter();

		infowindow.setContent('<div style="padding:20px;">' +
			'<h5 style="margin-bottom:5px;color:#f00;">Geolocation failed!</h5>'+ "latitude: "+ center.lat() +"<br />longitude: "+ center.lng() +'</div>');

		infowindow.open(map, center);
	}

    if (navigator.geolocation) {
        /**
         * navigator.geolocation 은 Chrome 50 버젼 이후로 HTTP 환경에서 사용이 Deprecate 되어 HTTPS 환경에서만 사용 가능 합니다.
         * http://localhost 에서는 사용이 가능하며, 테스트 목적으로, Chrome 의 바로가기를 만들어서 아래와 같이 설정하면 접속은 가능합니다.
         * chrome.exe --unsafely-treat-insecure-origin-as-secure="http://example.com"
         */
        navigator.geolocation.getCurrentPosition(onSuccessGeolocation, onErrorGeolocation);
    } else {
        var center = map.getCenter();
        infowindow.setContent('<div style="padding:20px;"><h5 style="margin-bottom:5px;color:#f00;">Geolocation not supported</h5></div>');
        infowindow.open(map, center);
    }

</script>
<script LANGUAGE="JavaScript">
    self.focus()
</script>

</body>
</html>
