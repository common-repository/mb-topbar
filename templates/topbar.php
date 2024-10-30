<?php

use Inc\Api\Callbacks\TopbarCallbacks;

$topbar_callback = new TopbarCallbacks();

?>
<div class="wrap">
	<h1><?php esc_html_e( 'Add/Edit Showcase', 'mb-topbar' ); ?></h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="<?php echo !isset($_POST["edit_post"]) ? 'active' : '' ?>"><a href="#tab-1"><?php esc_html_e( 'Showcase List', 'mb-topbar' ); ?></a></li>
		<li class="<?php echo isset($_POST["edit_post"]) ? 'active' : '' ?>">
			<a href="#tab-2">
				<?php echo isset($_POST["edit_post"]) ? esc_html( 'Edit' ) : esc_html( 'Add' ); esc_html_e( ' Showcase' ); ?>
			</a>
		</li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane <?php echo !isset($_POST["edit_post"]) ? esc_html_e( 'active' ) : '' ?>">

			<?php
        $options = get_option( 'mb_topbar_list' ) ?: array();

				$topbar_callback->cptTable($options);

			?>

		</div>

		<div id="tab-2" class="tab-pane <?php echo isset($_POST["edit_post"]) ? 'active' : '' ?>">
			<form method="post" action="options.php">
				<?php
					settings_fields( 'mb_topbar_list_settings' );
					do_settings_sections( 'mb_topbar_list_page' );
					submit_button();
				?>
			</form>
		</div>
	</div>
</div>
