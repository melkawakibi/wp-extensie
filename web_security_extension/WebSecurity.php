<?php

class WebSecurity
{

	function __construct()
	{
		add_action('admin_menu', array($this, 'ws_add_menu'));
		add_action( 'admin_enqueue_scripts', array($this, 'ws_load_css') );
	}

	function ws_add_menu()
	{
		
		add_menu_page(
			'Web Application Scanner', 
			'Web App Scanner', 
			'manage_options', 
			'Web_App_Scanner_menu',
			array(__CLASS__,'ws_page_render')
			);
	}

	function ws_page_render()
	{
		require_once WSS_EXTESION_DIR . '/includes/views/request_form.php';
	}

	function ws_load_css() 
	{
 	    wp_register_style( 'ws_css', plugin_dir_url( __FILE__ ) . '/includes/resources/css/ws-style.css');
 	    wp_enqueue_style( 'ws_css' );
	}
}

new WebSecurity();