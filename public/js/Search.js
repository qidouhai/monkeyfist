$(document).ready(function() {
	// $(".search-bar").select2();

	$('.search-bar').select2({
		placeholder: "Search...",
		ajax: {
			url: function(params) {
				return '/search/' + params.term;
			},
			dataType: 'json',
			delay: 100,
			processResults: function(data, params) {
				params.page = params.page || 1;

				console.log(data);
				return {
					results: data.items,
					pagination: {
						more: (params.page * 30) < data.total_count
					}
				};
			},
			cache: true
		},
		escapeMarkup: function(markup) { return markup; },
		minimumInputLength: 1,
		templateResult: formatRepo, 
  		templateSelection: formatRepoSelection
	});


	$('.search-bar').on("select2:select", function (e) {
		// console.log(e);
		if(e.params.data.username)
			window.location = '/profile/' + e.params.data.id;
		else 
			window.location = '/feed/' + e.params.data.id;
	});
});

function formatRepo(repo) {
	if(repo.loading) return repo.text;

	let markup = '';
	if(repo.text) { // map to optgroup tag
		markup = '<div>' + repo.text + '</div>';
	} else { // map to option tag
		if(repo.username) {
			markup = '<div><div style="display: inline-block;"><img src="/img/default-profile.png" height="32" /></div><div style="display: inline-block; margin-left: 15px;"><a style="font-size: large;" href="/profile/' + repo.id + '">' + repo.username + '</a></div></div>';
		} else {
			markup = '<div><a href="#">' + repo.user.username + '<br>' + repo.created + '</a></div>';
		}
	}
	return markup;
}

function formatRepoSelection(repo) {
	return repo.id;
}