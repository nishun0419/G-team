 function initMap(address) {
 	//住所から経度と緯度を表示
 	var geocoder = new google.maps.Geocoder();
 	geocoder.geocode( { 'address': address}, function(resulsts,status){
 		if(status == google.maps.GeocoderStatus.OK){
 			console.log(resulsts[0].geometry.location);
        	var map = new google.maps.Map(document.getElementById("map"), { // #mapidに地図を埋め込む
           		zoom: 19, // 地図のズームを指定
         	});
        	map.setCenter(resulsts[0].geometry.location);
        	var marker = new google.maps.Marker({ // マーカーの追加
        	position: resulsts[0].geometry.location, // マーカーを立てる位置を指定
        	map: map, // マーカーを立てる地図を指定
       		});
       	}
       	else{
       		console.log("false");
       	}
    });
}