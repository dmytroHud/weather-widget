<?php
use WeatherWidget\App;
?>

<h1><?php echo __('Weather Widget Settings', App::TEXT_DOMAIN); ?></h1>

<form method="post" enctype="multipart/form-data">

	<table class="floated-form-table form-table">

		<tr valign="top">
			<th scope="row"><?php echo __('API Key', App::TEXT_DOMAIN); ?></th>
			<td>
				<input type="text" name="ww-api-key" value="<?php echo get_option('ww-api-key'); ?>">
			</td>
		</tr>

	</table>

	<?php wp_nonce_field(); ?>
	<button type="submit" class="button"><?php echo __('Save', App::TEXT_DOMAIN); ?></button>
</form>
