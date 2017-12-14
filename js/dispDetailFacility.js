function dispDetailFacility(response){
	$("#detail_Info").append($("<div class='col-md-10 col-md-offset-1'></div>")
					 .append($("<div class='col-md-6'></div>")
					 .append($("<img class='img-responsive'></div>")
					 .attr({'src' : "/php/image/" + response.images}))
					 .append($("<div class='row'></div>")
					 .append($("<div id='map'></div>"))))
					 .append($("<div class='col-md-6'></div>")
					 .append($("<div id='facility_info_box'></div>")
					 .append($("<div class='text-left'></div>")
					 .text("施設名：" + response.facility_name))
					 .append($("<div class='text-left'></div>")
					 .text("住所：" + response.zip + response.address))
					 .append($("<div class='text-left'></div>")
					 .text("人数：" + response.capacity))
					 .append($("<div class='text-left'></div>")
					 .text("説明：" + response.message))
					 .append($("<div class='text-right' id='price'></div>")
					 .text("￥"+response.price))
					 )
					 .append($("<form method='GET' action='/php/php/order.php'></form>")
					 .append($("<input type='text' name='calendar_val' id='calendar_val'>"))
					 .append($("<input type='hidden' name='id'>")
					 .val(response.ident))
					 .append($("<input type='submit' value='申込'>")))
					 .append($("<p id = 'calendar_message'></p>"))
					 .append($("<div id='calendar'></div>"))
					 )
					 );
		if(response.images === null){
		$(".img-responsive").attr('src', '/php/image/noimage.jpg');
	}
	document.addEventListener( 'DOMContentLoaded', initMap(response.address));
}