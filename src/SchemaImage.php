<?php
namespace MetaBox\TermImage;

class SchemaImage extends \Yoast\WP\SEO\Generators\Schema\Main_Image {
	public function is_needed() {
		return is_category();
	}

	public function generate() {
		$image_id = $this->context->canonical . \Yoast\WP\SEO\Config\Schema_IDs::PRIMARY_IMAGE_HASH;

		$image = rwmb_meta( 'image', ['object_type' => 'term'], get_queried_object_id() );
		if ( empty( $image ) ) {
			return false;
		}

		$id = $image['ID'];
		return $this->helpers->schema->image->generate_from_attachment_id( $image_id, $id );
	}
}
