<?php
/**
 *
 * CSFramework Shortcodes API
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Shortcodes_API extends CSFramework_Abstract{

  public $args = array();
  public $shortcodes = array();

  public function __construct( $args = array() ) {

    $this->args = apply_filters( 'csframework_shortcodes', $args );
    $this->shortcodes = $this->get_shortcodes();

    $this->addAction( 'media_buttons', 'media_shortcode_button', 99 );
    $this->addAction( 'admin_footer', 'shortcode_dialog', 99 );
    $this->addAction( 'wp_ajax_get-shortcode',  'shortcode_generator', 99 );

  }

  /**
   *
   * Quick Shortcode Button
   * @since 1.0.0
   * @version 1.0.0
   *
   */
  public function media_shortcode_button( $editor_id = 'content' ) {
    echo '<a href="#" onmousedown="return false;" class="button button-primary shortcode-button" data-editor="' . esc_attr( $editor_id ) . '"><span class="dashicons dashicons-menu"></span> Quick Shortcode</a>';
  }

  /**
   *
   * Shortcode dialog
   * @since 1.0.0
   * @version 1.0.0
   *
   */
  public function shortcode_dialog() {
  ?>
    <div id="shortcode-dialog" title="Shortcode Manager">
      <div id="dialog-header-wrap">
        <select id="shortcode-select" class="chosen<?php echo is_rtl()?' chosen-rtl':''; ?>" data-placeholder="Select a shortcode">
          <option value=""></option>
          <?php
          foreach ( $this->args as $group_key => $group_value ) {
            echo '<optgroup label="'. $group_value['title'] .'">';
            foreach ( $group_value['shortcodes'] as $id => $shortcode ) {
              $view_as = ( isset( $shortcode['view'] ) ) ? ' data-view="'. $shortcode['view'] .'"' : ' data-view="normal"';
              echo '<option value="'. $id .'"'. $view_as .'>'. $shortcode['title'] .'</option>';
            }
            echo '</optgroup>';
          }
          ?>
        </select>
      </div>
      <div id="dialog-shadow-up"></div>
      <div id="shortcode-load"></div>
      <div id="dialog-insert-button" class="hidden">
        <div id="dialog-shadow-down"></div>
        <a href="#" id="shortcode-insert" class="button button-primary button-large">Insert Shortcode</a>
      </div>
    </div>
    <div id="icon-overlay"></div>
  <?php
  }

  /**
   *
   * Shortcode generator function for dialog
   * @since 1.0.0
   * @version 1.0.0
   *
   */
  public function shortcode_generator() {

    if( ! isset( $_REQUEST['shortcode'] ) ) { die(); }

    $request = $_REQUEST['shortcode'];
    $shortcode = $this->shortcodes[$request];
    $shortcode_atts = $shortcode['shortcode_atts'];

    foreach ( $shortcode_atts as $key => $field ) {
      $field['attributes'] = ( isset( $field['attributes'] ) ) ? wp_parse_args( array( 'data-atts' => $field['id'] ), $field['attributes'] ) : array( 'data-atts' => $field['id'] );
      $field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';
      $this->addElement( $field, $field_default, 'shortcode' );
    }

    if( isset( $shortcode['multiple_atts'] ) && isset( $shortcode['clone_id'] ) ) {

      $clone_id = $shortcode['clone_id'];

      echo '<div class="shortcode-clone" data-clone-id="'. $clone_id .'">';
      echo '<a href="#" class="remove-clone"><span class="dashicons dashicons-trash"></span></a>';

      $multiple_atts = $shortcode['multiple_atts'];

      foreach ( $multiple_atts as $key => $field ) {
        $field['sub'] = true;
        $field['attributes'] = ( isset( $field['attributes'] ) ) ? wp_parse_args( array( 'data-clone-atts' => $field['id'] ), $field['attributes'] ) : array( 'data-clone-atts' => $field['id'] );
        $field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';
        $this->addElement( $field, $field_default, 'shortcode' );
      }

      echo '</div>';

      echo '<p style="text-align:center;"><a id="shortcode-clone" class="button" href="javascript:void(0);">'.$shortcode['clone_title'].'</a></p>';

    }

    die();
  }

  /**
   *
   * Getting shortcodes from config array
   * @since 1.0.0
   * @version 1.0.0
   *
   */
  public function get_shortcodes() {

    $shortcodes = array();

    foreach ( $this->args as $group_key => $group_value ) {
      foreach ( $group_value['shortcodes'] as $id => $shortcode ) {
        $shortcodes[$id] = $shortcode;
      }
    }

    return $shortcodes;
  }

}