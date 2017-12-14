function dispDetailMessage(response){
	$("#dispmessage").append($("<div class='col-md-10 col-md-offset-1'></div")
					 .append($("<div class='panel panel-info'></div>")
					 .append($("<div class='panel-heading'></div>")
					 .append($("<h2></h2>")
					 .text(response.title)))
					 .append($("<div class='panel-body'></div>")
					 .text(response.message)
					 .append($("<p class='text-right'></p>")
					 .text(response.posttime))
					 )
					 )
					 );
}