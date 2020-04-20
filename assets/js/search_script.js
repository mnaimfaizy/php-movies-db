// JavaScript Document
$('input#searchQuery').on('keyup', function() {
	var query = $('input#searchQuery').val();
	console.log(query);
	var myExp = new RegExp(query, "i");
	if($.trim(query) != '') {
		$.post('ajax/search_result.php', {query: query}, function(data) {
				$('div#update ul.searchresults').html(data);
		});
	} else {
		$('div#update ul.searchresults').html(null);
	}
});