<?php
/**
 * CoCart - System Status.
 *
 * Adds additional related information to the WooCommerce System Status.
 *
 * @since    2.1.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  CoCart/Admin/System Status
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CoCart_Admin_WC_System_Status' ) ) {
	class CoCart_Admin_WC_System_Status {

		/**
		 * Constructor
		 *
		 * @access public
		 */
		public function __construct() {
			add_filter( 'woocommerce_system_status_report', array( $this, 'render_system_status_items' ) );

			add_filter( 'woocommerce_debug_tools', array( $this, 'debug_button' ) );
		} // END __construct()

		/**
		 * Renders the CoCart information in the WC status page.
		 *
		 * @access public
		 * @static
		 */
		public static function render_system_status_items() {
			$data = $this->get_system_status_data();

			$system_status_sections = apply_filters( 'cocart_system_status_sections', array(
				array(
					'title'   => 'CoCart',
					'tooltip' => sprintf( esc_html__( 'This section shows any information about %s.', 'cart-rest-api-for-woocommerce' ), 'CoCart' ),
					'data'    => apply_filters( 'cocart_system_status_data', $data ),
				),
			) );

			foreach ( $system_status_sections as $section ) {
				$section_title   = $section['title'];
				$section_tooltip = $section['tooltip'];
				$debug_data      = $section['data'];

				include( dirname( __FILE__ ) . '/views/html-wc-system-status.php' );
			}
		} // END render_system_status_items()

		/**
		 * Gets the system status data to return.
		 *
		 * @access private
		 * @return array $data
		 */
		private function get_system_status_data() {
			$data = array();

			$data['cocart_version'] = array(
				'name'      => _x( 'Version', 'label that indicates the version of the plugin', 'cart-rest-api-for-woocommerce' ),
				'label'     => esc_html__( 'Version', 'cart-rest-api-for-woocommerce' ),
				'note'      => COCART_VERSION,
				'mark'      => '',
				'mark_icon' => '',
			);

			$data['cocart_db_version'] = array(
				'name'      => _x( 'Database Version', 'label that indicates the database version of the plugin', 'cart-rest-api-for-woocommerce' ),
				'label'     => esc_html__( 'Database Version', 'cart-rest-api-for-woocommerce' ),
				'note'      => get_option( 'cocart_version', null ),
				'tip'       => sprintf( esc_html__( 'The version of %s reported by the database. This should be the same as the version of the plugin.', 'cart-rest-api-for-woocommerce' ), 'CoCart' ),
				'mark'      => '',
				'mark_icon' => '',
			);

			$data['cocart_install_date'] = array(
				'name'      => _x( 'Install Date', 'label that indicates the install date of the plugin', 'cart-rest-api-for-woocommerce' ),
				'label'     => esc_html__( 'Install Date', 'cart-rest-api-for-woocommerce' ),
				'note'      => date( get_option( 'date_format' ), get_site_option( 'cocart_install_date', time() ) ),
				'mark'      => '',
				'mark_icon' => '',
			);

			$data['cocart_carts_in_session'] = array(
				'name'      => _x( 'Carts in Session', 'label that indicates the number of carts in session', 'cart-rest-api-for-woocommerce' ),
				'label'     => esc_html__( 'Carts in Session', 'cart-rest-api-for-woocommerce' ),
				'note'      => $this->carts_in_session(),
				'mark'      => '',
				'mark_icon' => '',
			);

			$data['cocart_carts_expired'] = array(
				'name'      => _x( 'Carts Expired', 'label that indicates the number of carts expired', 'cart-rest-api-for-woocommerce' ),
				'label'     => esc_html__( 'Carts Expired', 'cart-rest-api-for-woocommerce' ),
				'note'      => $this->count_carts_expired(),
				'mark'      => '',
				'mark_icon' => '',
			);

			return $data;
		} // END get_system_status_data()

		/**
		 * Counts how many carts are currently in session.
		 *
		 * @access public
		 * @global $wpdb
		 * @return int - Number of carts in session.
		 */
		public function carts_in_session() {
			global $wpdb;

			$results = $wpdb->get_results( "
				SELECT COUNT(cart_id) as count 
				FROM {$wpdb->prefix}cocart_carts
			", ARRAY_A );

			return $results[0]['count'];
		} // END carts_in_session()

		/**
		 * Counts how many carts have expired.
		 *
		 * @access public
		 * @global $wpdb
		 * @return int - Number of carts expired.
		 */
		public function count_carts_expired() {
			global $wpdb;

			$results = $wpdb->get_results( $wpdb->prepare( "
				SELECT COUNT(cart_id) as count
				FROM {$wpdb->prefix}cocart_carts 
				WHERE cart_expiry < %d", time()
			), ARRAY_A );

			return $results[0]['count'];
		} // END count_carts_expired()

		/**
		 * Adds debug buttons under the tools section of WooCommerce System Status.
		 *
		 * @access public
		 * @param  array $tools - All tools before adding ours.
		 * @return array $tools - All tools after adding ours.
		 */
		public function debug_button( $tools ) {
			$tools['cocart_clear_carts'] = array(
				'name'   => esc_html__( 'Clear cart sessions', 'cart-rest-api-for-woocommerce' ),
				'button' => esc_html__( 'Clear all', 'cart-rest-api-for-woocommerce' ),
				'desc'   => sprintf(
					'<strong class="red">%1$s</strong> %2$s',
					esc_html__( 'Note:', 'cart-rest-api-for-woocommerce' ),
					sprintf( 
						esc_html__( 'This will clear all carts stored in the database for %s including registered customers if enabled.', 'cart-rest-api-for-woocommerce' ),
						'<strong>' . esc_html__( 'guest customers', 'cart-rest-api-for-woocommerce' ) . '</strong>'
					)
				),
				'callback' => array( $this, 'debug_clear_carts' ),
			);

			$tools['cocart_cleanup_carts'] = array(
				'name'   => esc_html__( 'Clear expired carts', 'cart-rest-api-for-woocommerce' ),
				'button' => esc_html__( 'Clear expired', 'cart-rest-api-for-woocommerce' ),
				'desc'   => sprintf(
					'<strong class="red">%1$s</strong> %2$s',
					esc_html__( 'Note:', 'cart-rest-api-for-woocommerce' ),
					sprintf(
						esc_html__( 'This will clear all expired carts %s stored in the database.', 'cart-rest-api-for-woocommerce' ),
						'<strong>' . esc_html__( 'only', 'cart-rest-api-for-woocommerce' ) . '</strong>'
					)
				),
				'callback' => array( $this, 'debug_clear_expired_carts' ),
			);

			return $tools;
		} // END debug_button

		/**
		 * Runs the debug callback for clearing all carts.
		 *
		 * @access public
		 */
		public function debug_clear_carts() {
			CoCart_API_Session::clear_carts();

			echo '<div class="updated inline"><p>' . esc_html__( 'All carts in session have now been cleared from the database.', 'cart-rest-api-for-woocommerce' ) . '</p></div>';
		} // END debug_clear_carts()

		/**
		 * Runs the debug callback for clearing expired carts ONLY.
		 *
		 * @access public
		 */
		public function debug_clear_expired_carts() {
			CoCart_API_Session::cleanup_carts();

			echo '<div class="updated inline"><p>' . esc_html__( 'All expired carts have now been cleared from the database.', 'cart-rest-api-for-woocommerce' ) . '</p></div>';
		} // END debug_clear_expired_carts()

	} // END class

} // END if class

return new CoCart_Admin_WC_System_Status();