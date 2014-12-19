<?php

/**
 * Add a Hook for Uninstall to delete the options from the database.
function et_divi_child_uninstall() {
	remove_option( 'et_divi_child' );
}
register_uninstall_hook( __FILE__, 'et_divi_child_uninstall' );
 */

/**
 * Add the Settings to the WP_Customizer
 * 
 * @param WP_Customize_Manager $wp_customize
 */
function et_divi_child_register( $wp_customize ) {
	$options = array(
		'designed_by'		=> 'Designed By',
		'designed_by_url'	=> 'http://www.elegantthemes.com',
		'designed_by_name'	=> 'Elegant Themes',
		'powered_by'		=> 'Powered By',
		'powered_by_url'	=> 'http://www.wordpress.com',
		'powered_by_name'	=> 'WordPress'
	);
	add_option('et_divi_child', $options);
	
	//$theme = get_current_theme();
	$theme = 'divi-copyright';
	$section = 'et_divi_child_settings';
	
	$type = 'option';
	$capability = 'edit_theme_options';
	//$transport = 'postMessage';
	$transport = 'refresh';
	
	$wp_customize->add_section( $section , array(
		'title'			=> __( 'Footer Settings', $theme ),
		'description'	=> __( 'This allows the user to customize the copyright that is displayed in the footer.  The site title is used as the name of the site in the copyright.', $theme ),
	) );
	
	$wp_customize->add_setting( 'et_divi_child[start_year]', array(
		'type'			=> $type,
		'capability'	=> $capability,
		'transport'		=> $transport
	) );
	
	$wp_customize->add_control( 'et_divi_child[start_year]', array(
		'label'			=> __( 'Site began on', $theme ),
		'description'	=> __( 'Leave it blank if you do not want to display your starting year (displays only current year instead of the year range).', $theme ),
		'section'		=> $section,
		'type'			=> 'text',
	) );

	$wp_customize->add_setting( 'et_divi_child[designed_by]', array(
		'type'			=> $type,
		'capability'	=> $capability,
		'transport'		=> $transport,
	) );

	$wp_customize->add_control( 'et_divi_child[designed_by]', array(
		'label'			=> __( 'Designed By', $theme ),
		'description'	=> __( 'Leave it blank if you do not want to display Developer Credits on your footer.', $theme ),
		'section'		=> $section,
		'type'      	=> 'text',
	) );

	$wp_customize->add_setting( 'et_divi_child[designed_by_url]', array(
		'type'			=> $type,
		'capability'	=> $capability,
		'transport'		=> $transport,
	) );

	$wp_customize->add_control( 'et_divi_child[designed_by_url]', array(
		'label'			=> __( 'Designer URL', $theme ),
		'section'		=> $section,
		'type'      	=> 'text',
	) );

	$wp_customize->add_setting( 'et_divi_child[designed_by_name]', array(
		'type'			=> $type,
		'capability'	=> $capability,
		'transport'		=> $transport,
	) );

	$wp_customize->add_control( 'et_divi_child[designed_by_name]', array(
		'label'			=> __( 'Designer', $theme ),
		'section'		=> $section,
		'type'      	=> 'text',
	) );

	$wp_customize->add_setting( 'et_divi_child[powered_by]', array(
		'type'			=> $type,
		'capability'	=> $capability,
		'transport'		=> $transport,
	) );

	$wp_customize->add_control( 'et_divi_child[powered_by]', array(
		'label'			=> __( 'Powered By', $theme ),
		'description'	=> __( 'Leave it blank if you do not want to display the "Powered by" part of the footer credits.', $theme ),
		'section'		=> $section,
		'type'      	=> 'text',
	) );

	$wp_customize->add_setting( 'et_divi_child[powered_by_url]', array(
		'type'			=> $type,
		'capability'	=> $capability,
		'transport'		=> $transport,
	) );

	$wp_customize->add_control( 'et_divi_child[powered_by_url]', array(
		'label'			=> __( 'Powered By URL', $theme ),
		'section'		=> $section,
		'type'      	=> 'text',
	) );

	$wp_customize->add_setting( 'et_divi_child[powered_by_name]', array(
		'type'			=> $type,
		'capability'	=> $capability,
		'transport'		=> $transport,
	) );

	$wp_customize->add_control( 'et_divi_child[powered_by_name]', array(
		'label'			=> __( 'Powered By Name', $theme ),
		'section'		=> $section,
		'type'      	=> 'text',
	) );
}
add_action( 'customize_register', 'et_divi_child_register' );

if ( ! function_exists( 'et_divi_child_footer_get_footer_items' ) ) {
	function et_divi_child_footer_get_footer_items() {
		$items = new stdClass;
		
		$options = get_option( 'et_divi_child' );
		
		$items->start_year = $options['start_year'];
		$items->year = date('Y');
		
		$items->site = get_bloginfo( 'name' );

		$items->designed_by = esc_html( $options['designed_by'] );
		$items->designed_by_url = esc_html( $options['designed_by_url'] );
		$items->designed_by_name = esc_html( $options['designed_by_name'] );

		$items->powered_by = esc_html( $options['powered_by'] );
		$items->powered_by_url = esc_html( $options['powered_by_url'] );
		$items->powered_by_name = esc_html( $options['powered_by_name'] );
		
		return $items;
	}
}
