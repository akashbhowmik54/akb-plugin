<?php
function akb_plugin_page() {
    ?>
    <div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">
        <?php

        // output security fields for the registered setting "wporg_options"
        settings_fields( 'wporg_options' );

        // output setting sections and their fields
        // (sections are registered for "wporg", each field is registered to a specific section)
        do_settings_sections( 'wporg' );

        // output save settings button
        submit_button( __( 'Save Settings', 'msr-plugin' ) );
        ?>
      </form>
    </div>
    <?php
}

function akb_plugin_sub_page() {
    ?>
    <div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">

      </form>
    </div>
    <?php
}