<?php
/**
 * Plugin Name: MB Term Image
 * Plugin URI:  https://metabox.io
 * Description: Add image to terms.
 * Version:     0.0.1
 * Author:      MetaBox.io
 * Author URI:  https://metabox.io
 * License:     GPL2+
 */

add_filter( 'wpseo_schema_graph_pieces', function( $schema_pieces, $context ) {
	require __DIR__ . '/src/SchemaImage.php';

	$schema_pieces[] = new MetaBox\TermImage\SchemaImage;
	return $schema_pieces;
}, 10, 2 );

add_filter( 'wpseo_schema_webpage', function ( $data, $context ) {
	if ( ! is_category() ) {
		return $data;
	}

	$data['primaryImageOfPage'] = [ '@id' => $context->canonical . \Yoast\WP\SEO\Config\Schema_IDs::PRIMARY_IMAGE_HASH ];

	return $data;
}, 10, 2 );

// TODO:
/**
 * - Xử lý og:image
 * - Làm trang settings để chọn các taxonomy nào để thêm ảnh
 * - Register field cho term bằng code, ko phải bằng Builder
 * - Show ảnh ở cột trong admin
 * - Tích hợp với các plugin khác ngoài Yoast SEO
 */