$(document).ready(function () {
	$('div.icon').click(function() {
		$('input#search').focus();
	})


	function search() {
		var query_value = $('input#search').val();
		$('b#search-string').text(query_value);
		if (query_value !== '') {
			$.ajax({
				type: "POST",
				url: "search.php",
				data :{ query: query_value},
				cache: false,
				success: function(html) {
					$("ul#results").html(html);
				}
			});
		} return false;
	}

	$("input#search").on("keyup", null, function(e) {
		clearTimeout($.data(this,'timer'));

		var search_string = $(this).val();

		if (search_string == '') {
			$("ul#results").fadeOut();
			$('h4#results-text').fadeOut();
		}
		else {
			$("ul#results").fadeIn();
			$("h4#results-text").fadeIn();
			$(this).data('timer', setTimeout(search,100));
		};
	});
});