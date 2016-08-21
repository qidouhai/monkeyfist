$(document).ready(function() {
	// $(".search-bar").select2();

	
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