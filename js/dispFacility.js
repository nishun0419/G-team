function dispFacility(response, i){
	$("#serchResult").append($("<div class='col-md-10 col-md-offset-1 resultbox'></div>")
					 .append($("<div class='col-md-6'></div>")
					 .append($("<div class='text-left'></div>")
					 .append($("<h2></h2>")
					 .append($("<a></a>")
					 .text(response.FacName)
					 .attr({'href':'/php/php/detail_Facility.php?id=' + response.UpID}))))
					 .append($("<div class='text-left'></div>")
					 .text("〒"+response.PostNum + response.Address))
					 .append($("<div class='text-left'></div>")
					 .text("人数：" + response.PeopleNum))
					 .append($("<div class='text-left message'></div>")
					 .text(response.Exposition)))
					 .append($("<div class='col-md-6'></div>")
					 .append($("<img class='img-responsive' id='facility_img"+i+"'>")
					 .attr({'src' : "/php/image/" + response.image})))
					 );
	if(response.image === null){
		$("#facility_img"+i).attr('src', '/php/image/noimage.jpg');
	}
}