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
					 .text("住所：" + response.PostNum + response.Address))
					 .append($("<div class='text-left'></div>")
					 .text("人数：" + response.PeopleNum))
					 .append($("<div class='text-left'></div>")
					 .text("説明：" + response.Exposition))
					 .append($("<div class='text-right' id='price'></div>")
					 .text("￥"+response.Price)))))
					 .append($("<div class='row'></div>")
					 .append($("<div class='col-md-6 no-float'></div>")
					 .append($("<div id='map'></div>")))
					 .append($("<div class='col-md-6 no-float'></div>")
					 .append($("<form method='GET' action='/php/php/order.php'></form>")
					 // .append($("<input type='text' name='calendar_val' id='calendar_val'>"))
					 .append($("<input type='hidden' name='id'>")
					 .val(response.UpID))
					 // .append($("<input type='submit' value='申込'>"))
					 )
					 .append($("<p id = 'calendar_message'></p>"))
					 .append($("<div id='calendar'></div>")))
					 ));
		for(i = 0; i < 3; i++){
			if(response.images[i] === null){
				$(".img"+i).attr({'src':'/php/image/noimage.jpg'});
			}
			else{
				$(".img"+i).attr({'src':'/php/image/'+response.images[i]});
			}
		}
	document.addEventListener( 'DOMContentLoaded', initMap(response.Address));
}