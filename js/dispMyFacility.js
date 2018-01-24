function dispMyFacility(response, count){
	$("#facilityList").append($("<div class='facilityBox'><div>")
					  .append($("<div class='media'></div>")
					  .append($("<a class='media-left' href='#'></a>")
					  .append($("<img class='samune' id='samune"+count+"'>")
					  .attr({'src' : "/php/image/post_image/" + response.Image})))
					  .append($("<div class='media-body'></div>")
					  .text("〒" + response.PostNum + response.Pref + response.Address)
					  .append($("<h4></h4>")
					  .append($("<a></a>")
					  .attr({'href':'/php/php/order_check.php?id=' + response.UpID})
					  .text(response.FacName)))
					  .append($("<div class='text-right' id='buttons"+count+"'></div>")
					  .append($("<a class='fac_edit_button'></a>")
					  .text("編集")
					  .attr({'href':'/php/php/postEdit.php?UpID='+response.UpID}))
					  .append($("<input type='hidden' class='cancelID'>")
					  .val(response.UpID))
					  )
					  )
					  )
					  );

	if(response.UpCancel === '1'){
	  	$('#buttons'+count).append($("<a class='upcancel_toggle cancel_button'></a>")
					  .text("取り下げ"))
	}
	else{
		$('#buttons'+count).append($("<a class='upcancel_toggle up_button'></a>")
		.text("再登録"))
	}
	if(response.Image === ""){
		$("#samune" + count).attr('src', '/php/image/noimage.jpg');
	}
}