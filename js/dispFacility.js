function dispFacility(response, i){ //検索結果表示
	$("#serchResult").append($("<div class='col-md-5 col-md-offset-1 resultbox'></div>")
					 .append($("<img class='img-responsive facilityImage center-block' id='facility_img"+i+"'>")
					 .attr({'src' : "/php/image/post_image/" + response.image}))
					 .append($("<div class='row'></div>")
					 .append($("<div class='text-left fac_name'></div>")
					 .append($("<a></a>")
					 .text(response.FacName)
					 .attr({'href':'/php/php/detail_facility.php?id=' + response.UpID})))
					 .append($("<div class='text-left'></div>")
					 .text("〒"+response.PostNum + response.Pref + response.Address))
					 .append($("<div class='text-left'></div>")
					 .text("人数：" + response.PeopleNum )))
					 .append($("<div class='price'></div>")
					 .text("￥" + response.Price))
					 );
	if(response.image === ""){
		$("#facility_img"+i).attr('src', '/php/image/noimage.jpg');
	}
}