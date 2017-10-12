$(document).ready(function() {
	$(".message-box a").click(function (event) {
		event.preventDefault();
		var ajaxUrl = $(this).attr('href').substring(2,$(this).attr('href').lenght);
		var currentElement = $(this);
		$.ajax({
			url: "index.php",
	    	data: ajaxUrl,
			success: function(data){
				if (data){
					var obj = jQuery.parseJSON(data);
					if(obj.result === 'updateOK'){
						currentElement.parent().hide();
					}
				}
			},
		});

	});
});


