function dispOrder(response, date, userid){
	$("#order_Info").append($("<div class='col-md-10 col-md-offset-1'></div>")
					.append($("<div id='orderbox'></div>")
					.append($("<div class='text-left'></div>")
					.text("日付：" + date))
					.append($("<div class='text-left'></div>")
					.text("施設名：" + response.facility_name))
					.append($("<div class='text-left'></div>")
					.text("住所：〒" + response.zip + response.address)))
					);
	console.log(response.ident);
	console.log(userid);
	$("#facilityIdent").val(response.ident);
	$("#userid").val(userid);
}