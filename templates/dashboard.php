<div class="wrap">
	<h1><?php esc_html_e( 'Dashboard', 'mb-topbar' ); ?></h1>
	<?php settings_errors(); ?>

	<div class="dashboard">
		<div class="info">
			<p><?php esc_html_e( 'With this plugin you can showcase your websites. It uses page template Topbar. Menu on top of the page, will change source of the iframe bellow.', 'mb-topbar' ); ?></p>
			<div class="developer">
				<h3>Developer</h3>
				<p>Tihomir Selak</p>
				<a href="https://www.tihomir-selak.from.hr/" trget="_blank">www.tihomir-selak.from.hr</a>
			</div>
		</div>
		<form method="post" action="options.php">
			<?php
				settings_fields( 'mb_topbar_settings' );
				do_settings_sections( 'mb_topbar' );
				submit_button();
			?>
		</form>
	</div>
</div>
