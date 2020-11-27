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
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<?php
get_footer();
?>