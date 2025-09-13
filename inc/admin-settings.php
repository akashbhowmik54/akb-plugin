<?php

function akb_settings_init() {
	// register a new setting for "akbplugin" page
	register_setting('akbplugin', 'akb_setting_field_txt');
	register_setting('akbplugin', 'akb_setting_field_checkbox');

	// register a new section in the "akbplugin" page
	add_settings_section(
		'akb_settings_section_general',
		'General Settings', 
		'akb_settings_section_general_callback',
		'akbplugin'
	);

	add_settings_section(
		'akb_settings_section_misc',
		'Misc Settings', 
		'akb_settings_section_misc_callback',
		'akbplugin_sub'
	);

	// register a new field in the "wporg_settings_section" section, inside the "akbplugin" page
	add_settings_field(
		'akb_settings_field_1',
		'Text Field', 
		'akb_txt_settings_field_callback',
		'akbplugin',
		'akb_settings_section_general'
	);

	add_settings_field(
		'akb_settings_field_2',
		'Checkbox Field', 
		'akb_checkbox_settings_field_callback',
		'akbplugin_sub',
		'akb_settings_section_misc'
	);
}

/**
 * register wporg_settings_init to the admin_init action hook
 */
add_action('admin_init', 'akb_settings_init');

/**
 * callback functions
 */

// section content cb
function akb_settings_section_general_callback() {
	echo '<p> Manage Main Plugin Settings.</p>';
}

function akb_settings_section_misc_callback() {
	echo '<p> Manage Settings.</p>';
}

// field content cb
function akb_txt_settings_field_callback() {
	// get the value of the setting we've registered with register_setting()
	$setting = get_option('akb_setting_field_txt');
	// output the field
	?>
	<input type="text" name="akb_setting_field_txt" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

function akb_checkbox_settings_field_callback() {
	$setting = get_option('akb_setting_field_checkbox');
	?>
	<input type="checkbox" name="akb_setting_field_checkbox" <?php echo ($setting == 'on' ? 'checked' : '') ?> >
    <?php
}