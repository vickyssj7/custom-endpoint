
<div class = "modal">
	<div class = "table">
		<table class = "single-user">
			<tbody>
				<tr><td><strong>ID</strong></td><td><?=$result->id?></td></tr>
				<tr><td><strong>Name</strong></td><td><?=$result->name?></td></tr>
				<tr><td><strong>User Name</strong></td><td><?=$result->username?></td></tr>
				<tr><td><strong>Email</strong></td><td><?=$result->email?></td></tr>
				<tr><td><strong>Phone</strong></td><td><?=$result->phone?></td></tr>
				<tr><td><strong>Website</strong></td><td><a href = "http://<?=$result->website?>"><?=$result->website?></a></td></tr>
				<tr><td><strong>Address</strong></td><td><?=$result->address->street?>, <?=$result->address->suite?>, <?=$result->address->city?>, <?=$result->address->zipcode?></td></tr>
				<tr><td><strong>Company</strong></td><td><?=$result->company->name?></td></tr>
			</tbody>
		</table>
	</div>
</div>
