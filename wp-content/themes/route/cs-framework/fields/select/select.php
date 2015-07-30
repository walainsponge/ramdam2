<?php
/**
 *
 * Field: Select
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_select extends CSFramework_Options_API {

  public function __construct( $field = array(), $value = '', $unique = '' ) {
    $this->field    = $field;
    $this->value    = $value;
    $this->unique   = $unique;
  }

  public function output() {

    echo $this->element_before();

    if( isset( $this->field['options'] ) ) {
      
      $options    = $this->field['options'];
      $options    = ( is_array( $options ) ) ? $options : $this->element_data( $options );
      $extra_name = ( isset( $this->field['attributes']['multiple'] ) ) ? '[]' : '' ;

      echo '<select name="'. $this->element_name( $extra_name ) .'"'. $this->element_class() . $this->element_attributes() .'>';

      echo ( isset( $this->field['default_option'] ) ) ? '<option value="">'.$this->field['default_option'].'</option>' : '';

      if( !empty( $options ) ){
        foreach ( $options as $key => $value ) {
          echo '<option value="'. $key .'" '. $this->checked( $this->value, $key, 'selected' ).'>'. $value .'</option>';
        }
      }

      echo '</select>';

    }

    echo $this->element_after();

  }

}