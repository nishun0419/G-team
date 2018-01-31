function dispMyOrder(response, count){
	$("#orderList").append($("<div class='col-md-10 col-md-offset-1 orderBox'><div>")
					  .append($("<div class='media'></div>")
					  .append($("<a class='media-left' href='#'></a>")
					  .append($("<img class='samune' id='ordersamune"+count+"'>")
					  .attr({'src' : "/php/image/post_image/" + response.Image})))
					  .append($("<div class='media-body'></div>")
					  .text("〒" + response.PostNum + "　" + response.Pref + response.Address)
					  .append($("<h4></h4>")
					  .append($("<a></a>")
					  .attr({'href':'/php/php/order_detail.php?ResID=' + response.ResID})
					  .text(response.FacName)))
					  .append($("<div class='text-right'></div>")
					  .text(response.orderdate))
					  )
					  )
					  );
	  // .append($("<div class='delete_facility'></div>")
			// 		  .text('削除'))
			// 		  .append($("<div class='edit_facility'></div>")
			// 		  .text('編集'));
	if(response.Image === ""){
		$("#ordersamune" + count).attr('src', '/php/image/noimage.jpg');
	}
}