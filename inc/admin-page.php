<?php
function akb_plugin_page() {
    ?>
    <div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">
        <?php

        settings_fields( 'akbplugin' );

        do_settings_sections( 'akbplugin' );

        // output save settings button
        submit_button( __( 'Save Settings', 'akb-plugin' ) );
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
          <?php 
            settings_fields( 'akbplugin_sub' );
            do_settings_sections( 'akbplugin_sub' );
            submit_button( __( 'Save Settings', 'akb-plugin' ) );
          ?>
      </form>
    </div>
    <?php
}