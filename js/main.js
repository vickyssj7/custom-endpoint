$(document).ready(function() {
	$('.users-lists').DataTable( {
		"processing": true,
        "serverSide": true,
		paging: false,
		searching: false,
		ordering:  false,
		"info": false,
		"ajax": ajax_object.ajax_url +'?action=users_list'
	} );
} );