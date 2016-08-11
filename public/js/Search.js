$(document).ready(function() {
	$(".search-bar").select2();

	$('.search-bar').select2({
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
		console.log(e);
		window.location = '/feed/' + e.params.data.id;
	});
});

function formatRepo(repo) {
	let markup = '<div><a href="/login">' + repo.id + '</a></div>';
	return markup;
}

function formatRepoSelection(repo) {
	return repo.user.username || repo.id;
}