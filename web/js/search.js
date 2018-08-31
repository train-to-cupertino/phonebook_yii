$(".do_search").click(function() {
	$(".search_results").html("");
	
	if ($(".name").val() == '' && $(".phone").val() == '') {
		alert(1);
		return;
		
	}
		
	
	$(".search_results").append($("<img>", { src: "/img/ajax.gif", style: "margin: 0 auto; display: block;" }));
	
	$.post("/contact/ajaxsearchresult", { name: $(".name").val(), phone: $(".phone").val(),  }, function( data ) {
		$(".search_results").html(data);
	});
});