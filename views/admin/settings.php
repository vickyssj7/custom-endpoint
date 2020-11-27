<div class = "wrap">
	<h1>Change Custom Endpoint</h1>
	<form name ='form' method = "POST">
		<?php if(!empty($error)) { ?>
			<div class = "wp-error">
			<?php foreach($error as $err) { ?>
				<p><?php echo $err; ?></p>
			<?php } ?>
			</div>
		<?php } ?>
		<?php wp_nonce_field('custom_endpoint_nonce') ?>
		<p>Custom endpoint settings to change the default endpoint value. Enter a unique custom endpoint.</p>
		<h3><label>Endpoint</label></h3>
		<p><input type = 'text' name = 'custom_endpoint' value = "<?=get_option('custom_endpoint_slug')?>" /></p>
		
		<p class="submit">
			<input type = 'submit' class = 'button button-primary' value = "Save Changes" name = 'submit' />
		</p>
	</form>
</div>