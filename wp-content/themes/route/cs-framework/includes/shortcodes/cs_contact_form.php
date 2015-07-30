<?php
/**
 *
 * CS Contact Form 7
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cs_contact_form' ) ) {
  function cs_contact_form( $atts ){
    return do_shortcode( '[contact-form-7 id="'. $atts['id'] .'"]' );
  }
  add_shortcode('cs_contact_form', 'cs_contact_form');
}