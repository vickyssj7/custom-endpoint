$(document).ready(function() {
	$('.users-lists').DataTable( {
		"processing": true,
        "serverSide": true,
		paging: false,
		searching: false,
		ordering:  false,
		"info": false,
		"ajax": { 
			url: ajax_object.ajax_url +'?action=users_list',
			error: function(err) {
				alert("Something went wrong, please try refreshing your browser.");
			}
		}
	} );
	
	
	var oCnt = $('.single-user-modal .modal-body').clone();
	$(document).on('click', '.view-user', function(e) {
		e.preventDefault();
		var userId = $(this).data('userid');
		$('.single-user-modal .modal-body').html(oCnt.html());
		$('.single-user-modal').removeClass('hide');
		$.ajax({
			url: ajax_object.ajax_url +'?action=single_user&id='+userId,
			success: function(res) {
				$('.single-user-modal .modal-body').html(res.data);
			},
			error: function(err) {
				$('.single-user-modal').html("Something went wrong! Please try refreshing your browser.");
			}
		});
	});
	
	$(document).on('click', '.single-user-modal .modal-overlay', function() {
		$('.single-user-modal .modal-body').html(oCnt.html());
		$('.single-user-modal').addClass('hide');
	});
	
} );