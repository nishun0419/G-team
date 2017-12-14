function dispFacility(response, i){
	$("#serchResult").append($("<div class='col-md-10 col-md-offset-1 resultbox'></div>")
					 .append($("<div class='col-md-6'></div>")
					 .append($("<div class='text-left'></div>")
					 .append($("<h2></h2>")
					 .append($("<a></a>")
					 .text(response.facility_name)
					 .attr({'href':'/php/php/detail_Facility.php?id=' + response.ident}))))
					 .append($("<div class='text-left'></div>")
					 .text("〒"+response.zip + response.address))
					 .append($("<div class='text-left'></div>")
					 .text("人数：" + response.capacity))
					 .append($("<div class='text-left message'></div>")
					 .text(response.message)))
					 .append($("<div class='col-md-6'></div>")
					 .append($("<img class='img-responsive' id='facility_img"+i+"'>")
					 .attr({'src' : "/php/image/" + response.images})))
					 );
	if(response.images === null){
		$("#facility_img"+i).attr('src', '/php/image/noimage.jpg');
	}
}