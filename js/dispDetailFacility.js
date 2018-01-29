function dispDetailFacility(response){
	$("#detail_Info").append($("<div class='col-md-10 col-md-offset-1'></div>")
					 .append($("<div class='row'></div>")
					 .append($("<div class='col-md-6 no-float'></div>")
					 .append($("<div id='facCarousel' class='carousel slide' date-ride='carousel'></div>")
					 .append($("<ol class='carousel-indicators'></ol>")
					 .append($("<li class='active' data-target='#facCarousel' data-slide-to='0'></li>"))
					 .append($("<li data-target='#facCarousel' data-slide-to='1'></li>"))
					 .append($("<li data-target='#facCarousel' data-slide-to='2'></li>")))
					 .append($("<div class='carousel-inner' role='listbox'></div>")
					 .append($("<div class='item active'></div>")
					 .append($("<img class='img-responsive img0' alt='first'>")))
					 .append($("<div class='item'></div>")
					 .append($("<img class='img-responsive img1' alt='second'>")))
					 .append($("<div class='item'></div>")
					 .append($("<img class='img-responsive img2' alt='third'>"))))
					 .append($("<a class='left carousel-control' href='#facCarousel' role='button' data-slide='prev'></a>")
					 .append($("<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>"))
					 .append($("<span class='sr-only'></span>")
					 .text("前へ")))
					 .append($("<a class='right carousel-control' href='#facCarousel' role='button' data-slide='next'></a>")
					 .append($("<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>"))
					 .append($("<span class='sr-only'></span>")
					 .text("次へ")))))
					 .append($("<div class='col-md-6 no-float'></div>")
					 .append($("<div id='facility_info_box'></div>")
					 .append($("<div class='text-left'></div>")
					 .text("施設名：" + response.FacName))
					 .append($("<div class='text-left'></div>")
					 .text("住所：" + response.PostNum + response.Pref + response.Address))
					 .append($("<div class='text-left'></div>")
					 .text("人数：" + response.PeopleNum))
					 .append($("<div class='text-left'></div>")
					 .text("説明：" + response.Exposition))
					 .append($("<div class='text-left infra_Zone'></div>")
					 .append($("<label class='infraLabel' id='infra1'></label>")
					 .text("電気あり"))
					 .append($("<label class='infraLabel' id='infra2'></label>")
					 .text("水道あり"))
					 .append($("<label class='infraLabel' id='infra3'></label>")
					 .text("ガスあり"))
					 .append($("<label class='infraLabel' id='infra4'></label>")
					 .text("トイレあり"))
					 .append($("<label class='infraLabel' id='infra5'></label>")
					 .text("バリアフリー"))
					 .append($("<label class='infraLabel' id='infra6'></label>")
					 .text("ネットあり"))
					 .append($("<label class='infraLabel' id='infra7'></label>")
					 .text("駐車場あり"))
					 .append($("<label class='infraLabel' id='infra8'></label>")
					 .text("冷暖房あり"))
					 .append($("<label class='infraLabel' id='infra9'></label>")
					 .text("飲食OK"))
					 .append($("<label class='infraLabel' id='infra10'></label>")
					 .text("火気OK")))
					 .append($("<div class='text-right' id='price'></div>")
					 .text("￥"+ separate(response.Price))))
					 .append($("<div id='map'></div>"))))
					 .append($("<div class='row'></div>")
					 .append($("<div id='calendar'></div>"))));
		for(i = 0; i < 3; i++){
			if(response.images[i] === ""){
				$(".img"+i).attr({'src':'/php/image/noimage.jpg'});
			}
			else{
				$(".img"+i).attr({'src':'/php/image/post_image/'+response.images[i]});
			}
		}
		for(i = 0; i < 10; i++){
			index = i + 1;
			if(response.infraLabel[i] === "1"){
				$("#infra" + index).show();
			}
		}
	document.addEventListener( 'DOMContentLoaded', initMap(response.Address));
}
