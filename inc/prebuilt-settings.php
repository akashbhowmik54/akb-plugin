<?php

function akb_settings_init() {
    add_settings_section(
        'akb_options_section',
        __('AKB Plugin Settings', 'akb-plugin'),
        function() {
            
        },
        'akb-settings'
    );

    
    add_settings_field(
        'akb_default_shortcode_txt',
        __('Default Shortcode Text', 'akb-plugin'),
        function() {
            $value = get_option('akb_default_shortcode_txt');
            ?>
            <input
            type="text"
            name="akb_default_shortcode_txt"
            id="akb_default_shortcode_txt"
            value="<?php echo esc_attr($value); ?>"
            class="regular-text"
            placeholder="This is a Test Shortcode"
        />
            
            <?php
        },
        'akb-settings',
        'akb_options_section'
    );

    register_setting('akb_options', 'akb_default_shortcode_txt');

    add_settings_field(
        'akb_enable_shortcodes',
        __('Enable Shortcodes', 'akb-plugin'),
        function() {
            $value = get_option('akb_enable_shortcodes');
            ?>
            <select
            name="akb_enable_shortcodes"
            id="akb_enable_shortcodes"
            class="regular-text"
        >
            <option value=""><?php _e('Select an option', 'akb-plugin'); ?></option>
            <?php
            // Example options - replace with actual options
            $options = array(
                'yes' => __('Yes', 'akb-plugin'),
                'no' => __('No', 'akb-plugin'),
            );
            
            foreach ($options as $option_value => $option_label) {
                printf(
                    '<option value="%s" %s>%s</option>',
                    esc_attr($option_value),
                    selected($value, $option_value, false),
                    esc_html($option_label)
                );
            }
            ?>
        </select>
            
            <?php
        },
        'akb-settings',
        'akb_options_section'
    );

    register_setting('akb_options', 'akb_enable_shortcodes');
}
add_action('admin_init', 'akb_settings_init');