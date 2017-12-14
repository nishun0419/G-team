function dispMessage(response){
	$("#dispmessage").append($("<div class='col-md-8 col-md-offset-2 message'></div>")
					.append($("<div class='panel panel-info'></div>")
					.append($("<div class='panel-heading'></div>")
					.append($('<a></a>')
					.text(response.title)
					.attr({'href': '/php/php/detail.php?messageid='+ response.messageid})))
					.append($("<div class='panel-body'></div>")
					.text(response.message)
					.append($("<p class='text-right'></p>")
					.text(response.posttime))
					)
					)
					);
}