<?php
/**
 * Actions
 */
function akb_footer_text() {
    echo 'Copyrights &copy; 2025. AKB Plugin';
}
add_action( 'wp_footer', 'akb_footer_text', 20 );

function akb_meta_info() {
	if ( is_singular( 'post' ) ) {
		echo '<meta property="og:title" content="'  . esc_attr( get_the_title() )   . "\" />\n";
		echo '<meta property="og:description" content="' . esc_attr( get_the_excerpt() ) . "\" />\n";
	}
}
add_action( 'wp_head', 'akb_meta_info', 999 );

/**
 * Filters
 */
function akb_post_title($title) {
    $emoji = '📄';
    if(is_singular('post')) {
        return $emoji . $title;
    }
    return $title;
}
add_filter ('the_title', 'akb_post_title');

function akb_excerpt_length ($excerpt) {
    return 20;
}
add_filter('excerpt_length', 'akb_excerpt_length', 999);

/* function akb_post_content($title) {
    $text = '<h1>Overview</h1>';
    if(is_singular('post')) {
        return $text . $title;
    }
    return $title;
}
add_filter ('the_content', 'akb_post_content'); */