<?php
/**
 * Main functions for the plugin
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the parameters for ordering that we'll include in our select field
 * 
 * @since 1.0.0
 * @return Array
 */
function sp_edd_orderby_params() {
	$params = array(
		'newness_asc'	=> array(
			'id'		=> 'newness_asc',						// Unique ID
			'title'		=> __( 'Newest first', 'sp-for-edd' ),	// Text to display in select option
			'orderby'	=> 'post_date',							// Orderby parameter, must be legit WP_Query orderby param
			'order'		=> 'DESC'								// Either ASC or DESC
		),
		'newness_desc'	=> array(
			'id'		=> 'newness_desc',
			'title'		=> __( 'Oldest first', 'sp-for-edd' ),
			'orderby'	=> 'post_date',
			'order'		=> 'ASC'
		),
		'price_asc'	=> array(
			'id'		=> 'price_asc',
			'title'		=> __( 'Price (Lowest to Highest)', 'sp-for-edd' ),
			'orderby'	=> 'meta_value_num',
			'order'		=> 'ASC'
		),
		'price_desc'	=> array(
			'id'		=> 'price_desc',
			'title'		=> __( 'Price (Highest to Lowest)', 'sp-for-edd' ),
			'orderby'	=> 'meta_value_num',
			'order'		=> 'DESC'
		),
		'title_asc'	=> array(
			'id'		=> 'title_asc',
			'title'		=> __( 'Title (A - Z)', 'sp-for-edd' ),
			'orderby'	=> 'title',
			'order'		=> 'ASC'
		),
		'title_desc'	=> array(
			'id'		=> 'title_desc',
			'title'		=> __( 'Title (Z - A)', 'sp-for-edd' ),
			'orderby'	=> 'title',
			'order'		=> 'DESC'
		)
	);
	$params = apply_filters( 'sp_edd_filter_orderby_params', $params );
	return $params;
}

/**
 * Filter the [downloads] query
 * 
 * @since 1.0.0
 * @param $query	The query to filter
 * @param $atts		The shortcode atts
 */
function sp_edd_filter_query( $query, $atts ) {
	
	// We're going to modify the order and orderby parameters depending on variables contained in the URL
	if( isset( $_GET['sp_orderby'] ) ) {
		
		// If a orderby option has been set, get the array of parameters
		$params = sp_edd_orderby_params();
		$orderby = $_GET['sp_orderby'];

		// Check the parameter that we've chosen exists
		if( isset( $params[$orderby] ) ) {
			$param = $params[$orderby];
			// Set the query parameters according to our selection
			$query['orderby'] = esc_attr( $param['orderby'] );
			$query['order'] = esc_attr( $param['order'] );
			if( strpos( $param['id'], 'price' ) !== false ) {
				// Specify meta key if we're querying by price
				$query['meta_key'] = 'edd_price';
			}
		}
	}
	
	// Return the query, with thanks
	return $query;
}
add_filter( 'edd_downloads_query', 'sp_edd_filter_query', 10, 2 );

/**
 * Filter the [downloads] shortcode to add dropdown field
 *
 * @since 1.0.0
 * @param $display	The markup to print
 */
function sp_edd_add_dropdown( $display ) {
	
	$orderby = '';
	// Get the current parameter
	if( isset( $_GET['sp_orderby'] ) ) {
		$orderby = $_GET['sp_orderby'];
	}
	
	// Get the array of parameters
	$params = sp_edd_orderby_params();
	$select = '';
	if( ! empty( $params ) ) {
		// Build the select field
		$select = '<form class="sp-edd-sorting">';
			$select .= '<select class="sp-orderby" name="sp_orderby">';
			// Iterate through each parameter to add options to the select field
			foreach( $params as $param ) {
				$select .= '<option value="' . $param['id'] . '" ' . selected( $param['id'], $orderby, false ) . '>' . $param['title'] . '</option>';
			}
			$select .= '</select>';
		$select .= '</form>';
		// Add a script to submit the form when a new selection is made
		$select .= '<script>
			jQuery(document).ready(function($) {
				$(".sp-orderby").change( function(){
					$(this).closest("form").submit();
				});
			});
		</script>';
		
		// Add the select field to the top of the downloads grid
		$display = $select . $display;
	}
	
	return $display;
	
}
add_filter( 'downloads_shortcode', 'sp_edd_add_dropdown', 10, 1 );

/**
 * Add some basic styles to the header
 * Enqueuing a whole stylesheet seemed like overkill
 *
 * @since 1.0.0
 */
function sp_edd_add_styles() {
	
	$styles = ".sp-orderby { margin: 1em 0 2em; float: right; }\n";
	$styles .= ".sp-edd-sorting:after { content:\"\"; display: table; clear: both; }";
	$styles = apply_filters( 'sp_edd_filter_styles', $styles );
	// Build the styles
	if( ! empty( $styles ) ) {
		$css = '<style type="text/css">';
		$css .= $styles;
		$css .= '</style>';
		echo $css;
	}
}
add_action( 'wp_head', 'sp_edd_add_styles' );