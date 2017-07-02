<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 
if ( ! class_exists( 'MailChimp_Panel' ) ) { 
	class MailChimp_Panel { 
		public function __construct() {
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'MailChimp_Panel', 'add_admin_menu' ) ); 
				add_action( 'init', array( 'MailChimp_Panel', 'scripts' ) );
			} 
		}
		public static function add_admin_menu(){
			add_menu_page(
				'MailChimp Form' ,
				'MailChimp' ,
				'manage_options' , 
				'MailChimp' ,
				array( 'MailChimp_Panel', 'MailChimp_Panel_Content' ) 
			); 
		}
		public function scripts(){
			wp_enqueue_style (
	            'mailchimp-form-admin',
	            MCF_PLUGIN . '/assets/css/admin.css',
	            array(),
	            '1.0.0',
	            'all'
	        );
		}
		public function MailChimp_Panel_Content(){
			if (is_admin()) {
				$tabs = array( 
					'About' => __('About', 'MailChimp-Form'), 
					'Configuracion' => __('Configuración', 'MailChimp-Form') 
				);
				?>
				<div class="wrap">
					<h2>MailChimp Form</h2>
					<h2 class="nav-tab-wrapper">
					<?php 
					foreach( $tabs as $tab => $name ){
						$class = ( $tab == $_GET['tab'] ) ? ' nav-tab-active' : ''; 
						echo "<a class='nav-tab$class' href='?page=MailChimp&tab=$tab'>$name</a>"; 
					}
					?>
					</h2> 
				</div>
				<?php
			} 
		} 
	}
}
new MailChimp_Panel(); 