<?php

/**
 * Class Landing_Pages_Meta Array placeholder to eventually hold all landing page data
 */
class Landing_Pages_Meta {

	/**
	*  Gets email settings
	*  @param INT $email_id
	*  @return ARRAY $landing_page_settings
	*/
	public static function get_settings( $landing_pages_id ) {

		$landing_page_settings = maybe_unserialize(get_post_meta( $landing_pages_id , 'inbound_settings' , true ));

		if (!$landing_page_settings) {
			$landing_page_settings = array();
		}


		return $landing_page_settings;
	}

	/**
	*  Updates inbound_settings post meta
	*  @param INT $landing_pages_id
	*  @param ARRAY $settings
	*/
	public static function update_settings( $landing_pages_id , $settings ) {

		/* Save settings array */
		update_post_meta( $landing_pages_id , 'inbound_settings' , $settings );
	}

}