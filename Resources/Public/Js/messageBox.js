$(document).ready(function() {
	$(".message-box a").click(function (event) {
		event.preventDefault();
		var ajaxUrl = $(this).attr('href').substring(2,$(this).attr('href').lenght);
		
		$.ajax({
			url: "index.php",
	    	data: ajaxUrl,
			success: function(data){
				if (data){
					console.log('success');
					console.log(data)
				}else{
					console.log("Just wrong");
				}
			},
			error: function(data){
				
			}
		});

	});
});


