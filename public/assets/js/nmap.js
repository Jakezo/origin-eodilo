let marker_arr = new Array();
let point_arr = new Array();

function open_nmap_pointwindow( no, query1, query2, step ){
	var url  = '/nmap/nmap_get_point?no='+no;
	if( query1!= undefined && query1.length > 0 ) url = url + '&query1=' + query1;
	if( query2!= undefined && query2.length > 0 ) url = url + '&query2=' + query2;
	if( step!= undefined && step.length > 0 ) url = url + '&step=' + step;

	window.open( url,  'pop_postno', 'width=800,height=670,scrollbars=1' );
}

function marker_create( x, y ){
	var myaddr = new naver.maps.Point( x, y );
	map.setCenter(myaddr); // 검색된 좌표로 지도 이동
	// 마커 표시
	var marker = new naver.maps.Marker({
		position: myaddr,
		map: map
	});
}

function view_map(latitude, longitude){
	var myaddr = new naver.maps.Point(latitude, longitude);
	map.setCenter(myaddr); // 검색된 좌표로 지도 이동
}


function view_point(point_idx){
	console.log("step. 1");
	console.log(point_idx);

	console.log("step. 2");
	let point = point_arr[point_idx];
	console.log(point);

	console.log("step. 3");
	map.setCenter(point); // 검색된 좌표로 지도 이동

}

function view_info_window(marker){
	// 마커 클릭 이벤트 처리
	naver.maps.Event.addListener(marker, "click", function(e) {
		if (infowindow.getMap()) {
			infowindow.close();
		} else {
			infowindow.open(map, marker);
		}
	});

	var infowindow = new naver.maps.InfoWindow({
		content: '<h4> [네이버 개발자센터]</h4><a href="https://developers.naver.com" target="_blank"><img src="https://developers.naver.com/inc/devcenter/images/nd_img.png"></a>'
	});

}