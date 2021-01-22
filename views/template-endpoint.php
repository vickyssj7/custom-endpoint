<?php
global $json_placeholder_data;
get_header();
?>

<div class = "container">
	<div class = "table">
		<table class = "users-lists">
			<thead>
				<tr>
				<?php foreach($json_placeholder_data->tableHeaders() as $header_name) { ?>
					<th><?=$header_name?></th>
				<?php } ?>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<div class = "single-user-modal hide">
	<div class = "modal-body">
		<h3 style="text-align:center;">Loading...</h3>
	</div>
	<div class = "modal-overlay">
	</div>
</div>
<?php
get_footer();
?>