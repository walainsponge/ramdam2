<?php
/**
 *
 * Field: Upload
 * @version 1.0.0
 * @since 1.0.0
 *
 */
class CSFramework_Option_upload extends CSFramework_Options_API {

  public function __construct( $field = array(), $value = '', $unique = '' ) {
    $this->field    = $field;
    $this->value    = $value;
    $this->unique   = $unique;
  }

  public function output() {

    echo $this->element_before();
    $return_as = ( isset( $this->field['return_id'] ) ) ? 'id' : 'url';

    if( isset( $this->field['settings'] ) ) {
      extract( $this->field['settings'] );
    }

    $upload_type        = ( isset( $upload_type  ) ) ? $upload_type  : 'image';
    $button_title       = ( isset( $button_title ) ) ? $button_title : 'Upload';
    $frame_title        = ( isset( $frame_title  ) ) ? $frame_title  : 'Upload';
    $insert_title       = ( isset( $insert_title ) ) ? $insert_title : 'Use Image';
    $input_as           = ( isset( $this->field['preview'] ) ) ? 'hidden' : 'text';
    $media_detailed     = ( isset( $this->field['detailed'] ) ) ? '[attachment]' : '';
    $element_value      = ( isset( $this->field['detailed'] ) ) ? $this->value['attachment'] : $this->value;
    $remove_media_class = ( empty( $element_value ) ) ? ' hidden' : '';

    echo '<div class="cs-uploader">';

    echo '<input type="'. $input_as .'" name="'. $this->element_name( $media_detailed ) .'" value="'. $element_value .'"'. $this->element_class('media-attachment') . $this->element_attributes() .'/>';

    if( isset( $this->field['detailed'] ) ) {
      echo '<input type="hidden" name="'. $this->element_name( '[details]' ) .'" value="'. $this->value['details'] .'" class="media-details"/>';
    }

    if( isset( $this->field['preview'] ) ) {

      echo '<div class="cs-upload-preview">';

      if( ! empty( $element_value ) ) {

        if( is_numeric( $element_value ) ) {
          echo '<a href="'. wp_get_attachment_url( $element_value ) .'" target="_blank">'. wp_get_attachment_image( $element_value, 'thumbnail' ) .'</a>';
        } else {
          echo '<a href="'. $element_value .'" target="_blank"><img src="'. $element_value .'" alt="'. $this->field['id'] .'" /></a>';
        }

      }

      echo '</div>';

    }

    echo '<a href="#" class="button cs-add-media" data-frame-title="'. $frame_title .'" data-upload-type="'. $upload_type .'" data-return="'. $return_as .'" data-insert-title="'. $insert_title .'">'. $button_title .'</a>';
    echo '&nbsp;';

    if( isset( $this->field['preview'] ) ){
      echo '<a href="#" class="button cs-button-remove'. $remove_media_class .'"> Remove </a>';
    }
    
    echo '</div>';

    echo $this->element_after();

  }
}