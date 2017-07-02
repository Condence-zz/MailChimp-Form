<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'MailChimp_Form_API' ) ) {
	class MailChimp_Form_API {
		public function __construct() {
			if (is_admin()) {
				 
			} 
		}
		public function MailChimp_Connect( $url, $request_type, $api_key, $data = array() ) {
			if( $request_type == 'GET' )
				$url .= '?' . http_build_query($data);
		 
			$mch = curl_init();
			$headers = array(
				'Content-Type: application/json',
				'Authorization: Basic '.base64_encode( 'user:'. $api_key )
			);
			curl_setopt($mch, CURLOPT_URL, $url );
			curl_setopt($mch, CURLOPT_HTTPHEADER, $headers); 
			curl_setopt($mch, CURLOPT_RETURNTRANSFER, true);  
			curl_setopt($mch, CURLOPT_CUSTOMREQUEST, $request_type);  
			curl_setopt($mch, CURLOPT_TIMEOUT, 10);
			curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false); 
			if( $request_type != 'GET' ) {
				curl_setopt($mch, CURLOPT_POST, true);
				curl_setopt($mch, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
			} 
			return curl_exec($mch);
		}
		public static function get_theme_options() {
			return get_option( 'theme_options' );
		} 
		public static function get_theme_option( $id ) {
			$options = self::get_theme_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}
		public function get_form($result){  
			if( !empty($result->lists) ) {
				$value = self::get_theme_option( 'select_example' ); 
				echo '<select name="theme_options[select_example]">';
				foreach( $result->lists as $list ){
					echo '<option value="' . $list->id . '"'. selected($value,$list->id,true).'>'.$list->name.'  (' . $list->stats->member_count . ')</option>';  
				}
				echo '</select>';
			}  
		}
	}
}