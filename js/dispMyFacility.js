function dispMyFacility(response, count){
	$("#facilityList").append($("<div class='col-md-10 col-md-offset-1 facilityBox'><div>")
					  .append($("<div class='media'></div>")
					  .append($("<a class='media-left' href='#'></a>")
					  .append($("<img class='samune' id='samune"+count+"'>")
					  .attr({'src' : "/php/image/" + response.images})))
					  .append($("<div class='media-body'></div>")
					  .text("〒" + response.zip + response.address)
					  .append($("<h4></h4>")
					  .append($("<a></a>")
					  .attr({'href':'/php/php/order_check.php?id=' + response.ident})
					  .text(response.facility_name)))
					  )
					  )
					  );
	  // .append($("<div class='delete_facility'></div>")
			// 		  .text('削除'))
			// 		  .append($("<div class='edit_facility'></div>")
			// 		  .text('編集'));
	if(response.images === null){
		$("#samune" + count).attr('src', '/php/image/noimage.jpg');
	}
}