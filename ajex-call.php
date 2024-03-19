<?php 

/*
 * Plugin Name:       Ajex call
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       With the plugin can enhance your post engagement and user can reach your more posts ..
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Muhammad Aniab
 * Author URI:        http://muhammadaniab.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-assignment-plugin
 * Domain Path:       /languages
 */

 class ac_ajex_call{
	public function __construct(){
		add_action("init", array($this,"init"));
	}

	public function init(  ) {
		add_action("wp_enqueue_scripts", array($this,"load_assets"));
		add_action("wp_ajax_form", array($this,"form"));
	}

	public function form(){

		check_ajax_referer("form");

		$email= $_POST['gemail'];
		$message= $_POST['message'];
		$response=wp_remote_get("https://xkcd.com/613/info.0.json");
		$body= wp_remote_retrieve_body($response);
		return wp_send_json($body);
	}

	public function load_assets(){
		$cssuri=plugin_dir_url(__FILE__);
		$mainjsuri= plugin_dir_url(__FILE__);
		$ajexuri= admin_url("admin-ajax.php");
		$nonce= wp_create_nonce("form");

		if(is_page('ajax')){
			wp_enqueue_style("handle_css",  $cssuri."css/style.css",[],'1.0');
			wp_enqueue_script( 'handle_js', $mainjsuri.'js/main.js', ['jquery'],'1.0', true);
			wp_localize_script('handle_js', 'admin_ajex',[
				'admin_url'=> $ajexuri,
				'nonce' => $nonce,
				]);

		}
	}
 }

 new ac_ajex_call();