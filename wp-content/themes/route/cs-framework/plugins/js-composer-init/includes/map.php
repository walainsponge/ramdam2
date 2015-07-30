<?php
/**
  * WPBakery Visual Composer Shortcodes settings
  *
  * @package VPBakeryVisualComposer
  *
 */

// Include Helpers
include_once( FRAMEWORK_PLUGIN_DIR . '/js-composer-init/includes/helpers.php' );
include_once( FRAMEWORK_PLUGIN_DIR . '/js-composer-init/includes/params.php' );
include_once( FRAMEWORK_PLUGIN_DIR . '/js-composer-init/includes/extends.php' );
include_once( FRAMEWORK_PLUGIN_DIR . '/js-composer-init/includes/templates.php' );

if ( ! function_exists( 'is_plugin_active' ) ) {
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
}

// VC Exclude
// ------------------------------------------------------------------------------------------
$vc_exclude = cs_get_option( 'vc_exclude_shortcodes' );
$vc_exclude = ( is_array( $vc_exclude ) ) ? $vc_exclude : array();

// Animation
// ------------------------------------------------------------------------------------------
$column_width_list = array(
  '1 column - 1/12'     => '1/12',
  '2 columns - 1/6'     => '1/6',
  '3 columns - 1/4'     => '1/4',
  '4 columns - 1/3'     => '1/3',
  '5 columns - 5/12'    => '5/12',
  '6 columns - 1/2'     => '1/2',
  '7 columns - 7/12'    => '7/12',
  '8 columns - 2/3'     => '2/3',
  '9 columns - 3/4'     => '3/4',
  '10 columns - 5/6'    => '5/6',
  '11 columns - 11/12'  => '11/12',
  '12 columns - 1/1'    => '1/1'
);

// Animation
// ------------------------------------------------------------------------------------------
$vc_map_animation = array(
  'type'        => 'dropdown',
  'heading'     => 'Animation',
  'param_name'  => 'animation',
  'admin_label' => true,
  'value'       => cs_get_animations(),
);

$vc_map_animation_delay = array(
  'type'               => 'vc_cs_textfield',
  'heading'            => 'Animation Delay',
  'param_name'         => 'animation_delay',
  'edit_field_class'   => 'vc_col-md-6 vc_column',
  'placeholder'        => 0.1,
  'dependency'         => array( 'element' => 'animation', 'not_empty' => true )
);

$vc_map_animation_duration = array(
  'type'               => 'vc_cs_textfield',
  'heading'            => 'Animation Duration',
  'param_name'         => 'animation_duration',
  'edit_field_class'   => 'vc_col-md-6 vc_column',
  'placeholder'        => 0.7,
  'dependency'         => array( 'element' => 'animation', 'not_empty' => true )
);

$vc_params_button_size = array(
  'XX Small'  => 'xxs',
  'X Small'   => 'xs',
  'Small'     => 'sm',
  'Medium'    => 'md',
  'Large'     => 'lg',
  'X Large'   => 'xl',
  'XX Large'  => 'xxl',
);

$vc_params_button_shape = array(
  'Square'    => 'square',
  'Rounded'   => 'rounded',
  'Pill'      => 'pill',
  'Circle'    => 'circle',
);

$vc_params_button_type = array(
  'Flat'        => 'flat',
  'Outlined'    => 'outlined',
  '3D'          => '3d',
);

$vc_params_button_align = array(
  'Select align'  => '',
  'Left'          => 'left',
  'Center'        => 'center',
  'Right'         => 'right',
);


// Extras
// ------------------------------------------------------------------------------------------
$vc_map_id = array(
  'type'        => 'textfield',
  'heading'     => 'Extra ID',
  'param_name'  => 'id'
);

$vc_map_class = array(
  'type'        => 'textfield',
  'heading'     => 'Extra Class',
  'param_name'  => 'class'
);

$vc_map_style = array(
  'type'        => 'vc_cs_style_textarea',
  'heading'     => 'Extra Inline Style',
  'param_name'  => 'in_style'
);


// Extras
// ------------------------------------------------------------------------------------------
$vc_map_extra_id = array(
  'type'        => 'textfield',
  'heading'     => 'Extra ID',
  'param_name'  => 'id',
  'group'       => 'Extras'
);

$vc_map_extra_class = array(
  'type'        => 'textfield',
  'heading'     => 'Extra Class',
  'param_name'  => 'class',
  'group'       => 'Extras'
);

$vc_map_extra_style = array(
  'type'        => 'vc_cs_style_textarea',
  'heading'     => 'Extra Inline Style',
  'param_name'  => 'in_style',
  'group'       => 'Extras'
);


// Extras
// ------------------------------------------------------------------------------------------
$vc_map_defaults        = array( $vc_map_id, $vc_map_class, $vc_map_style );
$vc_map_extra_defaults  = array( $vc_map_extra_id, $vc_map_extra_class, $vc_map_extra_style );


if( ! in_array( 'vc_row', $vc_exclude ) ) {
  // ==========================================================================================
  // VC ROW
  // ==========================================================================================
  vc_map( array(
    'name'                      => 'Row',
    'base'                      => 'vc_row',
    'icon'                      => 'fa fa-plus-square-o',
    'is_container'              => true,
    'description'               => 'Place content elements inside the section',
    'category'                  => 'Route Theme',
    'params'                    => array(

      // Background
      // ------------------------------------------------------------------------------------------
      array(
        'type'                  => 'vc_cs_color_picker',
        'heading'               => 'Background Color',
        'param_name'            => 'bgcolor',
      ),
      array(
        'type'                  => 'vc_cs_color_picker',
        'heading'               => 'Text Color',
        'param_name'            => 'text_color',
      ),
      array(
        'type'                  => 'vc_cs_upload',
        'heading'               => 'Background Image',
        'param_name'            => 'background',
      ),
      array(
        'type'                  => 'dropdown',
        'param_name'            => 'repeat',
        'heading'               => 'Background Repeat',
        'edit_field_class'      => 'vc_col-md-4 vc_column',
        'value'                 => array(
          'Repeat'              => '',
          'Repeat Horizontally' => 'repeat-x',
          'Repeat Vertically'   => 'repeat-y',
          'No Repeat'           => 'no-repeat',
        ),
        'dependency'            => array( 'element' => 'background', 'not_empty' => true ),
      ),
      array(
        'type'                  => 'dropdown',
        'param_name'            => 'position',
        'heading'               => 'Background Position',
        'edit_field_class'      => 'vc_col-md-4 vc_column',
        'value'                 => array(
          'Left Top'            => '',
          'Left Center'         => '0% 50%',
          'Left Bottom'         => '0% 100%',
          'Right Top'           => '100% 0%',
          'Right Center'        => '100% 50%',
          'Right Bottom'        => '100% 100%',
          'Center Top'          => '50% 0%',
          'Center Center'       => '50% 50%',
          'Center Bottom'       => '50% 100%',
          'Custom'              => 'custom'
        ),
        'dependency'            => array( 'element' => 'background', 'not_empty' => true ),
      ),
      array(
        'type'                  => 'dropdown',
        'param_name'            => 'attachment',
        'heading'               => 'Background Attachment',
        'edit_field_class'      => 'vc_col-md-4 vc_column',
        'value'                 => array(
          'Scroll'              => '',
          'Fixed'               => 'fixed',
        ),
        'dependency'            => array( 'element' => 'background', 'not_empty' => true ),
      ),
      array(
        'type'                  => 'vc_cs_textfield',
        'heading'               => 'Custom Background Position',
        'param_name'            => 'custom_bg_position',
        'placeholder'           => 'Eg. 50px 50px or 50% 100px or center -50px',
        'dependency'            => array( 'element' => 'position', 'value' => array('custom') ),
      ),

      // Parallax
      // ------------------------------------------------------------------------------------------
      array(
        'type'                  => 'vc_cs_on_off',
        'heading'               => 'Parallax',
        'param_name'            => 'parallax',
        'dependency'            => array( 'element' => 'background', 'not_empty' => true ),
      ),
      array(
        'type'                  => 'vc_cs_textfield',
        'heading'               => 'Parallax SpeedFactor',
        'param_name'            => 'speed',
        'placeholder'           => 0.4,
        'dependency'            => array( 'element' => 'parallax', 'not_empty' => true ),
      ),

      // Utilities
      // ------------------------------------------------------------------------------------------
      array(
        'type'                  => 'vc_cs_on_off',
        'heading'               => 'Background Stretch',
        'param_name'            => 'cover',
        'description'           => 'Settings with ON option will stretch the background image full as with container',
        'dependency'            => array( 'element' => 'background', 'not_empty' => true ),
      ),

      // Overlay
      // ------------------------------------------------------------------------------------------
      array(
        'type'                  => 'vc_cs_on_off',
        'heading'               => 'Overlay',
        'param_name'            => 'overlay',
      ),
      array(
        'type'                  => 'vc_cs_color_picker',
        'heading'               => 'Overlay Color',
        'param_name'            => 'overlay_color',
        'description'           => 'default is #000 (black)',
        'dependency'            => array( 'element' => 'overlay', 'not_empty' => true ),
      ),
      array(
        'type'                  => 'vc_cs_textfield',
        'heading'               => 'Overlay Opacity',
        'param_name'            => 'overlay_opacity',
        'placeholder'           => 0.5,
        'dependency'            => array( 'element' => 'overlay', 'not_empty' => true ),
      ),
      array(
        'type'                  => 'vc_cs_on_off',
        'heading'               => '100% Full-width, without container',
        'param_name'            => 'fluid',
      ),
      array(
        'type'                  => 'vc_cs_on_off',
        'heading'               => 'Inner Shadow',
        'param_name'            => 'shadow',
      ),
      array(
        'type'                  => 'dropdown',
        'param_name'            => 'padding',
        'heading'               => 'Padding',
        'value'                 => array(
          'Extra Small Padding' => 'xs-padding',
          'Small Padding'       => 'sm-padding',
          'Medium Padding'      => 'md-padding',
          'Large Padding'       => 'lg-padding',
          'Extra Large Padding' => 'xl-padding',
          'No Padding'          => 'no-padding',
          'Custom Padding'      => 'custom-padding',
        ),
        'std'                   => 'md-padding',
      ),
      array(
        'type'                  => 'vc_cs_textfield',
        'heading'               => 'Padding Top',
        'param_name'            => 'top',
        'placeholder'           => '50px',
        'dependency'            => array( 'element' => 'padding', 'value' => array('custom-padding') ),
      ),
      array(
        'type'                  => 'vc_cs_textfield',
        'heading'               => 'Padding Bottom',
        'param_name'            => 'bottom',
        'placeholder'           => '50px',
        'dependency'            => array( 'element' => 'padding', 'value' => array('custom-padding') ),
      ),

      // Video Background
      // ------------------------------------------------------------------------------------------
      array(
        'type'                  => 'vc_cs_upload',
        'heading'               => 'video/mp4',
        'param_name'            => 'mp4',
        'settings'              => array(
          'upload_type'         => 'video',
          'insert_title'        => 'Use This Video',
          'button_title'        => 'Upload / MP4',
        ),
        'group'                 => 'Video Background',
      ),
      array(
        'type'                  => 'vc_cs_upload',
        'heading'               => 'video/ogv',
        'param_name'            => 'ogv',
        'settings'              => array(
          'upload_type'         => 'video',
          'insert_title'        => 'Use This Video',
          'button_title'        => 'Upload / OGV',
        ),
        'group'                 => 'Video Background',
      ),
      array(
        'type'                  => 'vc_cs_upload',
        'heading'               => 'video/webm',
        'param_name'            => 'webm',
        'settings'              => array(
          'upload_type'         => 'video',
          'insert_title'        => 'Use This Video',
          'button_title'        => 'Upload / WEBM',
        ),
        'group'                 => 'Video Background',
      ),
      array(
        'type'                  => 'vc_cs_on_off',
        'heading'               => 'Loop',
        'param_name'            => 'loop',
        'group'                 => 'Video Background',
      ),
      array(
        'type'                  => 'vc_cs_on_off',
        'heading'               => 'Muted',
        'param_name'            => 'muted',
        'group'                 => 'Video Background',
      ),
      array(
        'type'                  => 'vc_cs_content',
        'param_name'            => 'notice-poster',
        'content'               => '<p class="cs-alert cs-alert-info">About Poster Image, you can use background image</p>',
        'group'                 => 'Video Background'
      ),

      // Extras
      // ------------------------------------------------------------------------------------------
      $vc_map_extra_id,
      $vc_map_extra_class,
      $vc_map_extra_style,

    ),
    'js_view'                   => 'VcRowView'
  ) );

  // ==========================================================================================
  // VC ROW INNER
  // ==========================================================================================
  vc_map( array(
    'name'                    => 'Row',
    'base'                    => 'vc_row_inner',
    'icon'                    => 'fa fa-plus-square-o',
    'is_container'            => true,
    'content_element'         => false,
    'show_settings_on_create' => false,
    'weight'                  => 1000,
    'category'                => 'Route Theme',
    'params'                  => $vc_map_defaults,
    'js_view'                 => 'VcRowView'
  ) );

}

if( ! in_array( 'vc_column', $vc_exclude ) ) {

  // ==========================================================================================
  // VC COLUMN
  // ==========================================================================================
  vc_map( array(
    'name'            => 'Column',
    'base'            => 'vc_column',
    'is_container'    => true,
    'content_element' => false,
    'category'        => 'Route Theme',
    'params'          => array(
      $vc_map_animation,
      $vc_map_animation_delay,
      $vc_map_animation_duration,
      $vc_map_id,
      $vc_map_class,
      $vc_map_style,

      // Responsiveness
      array(
        'type'        => 'dropdown',
        'heading'     => 'Width',
        'param_name'  => 'width',
        'value'       => $column_width_list,
        'group'       => 'Width & Responsiveness',
        'description' => 'Select column width.',
        'std'         => '1/1'
      ),
      array(
        'type'        => 'column_offset',
        'heading'     => 'Responsiveness',
        'param_name'  => 'offset',
        'group'       => 'Width & Responsiveness',
        'description' => 'Adjust column for different screen sizes. Control width, offset and visibility settings.',
      ),
    ),
    'js_view'         => 'VcColumnView'
  ) );


  // ==========================================================================================
  // VC COLUMN INNER
  // ==========================================================================================
  vc_map( array(
    'name'                      => 'Column',
    'base'                      => 'vc_column_inner',
    'class'                     => '',
    'icon'                      => '',
    'wrapper_class'             => '',
    'controls'                  => 'full',
    'allowed_container_element' => false,
    'content_element'           => false,
    'is_container'              => true,
    'category'                  => 'Route Theme',
    'params'                    => array(
      $vc_map_animation,
      $vc_map_animation_delay,
      $vc_map_animation_duration,
      $vc_map_id,
      $vc_map_class,
      $vc_map_style,

      // Responsiveness
      array(
        'type'        => 'dropdown',
        'heading'     => 'Width',
        'param_name'  => 'width',
        'value'       => $column_width_list,
        'group'       => 'Width & Responsiveness',
        'description' => 'Select column width.',
        'std'         => '1/1'
      ),

    ),
    'js_view'                   => 'VcColumnView'
  ) );

}


if( ! in_array( 'vc_column_text', $vc_exclude ) ) {

  // ==========================================================================================
  // VC COLUMN TEXT
  // ==========================================================================================
  vc_map( array(
    'name'          => 'Text Block',
    'base'          => 'vc_column_text',
    'icon'          => 'fa fa-text-width',
    'description'   => 'A block of text with WYSIWYG editor',
    'category'      => 'Route Theme',
    'params'        => array(
      array(
        'holder'      => 'div',
        'type'        => 'textarea_html',
        'heading'     => 'Text',
        'param_name'  => 'content',
        'value'       => '<p>I am text block. Click edit button to change this text.</p>',
      ),
      $vc_map_animation,
      $vc_map_animation_delay,
      $vc_map_animation_duration,
      $vc_map_extra_id,
      $vc_map_extra_class,
      $vc_map_extra_style,

    )
  ) );

}


// ==========================================================================================
// CS SPACE
// ==========================================================================================
vc_map( array(
  'name'                    => 'Space',
  'base'                    => 'cs_space',
  'icon'                    => 'fa fa-arrows-v',
  'description'             => 'Add Some space',
  'show_settings_on_create' => false,
  'category'                => 'Route Theme',
  'params'                  => array(
    array(
      'type'          => 'vc_cs_textfield',
      'param_name'    => 'size',
      'heading'       => 'Size',
      'description'   => 'Eg. 100px 10em -25px 25% etc...',
      'admin_label'   => true,
    ),
  ),
) );


// ==========================================================================================
// CS BUTTON
// ==========================================================================================
vc_map( array(
  'name'            => 'Button',
  'base'            => 'cs_button',
  'icon'            => 'fa fa-square',
  'description'     => 'Create Sweetly Button',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'                => 'vc_link',
      'heading'             => 'Link',
      'param_name'          => 'href',
    ),
    array(
      'type'                => 'vc_cs_icon',
      'heading'             => 'Icon',
      'param_name'          => 'icon',
    ),
    array(
      'type'                => 'textarea',
      'heading'             => 'Content',
      'param_name'          => 'content',
      'value'               => 'Click',
      'admin_label'         => true,
    ),

    // Types
    array(
      'type'                => 'dropdown',
      'heading'             => 'Type',
      'param_name'          => 'type',
      'edit_field_class'    => 'vc_col-md-five vc_column',
      'value'               => $vc_params_button_type,
    ),
    array(
      'type'                => 'dropdown',
      'heading'             => 'Shape',
      'param_name'          => 'shape',
      'edit_field_class'    => 'vc_col-md-five vc_column',
      'value'               => $vc_params_button_shape,
    ),
    array(
      'type'                => 'dropdown',
      'heading'             => 'Size',
      'param_name'          => 'size',
      'edit_field_class'    => 'vc_col-md-five vc_column',
      'value'               => $vc_params_button_size,
      'std'                 => 'sm',
    ),
    array(
      'type'                => 'dropdown',
      'heading'             => 'Color',
      'param_name'          => 'color',
      'edit_field_class'    => 'vc_col-md-five vc_column',
      'value'               => array(
        'Accent'            => 'accent',
        'Blue'              => 'blue',
        'Green'             => 'green',
        'Red'               => 'red',
        'Yellow'            => 'yellow',
        'Black'             => 'black',
        'White'             => 'white',
      ),
    ),
    array(
      'type'                => 'dropdown',
      'heading'             => 'Align',
      'param_name'          => 'align',
      'edit_field_class'    => 'vc_col-md-five vc_column',
      'value'               => $vc_params_button_align,
    ),

    // Helpful
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'Full Block',
      'param_name'          => 'block',
      'edit_field_class'    => 'vc_col-md-five vc_column',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'Text Shadow',
      'param_name'          => 'textshadow',
      'edit_field_class'    => 'vc_col-md-five vc_column',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'No Uppercase',
      'param_name'          => 'no_uppercase',
      'edit_field_class'    => 'vc_col-md-five vc_column',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'No Bold',
      'param_name'          => 'no_bold',
      'edit_field_class'    => 'vc_col-md-five vc_column',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'No Transition',
      'param_name'          => 'no_transition',
      'edit_field_class'    => 'vc_col-md-five vc_column',
    ),

    // Customize
    array(
      'type'                => 'vc_cs_content',
      'content'             => '<h2>Custom Colors</h2>',
      'param_name'          => 'notice-colors',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'group'               => 'Custom Colors',
    ),
    array(
      'type'                => 'vc_cs_content',
      'content'             => '<h2>Custom Hover Colors</h2>',
      'param_name'          => 'notice-hover-colors',
      'edit_field_class'    => 'vc_col-md-6 vc_column vc_no_top_padding',
      'group'               => 'Custom Colors',
    ),
    array(
      'type'                => 'vc_cs_color_picker',
      'heading'             => 'Background Color',
      'param_name'          => 'bgcolor',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'group'               => 'Custom Colors',
    ),
    array(
      'type'                => 'vc_cs_color_picker',
      'heading'             => 'Background Hover Color',
      'param_name'          => 'bghovercolor',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'group'               => 'Custom Colors'
    ),
    array(
      'type'                => 'vc_cs_color_picker',
      'heading'             => 'Text Color',
      'param_name'          => 'textcolor',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'group'               => 'Custom Colors'
    ),
    array(
      'type'                => 'vc_cs_color_picker',
      'heading'             => 'Text Hover Color',
      'param_name'          => 'texthovercolor',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'group'               => 'Custom Colors'
    ),
    array(
      'type'                => 'vc_cs_color_picker',
      'heading'             => 'Border Color',
      'param_name'          => 'bordercolor',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'group'               => 'Custom Colors'
    ),
    array(
      'type'                => 'vc_cs_color_picker',
      'heading'             => 'Border Hover Color',
      'param_name'          => 'borderhovercolor',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'group'               => 'Custom Colors'
    ),
    array(
      'type'                => 'vc_cs_style_textarea',
      'heading'             => 'Custom CSS',
      'param_name'          => 'in_style',
      'placeholder'         => 'eg. border-radius: 0;',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'group'               => 'Custom Colors'
    ),
    array(
      'type'                => 'vc_cs_style_textarea',
      'heading'             => 'Custom Hover CSS',
      'param_name'          => 'in_style_hover',
      'placeholder'         => 'eg. border-radius: 10px;',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'group'               => 'Custom Colors'
    ),
    $vc_map_animation,
    $vc_map_animation_delay,
    $vc_map_animation_duration,

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );


// ==========================================================================================
// CS BUTTON GROUP
// ==========================================================================================
vc_map( array(
  'name'                    => 'Button Group',
  'base'                    => 'cs_button_group',
  'icon'                    => 'fa fa-pause',
  'description'             => 'Create Sweetly Button Group',
  'category'                => 'Route Theme',
  'params'                  => $vc_map_defaults,
  'as_parent'               => array('only' => 'cs_button'),
  'content_element'         => true,
  'show_settings_on_create' => false,
  'js_view'                 => 'VcColumnView',
) );



// ==========================================================================================
// VC TABS
// ==========================================================================================
if( ! in_array( 'vc_tab', $vc_exclude ) ) {

  $tab_unique_id_1 = time() . '-1-' . rand( 0, 100 );
  $tab_unique_id_2 = time() . '-2-' . rand( 0, 100 );
  $tab_unique_id_3 = time() . '-3-' . rand( 0, 100 );

  vc_map( array(
    "name"            => 'Tabs',
    'base'            => 'vc_tabs',
    'is_container'    => true,
    'icon'            => 'fa fa-toggle-right',
    'description'     => 'Tabbed content',
    'category'        => 'Route Theme',
    'params'          => array(
      array(
        'type'        => 'dropdown',
        'heading'     => 'Tab Nav Block',
        'param_name'  => 'type',
        'value'       => array(
          'Default'   => 'default',
          'Left'      => 'left',
          'Right'     => 'right',
        ),
      ),
      array(
        'type'        => 'vc_cs_on_off',
        'heading'     => 'Tab Nav Center',
        'param_name'  => 'center',
        'dependency'  => array( 'element' => 'type', 'value' => array( 'default' ) ),
      ),
      array(
        'type'        => 'vc_cs_on_off',
        'heading'     => 'Tab Nav Fit',
        'param_name'  => 'fit',
        'dependency'  => array( 'element' => 'type', 'value' => array( 'default' ) ),
      ),
      array(
        'type'        => 'vc_cs_color_picker',
        'heading'     => 'Custom Color',
        'param_name'  => 'color',
      ),
      array(
        'type'        => 'textfield',
        'heading'     => 'Active Tab Nav',
        'param_name'  => 'active',
        'description' => 'You can active any tab as default. Eg. 1 or 2 or 3'
      ),
      $vc_map_extra_id,
      $vc_map_extra_class,

    ),
    'custom_markup'   => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children"><ul class="tabs_controls"></ul>%content%</div>',
    'default_content' => '
      [vc_tab title="Tab 1" tab_id="' . $tab_unique_id_1 . '"][/vc_tab]
      [vc_tab title="Tab 2" tab_id="' . $tab_unique_id_2 . '"][/vc_tab]
      [vc_tab title="Tab 3" tab_id="' . $tab_unique_id_3 . '"][/vc_tab]',
    'js_view'         => 'VcTabsView'
  ) );

  // ==========================================================================================
  // VC TAB
  // ==========================================================================================
  vc_map( array(
    'name'                      => 'Tab',
    'base'                      => 'vc_tab',
    'allowed_container_element' => 'vc_row',
    'is_container'              => true,
    'content_element'           => false,
    'category'                  => 'Route Theme',
    'params'                    => array(
      array(
        'type'        => 'tab_id',
        'heading'     => 'Tab Unique ID',
        'param_name'  => 'tab_id'
      ),
      array(
        'type'        => 'textfield',
        'heading'     => 'Tab Title',
        'param_name'  => 'title',
      ),
      array(
        'type'        => 'vc_cs_icon',
        'heading'     => 'Tab Icon',
        'param_name'  => 'icon',
      ),
    ),
    'js_view'         => 'VcTabView'
  ) );

}

// ==========================================================================================
// VC ACCORDION
// ==========================================================================================
if( ! in_array( 'vc_accordion', $vc_exclude ) ) {

  vc_map( array(
    'name'            => 'Accordion',
    'base'            => 'vc_accordion',
    'is_container'    => true,
    'icon'            => 'fa fa-toggle-down',
    'description'     => 'jQuery accordion',
    'category'        => 'Route Theme',
    'params'          => array(
      array(
        'type'        => 'textfield',
        'heading'     => 'Active tab',
        'param_name'  => 'active_tab',
      ),
      array(
        'type'        => 'vc_cs_on_off',
        'heading'     => 'No section icons',
        'param_name'  => 'no_icons',
      ),
      array(
        'type'        => 'vc_cs_color_picker',
        'heading'     => 'Icons Colors',
        'param_name'  => 'icon_color',
        'group'       => 'Custom Colors',
      ),
      array(
        'type'        => 'vc_cs_color_picker',
        'heading'     => 'Title Colors',
        'param_name'  => 'title_color',
        'group'       => 'Custom Colors',
      ),
      array(
        'type'        => 'vc_cs_color_picker',
        'heading'     => 'Border Colors',
        'param_name'  => 'border_color',
        'group'       => 'Custom Colors',
      ),
      $vc_map_extra_id,
      $vc_map_extra_class,

    ),

    'custom_markup'   => '<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">%content%</div><div class="tab_controls"><a class="add_tab" title="Add section"><span class="vc_icon"></span> <span class="tab-label">Add section</span></a></div>',
    'default_content' => '
      [vc_accordion_tab title="Section 1"][/vc_accordion_tab]
      [vc_accordion_tab title="Section 2"][/vc_accordion_tab]
    ',
    'js_view'         => 'VcAccordionView'
  ) );

  // ==========================================================================================
  // VC ACCORDION TAB
  // ==========================================================================================
  vc_map( array(
    'name'                      => 'Accordion Section',
    'base'                      => 'vc_accordion_tab',
    'allowed_container_element' => 'vc_row',
    'is_container'              => true,
    'content_element'           => false,
    'category'                  => 'Route Theme',
    'params'                    => array(
      array(
        'type'        => 'textfield',
        'heading'     => 'Title',
        'param_name'  => 'title',
      ),
      array(
        'type'        => 'vc_cs_icon',
        'heading'     => 'Icon',
        'param_name'  => 'icon',
      )
    ),
    'js_view'         => 'VcAccordionTabView'
  ) );

}

if( ! in_array( 'vc_toggle', $vc_exclude ) ) {

  // ==========================================================================================
  // VC TOGGLE
  // ==========================================================================================
  vc_map( array(
    'name'        => 'Toggle',
    'base'        => 'vc_toggle',
    'icon'        => 'fa fa-unsorted',
    'description' => 'Toggle element for Q&A block',
    'category'    => 'Route Theme',
    'params'      => array(
      array(
        'type'        => 'textfield',
        'holder'      => 'h4',
        'class'       => 'vc_toggle_title',
        'heading'     => 'Toggle title',
        'param_name'  => 'title',
        'value'       => 'Toggle title',
      ),
      array(
        'type'        => 'vc_cs_icon',
        'heading'     => 'Custom Toggle icon',
        'param_name'  => 'icon',
      ),
      array(
        'type'        => 'textarea_html',
        'holder'      => 'div',
        'class'       => 'vc_toggle_content',
        'heading'     => 'Toggle content',
        'param_name'  => 'content',
        'value'       => '<p>Toggle content goes here, click edit button to change this text.</p>',
      ),
      array(
        'type'        => 'dropdown',
        'heading'     => 'Default state',
        'param_name'  => 'open',
        'value'       => array(
          'Closed'    => '',
          'Open'      => 'true'
        ),
        'description' => 'Select "Open" if you want toggle to be open by default.',
      ),
      array(
        'type'        => 'vc_cs_on_off',
        'heading'     => 'No any icon',
        'param_name'  => 'no_icon',
      ),

      // Custom Colors
      array(
        'type'        => 'vc_cs_color_picker',
        'heading'     => 'Icons Color',
        'param_name'  => 'icon_color',
        'group'       => 'Custom Colors',
      ),
      array(
        'type'        => 'vc_cs_color_picker',
        'heading'     => 'Title Color',
        'param_name'  => 'title_color',
        'group'       => 'Custom Colors',
      ),
      array(
        'type'        => 'vc_cs_color_picker',
        'heading'     => 'Border Color',
        'param_name'  => 'border_color',
        'group'       => 'Custom Colors',
      ),
      $vc_map_extra_id,
      $vc_map_extra_class,
      $vc_map_extra_style,

    ),
    'js_view' => 'VcToggleView'
  ) );

}

// ==========================================================================================
// CS PORTFOLIO
// ==========================================================================================
vc_map( array(
  'name'            => 'Portfolio',
  'base'            => 'cs_portfolio',
  'icon'            => 'fa fa-th',
  'description'     => 'Create a portfolio',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'vc_cs_chosen',
      'heading'     => 'Custom Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Choose category (optional)',
      'value'       => cs_element_values( 'categories', array(
        'sort_order'  => 'ASC',
        'taxonomy'    => 'portfolio-category',
        'hide_empty'  => 0,
      ) ),
      'std'         => '',
      'description' => 'you can choose spesific categories for portfolio, default is all categories',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Default'       => 'default',
        'Without Space' => 'without-space',
        'With 1px'      => 'with-one-px',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Layout',
      'param_name'  => 'layout',
      'value'       => array(
        'Masonry'   => 'masonry',
        'Grid'      => 'fitRows',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Model',
      'param_name'  => 'model',
      'value'       => array(
        'Default'           => 'default',
        'Ajax'              => 'ajax',
        'Lightbox Gallery'  => 'gallery',
        'Text'              => 'text',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Columns',
      'param_name'  => 'columns',
      'value'       => array(
        '1 Column'    => 1,
        '2 Columns'   => 2,
        '3 Columns'   => 3,
        '4 Columns'   => 4,
        '5 Columns'   => 5,
        '6 Columns'   => 6,
        '7 Columns'   => 7,
        '8 Columns'   => 8,
        '9 Columns'   => 9,
        '10 Columns'  => 10,
        '11 Columns'  => 11,
        '12 Columns'  => 12,
      ),
      'std'         => 3,
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Thumbnail Size (optional)',
      'param_name'  => 'size',
      'value'       => cs_get_image_sizes( true ),
      'std'         => 'large',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Pagination Type',
      'param_name'  => 'nav',
      'value'       => array(
        'Pagination'  => 'paging',
        'Load More'   => 'load',
        'Hide'        => 'hide',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Posts Per Page',
      'param_name'  => 'limit',
      'value'       => 9,
    ),

    // Customize Filter
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'No Filterable',
      'param_name'  => 'no_filter',
      'group'       => 'Customize Filter',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Filter Color',
      'param_name'  => 'filter_color',
      'group'       => 'Customize Filter',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Filter Active Color',
      'param_name'  => 'filter_hover_color',
      'group'       => 'Customize Filter',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Filter Align',
      'param_name'  => 'filter_align',
      'value'       => array(
        'Left'      => 'left',
        'Center'    => 'center',
        'Right'     => 'right',
      ),
      'std'         => 'center',
      'group'       => 'Customize Filter',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Filter Shape',
      'param_name'  => 'filter_shape',
      'value'       => array(
        'pill'      => 'pill',
        'rounded'   => 'rounded',
        'square'    => 'square',
      ),
      'group'       => 'Customize Filter',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Filter Border Width',
      'param_name'  => 'filter_border_width',
      'group'       => 'Customize Filter',
    ),

    // Extras
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'No Love Button',
      'param_name'  => 'no_love',
      'group'       => 'Extras',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  )
) );


// ==========================================================================================
// CS BLOG
// ==========================================================================================
vc_map( array(
  'name'            => 'Blog',
  'base'            => 'cs_blog',
  'icon'            => 'fa fa-th-large',
  'description'     => 'Create a blog',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'vc_cs_chosen',
      'heading'     => 'Custom Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Choose category (optional)',
      'value'       => cs_element_values( 'categories', array(
        'sort_order'  => 'ASC',
        'taxonomy'    => 'category',
        'hide_empty'  => 0,
      ) ),
      'std'         => '',
      'description' => 'you can choose spesific categories for blog, default is all categories',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Type',
      'param_name'  => 'type',
      'value'       => array(
        'Blog Large Image'  => 'default',
        'Blog Medium Image' => 'medium',
        'Blog Small Image'  => 'small',
        'Blog Masonry'      => 'masonry',
        'Blog Grid'         => 'grid',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Image Size',
      'param_name'  => 'size',
      'value'       => cs_get_image_sizes( true ),
      'std'         => 'blog-large-image',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Columns',
      'param_name'  => 'columns',
      'value'       => array(
        '3 Columns'   => 3,
        '4 Columns'   => 4,
        '6 Columns'   => 6,
        '2 Columns'   => 2,
      ),
      'dependency'           => array( 'element' => 'type', 'value' => array( 'masonry', 'grid' ) ),

    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Pagination',
      'param_name'  => 'nav',
      'value'       => array(
        'Pagination'  => 'paging',
        'Load More'   => 'load',
        'Hide'        => 'hide',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Posts Per Page',
      'param_name'  => 'limit',
      'value'       => get_option( 'posts_per_page' ),
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// CS ALERT
// ==========================================================================================
vc_map( array(
  'name'          => 'Alert',
  'base'          => 'cs_alert',
  'icon'          => 'fa fa-warning',
  'description'   => 'Alert box',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'param_name'  => 'type',
      'heading'     => 'Type',
      'value'       => array(
        'Success'   => 'success',
        'Info'      => 'info',
        'Warning'   => 'warning',
        'Danger'    => 'danger',
        'Note'      => 'note',
      ),
    ),
    array(
      'type'        => 'vc_cs_icon',
      'param_name'  => 'icon',
      'heading'     => 'Icon',
    ),
    array(
      'type'        => 'textarea_html',
      'holder'      => 'div',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'value'       => '<p>I am alert box. Click edit button to change this text.</p>',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Outlined',
      'param_name'  => 'outlined',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Close Button',
      'param_name'  => 'close',
    ),

    $vc_map_animation,
    $vc_map_animation_delay,
    $vc_map_animation_duration,

    // Custom Colors
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Background Color',
      'param_name'  => 'bgcolor',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Colors',
    ),

    // Extars
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,
  ),
) );

// ==========================================================================================
// CS CTA
// ==========================================================================================
$cta_unique_id_1 = time() . '-1-' . rand( 0, 100 );
$cta_unique_id_2 = time() . '-2-' . rand( 0, 100 );
vc_map( array(
  "name"            => 'Call to Action',
  'base'            => 'cs_cta',
  'is_container'    => true,
  'icon'            => 'fa fa-star',
  'class'           => 'wpb_vc_tabs',
  'description'     => 'Call to action content',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'                 => 'dropdown',
      'heading'              => 'Color Type',
      'param_name'           => 'type',
      'value'                => array(
        'Outlined'           => 'outlined',
        'Background Colored' => 'bgcolor',
      )
    ),
    array(
      'type'                 => 'vc_cs_on_off',
      'heading'              => 'Highlight Top',
      'param_name'           => 'top',
      'edit_field_class'     => 'vc_col-md-3 vc_column',
      'dependency'           => array( 'element' => 'type', 'value' => array( 'outlined' ) ),
    ),
    array(
      'type'                 => 'vc_cs_on_off',
      'heading'              => 'Highlight Right',
      'param_name'           => 'right',
      'edit_field_class'     => 'vc_col-md-3 vc_column',
      'dependency'           => array( 'element' => 'type', 'value' => array( 'outlined' ) ),
    ),
    array(
      'type'                 => 'vc_cs_on_off',
      'heading'              => 'Highlight Bottom',
      'param_name'           => 'bottom',
      'edit_field_class'     => 'vc_col-md-3 vc_column',
      'dependency'           => array( 'element' => 'type', 'value' => array( 'outlined' ) ),
    ),
    array(
      'type'                 => 'vc_cs_on_off',
      'heading'              => 'Highlight Left',
      'param_name'           => 'left',
      'edit_field_class'     => 'vc_col-md-3 vc_column',
      'dependency'           => array( 'element' => 'type', 'value' => array( 'outlined' ) ),
    ),

    // Custom Colors
    array(
      'type'                 => 'vc_cs_color_picker',
      'heading'              => 'Background Color',
      'param_name'           => 'bgcolor',
      'group'                => 'Custom Colors',
    ),
    array(
      'type'                 => 'vc_cs_color_picker',
      'heading'              => 'Border Color',
      'param_name'           => 'border_color',
      'group'                => 'Custom Colors',
    ),
    array(
      'type'                 => 'vc_cs_color_picker',
      'heading'              => 'Border Highlight Color',
      'param_name'           => 'border_hcolor',
      'group'                => 'Custom Colors',
    ),
    array(
      'type'                 => 'vc_cs_color_picker',
      'heading'              => 'Text Color',
      'param_name'           => 'text_color',
      'group'                => 'Custom Colors',
    ),

    // Extars
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,


  ),
  'custom_markup'     => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children"><ul class="tabs_controls"></ul>%content%</div>',
  'default_content'   => '
    [cs_cta_block title="CTA Block Primary" tab_id="' . $cta_unique_id_1 . '"][/cs_cta_block]
    [cs_cta_block title="CTA Block Secondary" tab_id="' . $cta_unique_id_2 . '"][/cs_cta_block]',
  'js_view'           => 'VcTabsView'
) );

// ==========================================================================================
// CS CTA BLOCK
// ==========================================================================================
vc_map( array(
  'name'                      => 'Call to Action Block',
  'base'                      => 'cs_cta_block',
  'allowed_container_element' => 'vc_row',
  'as_parent'                 => array('only' => 'cs_button,cs_button_group,vc_column_text,cs_space'),
  'is_container'              => true,
  'content_element'           => false,
  'category'                  => 'Route Theme',
  'params'                    => array(
    array(
      'type'        => 'tab_id',
      'heading'     => 'Tab Unique ID',
      'param_name'  => 'tab_id'
    )
  ),
  'js_view'         => 'VcTabView'
) );

// ==========================================================================================
// CS ICONBOX
// ==========================================================================================
  vc_map( array(
  'name'          => 'Icon Box',
  'base'          => 'cs_iconbox',
  'icon'          => 'fa fa-dot-circle-o',
  'description'   => 'Create an iconbox',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Box Title',
      'param_name'  => 'title',
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Box Content',
      'param_name'  => 'content',
      'admin_label' => true,
    ),
    $vc_map_animation,
    $vc_map_animation_delay,
    $vc_map_animation_duration,

    // icon tab
    array(
      'type'        => 'vc_cs_icon',
      'heading'     => 'Select box icon',
      'param_name'  => 'icon',
      'group'       => 'Box Icon',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon and Text Align',
      'param_name'  => 'align',
      'description' => 'Set icon position, also this is text align',
      'value'       => array(
        'Box Left'      => 'left',
        'Box Center'    => 'center',
        'Box Right'     => 'right',
        'Heading Left'  => 'heading-left',
        'Heading Right' => 'heading-right',
      ),
      'group'       => 'Box Icon',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon Type',
      'param_name'  => 'icon_type',
      'value'       => array(
        'Background Color'  => 'bgcolor',
        'Outlined'          => 'outlined',
        'Bordered'          => 'bordered',
        'No Colors'         => 'nocolor',
      ),
      'group'       => 'Box Icon',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon Shape',
      'param_name'  => 'icon_shape',
      'value'       => array(
        'Square'    => 'square',
        'Circle'    => 'circle',
        'Rounded'   => 'rounded',
      ),
      'group'       => 'Box Icon',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon Size',
      'param_name'  => 'icon_size',
      'value'       => array(
        'XX Small'  => 'xxs',
        'X Small'   => 'xs',
        'Small'     => 'sm',
        'Medium'    => 'md',
        'Large'     => 'lg',
        'X Large'   => 'xl',
        'XX Large'  => 'xxl',
        'Custom'    => 'custom',
      ),
      'std'   => 'sm',
      'group' => 'Box Icon',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Icon Size',
      'param_name'          => 'custom_icon_size',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'dependency'          => array( 'element' => 'icon_size', 'value' => array( 'custom' ) ),
      'group'               => 'Box Icon',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Icon Spacing',
      'param_name'          => 'custom_icon_spacing',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'dependency'          => array( 'element' => 'icon_size', 'value' => array( 'custom' ) ),
      'group'               => 'Box Icon',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Icon Border Width',
      'param_name'  => 'icon_border_width',
      'group'       => 'Box Icon',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon Border Style',
      'param_name'  => 'icon_border_style',
      'value'       => array(
        'Solid'     => '',
        'Dashed'    => 'dashed',
        'Dotted'    => 'dotted',
        'Double'    => 'double',
        'Groove'    => 'groove',
        'Ridge'     => 'ridge',
        'Inset'     => 'inset',
        'Outset'    => 'outset',
      ),
      'group'       => 'Box Icon',
    ),

    // Customize
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Icon Background Color',
      'param_name'  => 'icon_background',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Icon Border Color',
      'param_name'  => 'icon_border',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Icon Color',
      'param_name'  => 'icon_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Title Color',
      'param_name'  => 'title_color',
      'group'       => 'Custom Colors',
    ),

    // Box Extras
    array(
      'type'        => 'vc_link',
      'heading'     => 'Box Link',
      'param_name'  => 'link',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Apply link to',
      'param_name'  => 'apply_link',
      'value'       => array(
        'Box'       => '',
        'Title'     => 'Title',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Box Title Size',
      'param_name'  => 'title_size',
      'value'       => array(
        'Select a heading' => '',
        'h1'      => 'h1',
        'h2'      => 'h2',
        'h3'      => 'h3',
        'h4'      => 'h4',
        'h5'      => 'h5',
        'h6'      => 'h6',
        'custom'  => 'custom',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Custom Title Size',
      'param_name'  => 'custom_title_size',
      'dependency'  => array( 'element' => 'title_size', 'value' => array( 'custom' ) ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Icon Hover Effect',
      'param_name'  => 'effect',
      'group'       => 'Extras',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  ),
) );

// ==========================================================================================
// CS FANCYBOX
// ==========================================================================================
vc_map( array(
  'name'          => 'Icon Fancybox',
  'base'          => 'cs_fancybox',
  'icon'          => 'fa fa-bullseye',
  'description'   => 'Create an fancybox',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'               => 'textfield',
      'heading'            => 'Box Title',
      'param_name'         => 'title',
    ),
    array(
      'type'               => 'dropdown',
      'heading'            => 'Box Type',
      'param_name'         => 'box_type',
      'value'              => array(
        'Background Color' => 'bgcolor',
        'Outlined'         => 'outlined',
      ),
    ),
    array(
      'type'               => 'textarea_html',
      'heading'            => 'Box Content',
      'param_name'         => 'content',
      'admin_label'        => true,
    ),

    // icon tab
    array(
      'type'        => 'vc_cs_icon',
      'heading'     => 'Select box icon',
      'param_name'  => 'icon',
      'group'       => 'Box Icon',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon Position',
      'param_name'  => 'icon_position',
      'value'       => array(
        'Top Center'    => 'tc',
        'Top Left'      => 'tl',
        'Top Right'     => 'tr',
        'Center Left'   => 'cl',
        'Center Right'  => 'cr',
        'Bottom Center' => 'bc',
        'Bottom Left'   => 'bl',
        'Bottom Right'  => 'br',
      ),
      'group'       => 'Box Icon',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon Type',
      'param_name'  => 'icon_type',
      'value'       => array(
        'Background Color'  => 'bgcolor',
        'Outlined'          => 'outlined',
      ),
      'group'       => 'Box Icon',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon Shape',
      'param_name'  => 'icon_shape',
      'value'       => array(
        'Square'    => 'square',
        'Circle'    => 'circle',
        'Rounded'   => 'rounded',
      ),
      'group'       => 'Box Icon',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon Size',
      'param_name'  => 'icon_size',
      'value'       => array(
        'XX Small'  => 'xxs',
        'X Small'   => 'xs',
        'Small'     => 'sm',
        'Medium'    => 'md',
        'Large'     => 'lg',
        'X Large'   => 'xl',
        'XX Large'  => 'xxl',
      ),
      'std'         => 'sm',
      'group'       => 'Box Icon',
    ),

    // Customize
    array(
      'type'        => 'vc_cs_content',
      'param_name'  => 'fancybox-icon-colors',
      'content'     => '<p class="cs-alert cs-alert-info">Custom Icon Colors</p>',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'                => 'vc_cs_color_picker',
      'heading'             => 'Icon Background Color',
      'param_name'          => 'icon_background',
      'edit_field_class'    => 'vc_col-md-4 vc_column',
      'group'               => 'Custom Colors',
    ),
    array(
      'type'                => 'vc_cs_color_picker',
      'heading'             => 'Icon Color',
      'param_name'          => 'icon_color',
      'edit_field_class'    => 'vc_col-md-4 vc_column',
      'group'               => 'Custom Colors',
    ),
    array(
      'type'                => 'vc_cs_color_picker',
      'heading'             => 'Icon Border Color',
      'param_name'          => 'icon_border',
      'edit_field_class'    => 'vc_col-md-4 vc_column',
      'group'               => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_content',
      'param_name'  => 'fancybox-box-colors',
      'content'     => '<p class="cs-alert cs-alert-info">Custom Box Colors</p>',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Box Background Color',
      'param_name'  => 'box_background',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Box Border Color',
      'param_name'  => 'box_border',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Box Text Color',
      'param_name'  => 'box_text_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Box Title Color',
      'param_name'  => 'box_title_color',
      'group'       => 'Custom Colors',
    ),

    // Box Extras
    array(
      'type'        => 'vc_link',
      'heading'     => 'Box Link',
      'param_name'  => 'link',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Apply link to',
      'param_name'  => 'apply_link',
      'value'       => array(
        'Box'       => '',
        'Title'     => 'Title',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Box Title Size',
      'param_name'  => 'title_size',
      'value'       => array(
        'Select a heading' => '',
        'h1'      => 'h1',
        'h2'      => 'h2',
        'h3'      => 'h3',
        'h4'      => 'h4',
        'h5'      => 'h5',
        'h6'      => 'h6',
        'custom'  => 'custom',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Custom Title Size',
      'param_name'  => 'custom_title_size',
      'dependency'  => array( 'element' => 'title_size', 'value' => array( 'custom' ) ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Box Rounded',
      'param_name'  => 'box_rounded',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Box Border Width',
      'param_name'  => 'box_border_width',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Box Border Style',
      'param_name'  => 'box_border_style',
      'value'       => array(
        'Solid'     => '',
        'Dashed'    => 'dashed',
        'Dotted'    => 'dotted',
        'Double'    => 'double',
        'Groove'    => 'groove',
        'Ridge'     => 'ridge',
        'Inset'     => 'inset',
        'Outset'    => 'outset',
      ),
      'group'       => 'Extras',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  ),
) );

// ==========================================================================================
// CS PROGRESS BAR
// ==========================================================================================
vc_map( array(
  'name'          => 'Progress Bar',
  'base'          => 'cs_progress',
  'icon'          => 'fa fa-tasks',
  'description'   => 'Create a progress bar',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Percentage',
      'param_name'  => 'percentage',
      'value'       => 100,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Unit',
      'param_name'  => 'unit',
      'value'       => '%',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Height',
      'param_name'  => 'height',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'Vertical Bar',
      'param_name'          => 'vertical',
      'edit_field_class'    => 'vc_col-md-3 vc_column',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'Striped Effect',
      'param_name'          => 'striped',
      'edit_field_class'    => 'vc_col-md-3 vc_column',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'Inside Percentage',
      'param_name'          => 'inside',
      'edit_field_class'    => 'vc_col-md-3 vc_column',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'Circle Bar',
      'param_name'          => 'circle',
      'edit_field_class'    => 'vc_col-md-3 vc_column',
    ),

    // Custom Colors
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Bar Color',
      'param_name'  => 'bar_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Bar Background Color',
      'param_name'  => 'bg_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Bar Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  )
) );

// ==========================================================================================
// CS PROGRESS BAR GROUP
// ==========================================================================================
vc_map( array(
  'name'                    => 'Progress Bar Group',
  'base'                    => 'cs_progress_group',
  'icon'                    => 'fa fa-tasks',
  'description'             => 'Create a progress bar group',
  'params'                  => $vc_map_defaults,
  'category'                => 'Route Theme',
  'as_parent'               => array('only' => 'cs_progress'),
  'content_element'         => true,
  'show_settings_on_create' => false,
  'js_view'                 => 'VcColumnView',
) );


// ==========================================================================================
// CS ICON PROGRESS
// ==========================================================================================
vc_map( array(
  'name'          => 'Progress Icon',
  'base'          => 'cs_progress_icon',
  'icon'          => 'fa fa-star-half-o',
  'description'   => 'Create a progress icons',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'        => 'vc_cs_icon',
      'heading'     => 'Icon',
      'param_name'  => 'icon',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Total Icons',
      'param_name'          => 'total',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'value'               => 20,
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Active Icons',
      'param_name'          => 'active',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'value'               => 10,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Icon Size',
      'param_name'  => 'size',
    ),

    // Custom Colors
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Active Icon Color',
      'param_name'  => 'active_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Icon Base  Color',
      'param_name'  => 'base_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  )
) );


// ==========================================================================================
// CS COUNTER
// ==========================================================================================
vc_map( array(
  'name'          => 'Counter',
  'base'          => 'cs_counter',
  'icon'          => 'fa fa-sort-numeric-asc',
  'description'   => 'Create a counter milestone',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'admin_label' => true,
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'From',
      'param_name'          => 'from',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'value'               => 0,
      'admin_label'         => true,
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'To',
      'param_name'          => 'to',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'value'               => 100,
      'admin_label'         => true,
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Decimals',
      'param_name'          => 'decimals',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Duration',
      'param_name'          => 'duration',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Separator',
      'param_name'          => 'separator',
    ),
    array(
      'type'                => 'vc_cs_icon',
      'heading'             => 'Prefix Icon',
      'param_name'          => 'prefix_icon',
      'group'               => 'Prefix',
    ),
    array(
      'type'                => 'dropdown',
      'heading'             => 'Prefix Position',
      'param_name'          => 'prefix_pos',
      'value'               => array(
        'Right'             => '',
        'Left'              => 'left',
        'Top'               => 'top',
        'Bottom'            => 'bottom',
      ),
      'group'               => 'Prefix',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Prefix Size',
      'param_name'          => 'prefix_size',
      'group'               => 'Prefix',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Prefix Opacity',
      'param_name'          => 'prefix_opacity',
      'group'               => 'Prefix',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Prefix Extra Text',
      'param_name'          => 'prefix_text',
      'group'               => 'Prefix',
    ),

    // Custom Colors
    array(
      'type'          => 'vc_cs_color_picker',
      'heading'       => 'Counter Color',
      'param_name'    => 'counter_color',
      'group'         => 'Custom Colors',
    ),
    array(
      'type'          => 'vc_cs_color_picker',
      'heading'       => 'Prefix Color',
      'param_name'    => 'prefix_color',
      'group'         => 'Custom Colors',
    ),
    array(
      'type'          => 'vc_cs_color_picker',
      'heading'       => 'Title Color',
      'param_name'    => 'title_color',
      'group'         => 'Custom Colors',
    ),

    // Extras
    array(
      'type'          => 'textfield',
      'heading'       => 'Title Size',
      'param_name'    => 'title_size',
      'group'         => 'Extras',
    ),
    array(
      'type'          => 'textfield',
      'heading'       => 'Counter Size',
      'param_name'    => 'counter_size',
      'group'         => 'Extras',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  )
) );


// ==========================================================================================
// CS PIECHART
// ==========================================================================================
vc_map( array(
  'name'          => 'Pie Chart',
  'base'          => 'cs_piechart',
  'icon'          => 'fa fa-adjust',
  'description'   => 'Create a pie chart',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Type',
      'param_name'  => 'type',
      'value'       => array(
        'Count Number'  => 'count',
        'Only Icon'     => 'icon',
        'Only Text'     => 'text',
      )
    ),
    array(
      'type'        => 'vc_cs_icon',
      'heading'     => 'Icon',
      'param_name'  => 'icon',
      'dependency'  => array( 'element' => 'type', 'value' => array( 'icon' ) ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Text',
      'param_name'  => 'text',
      'dependency'  => array( 'element' => 'type', 'value' => array( 'text' ) ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Percent',
      'param_name'  => 'percent',
      'value'       => 100,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Size',
      'param_name'  => 'size',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Line Width',
      'param_name'  => 'line_width',
      'value'       => 2,
    ),

    // Custom Colors
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Bar Color',
      'param_name'  => 'bar_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Track Color',
      'param_name'  => 'track_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Title Color',
      'param_name'  => 'title_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    array(
      'type'        => 'textfield',
      'heading'     => 'Text Size',
      'param_name'  => 'text_size',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title Size',
      'param_name'  => 'title_size',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Prefix',
      'param_name'  => 'prefix',
      'group'       => 'Extras',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  )
) );


// ==========================================================================================
// CS BLOCKQUOTE
// ==========================================================================================
vc_map( array(
  'name'          => 'BlockQuote',
  'base'          => 'cs_blockquote',
  'icon'          => 'fa fa-quote-right',
  'description'   => 'Create a blockquote',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'        => 'textarea_html',
      'holder'      => 'div',
      'heading'     => 'Text',
      'param_name'  => 'content',
      'value'       => '<p>I am text block. Click edit button to change this text.</p>',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Cite',
      'param_name'  => 'cite',
    ),

    // Extras
    array(
      'type'        => 'dropdown',
      'heading'     => 'Type',
      'param_name'  => 'type',
      'value'       => array(
        'Select a type'     => '',
        'Quote Left Half'   => 'left',
        'Quote Right Half'  => 'right',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Use Quote Icon',
      'param_name'  => 'icon',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Icon Color',
      'param_name'  => 'icon_color',
      'dependency'  => array( 'element' => 'icon', 'not_empty' => true ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Icon Size',
      'param_name'  => 'icon_size',
      'dependency'  => array( 'element' => 'icon', 'not_empty' => true ),
      'group'       => 'Extras',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,
  )
) );

// ==========================================================================================
// CS TESTIMONIALS
// ==========================================================================================
vc_map( array(
  'name'                    => 'Testimonial',
  'base'                    => 'cs_testimonials',
  'icon'                    => 'fa fa-comments',
  'description'             => 'Create a testimonial slider',
  'category'                => 'Route Theme',
  'params'                  => $vc_map_defaults,
  'as_parent'               => array('only' => 'cs_testimonial'),
  'content_element'         => true,
  'show_settings_on_create' => false,
  'js_view'                 => 'VcColumnView',
) );


// ==========================================================================================
// CS TESTIMONIAL
// ==========================================================================================
vc_map( array(
  'name'            => 'BlockQuote',
  'base'            => 'cs_testimonial',
  'icon'            => 'fa fa-comment',
  'description'     => 'Create a blockquote',
  'content_element' => true,
  'as_child'        => array('only' => 'cs_testimonials'),
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'textarea_html',
      'holder'      => 'div',
      'heading'     => 'Text',
      'param_name'  => 'content',
      'value'       => '<p>I am text block. Click edit button to change this text.</p>',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Author',
      'param_name'          => 'author',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Slogan',
      'param_name'          => 'slogan',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'        => 'vc_cs_upload',
      'heading'     => 'Avatar',
      'param_name'  => 'avatar',
    ),
  )
) );


// ==========================================================================================
// CS DROPCAP
// ==========================================================================================
vc_map( array(
  'name'            => 'Dropcap',
  'base'            => 'cs_dropcap',
  'icon'            => 'fa fa-paragraph',
  'description'     => 'Create a dropcap',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Word(s)',
      'param_name'  => 'word',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Word Size',
      'param_name'  => 'size',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Text Color',
      'param_name'  => 'color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Background Color',
      'param_name'  => 'bgcolor',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Background Shape',
      'param_name'  => 'shape',
      'value'       => array(
        'Square'    => '',
        'Rounded'   => 'rounded',
        'Circle'    => 'circle',
      ),
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

   )
) );

// ==========================================================================================
// CS LIST
// ==========================================================================================
vc_map( array(
  'name'                    => 'Icon List',
  'base'                    => 'cs_icon_list',
  'icon'                    => 'fa fa-th-list',
  'description'             => 'Create a icon list',
  'category'                => 'Route Theme',
  'params'                  => $vc_map_defaults,
  'as_parent'               => array('only' => 'cs_icon_list_item'),
  'show_settings_on_create' => false,
  'js_view'                 => 'VcColumnView',
) );

vc_map( array(
  'name'            => 'Icon List Item',
  'base'            => 'cs_icon_list_item',
  'icon'            => 'fa fa-th-list',
  'description'     => 'Create a ul list',
  'as_child'        => array('only' => 'cs_icon_list'),
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'vc_cs_icon',
      'heading'     => 'Icon',
      'param_name'  => 'icon',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textarea',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'admin_label' => true,
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Icon Color',
      'param_name'  => 'icon_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,
  )
) );


// ==========================================================================================
// CS CLIENTS
// ==========================================================================================
vc_map( array(
  'name'                    => 'Clients List',
  'base'                    => 'cs_clients',
  'icon'                    => 'fa fa-users',
  'description'             => 'Create a client gird list',
  'category'                => 'Route Theme',
  'params'                  => array(
    array(
      'type'          => 'dropdown',
      'heading'       => 'Columns',
      'param_name'    => 'columns',
      'value'         => array(
        '1 Column'    => 1,
        '2 Columns'   => 2,
        '3 Columns'   => 3,
        '4 Columns'   => 4,
        '5 Columns'   => 5,
        '6 Columns'   => 6,
        '7 Columns'   => 7,
        '8 Columns'   => 8,
        '9 Columns'   => 9,
        '10 Columns'  => 10,
      ),
      'std'           => 4,
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'No Hover Effect',
      'param_name'  => 'effect',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  ),
  'as_parent'               => array('only' => 'cs_client'),
  'js_view'                 => 'VcColumnView',
) );

vc_map( array(
  'name'            => 'Client',
  'base'            => 'cs_client',
  'icon'            => 'fa fa-user',
  'description'     => 'Create a client',
  'as_child'        => array('only' => 'cs_clients'),
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'vc_cs_upload',
      'heading'     => 'Image',
      'param_name'  => 'image',
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Link',
      'param_name'  => 'link',
    ),
  )
) );



// ==========================================================================================
// CS PRICING
// ==========================================================================================
vc_map( array(
  'name'                    => 'Pricing Table',
  'base'                    => 'cs_pricing_table',
  'icon'                    => 'fa fa-money',
  'description'             => 'Create a pricing table',
  'category'                => 'Route Theme',
  'params'                  => $vc_map_defaults,
  'as_parent'               => array('only' => 'cs_pricing_column'),
  'show_settings_on_create' => false,
  'js_view'                 => 'VcColumnView',
) );

vc_map( array(
  'name'            => 'Pricing Column',
  'base'            => 'cs_pricing_column',
  'icon'            => 'fa fa-money',
  'description'     => 'Create a pricing column',
  'as_child'        => array('only' => 'cs_pricing_table'),
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'admin_label' => true,
    ),
    array(
      'type'        => 'vc_cs_textfield',
      'heading'     => 'Price',
      'param_name'  => 'price',
      'placeholder' => 99,
      'edit_field_class'    => 'vc_col-md-3 vc_column',
    ),
    array(
      'type'        => 'vc_cs_textfield',
      'heading'     => 'Price Subtitle',
      'param_name'  => 'subtitle',
      'placeholder' => 'BEST SELLER',
      'edit_field_class'    => 'vc_col-md-3 vc_column',
    ),
    array(
      'type'        => 'vc_cs_textfield',
      'heading'     => 'Currency',
      'param_name'  => 'currency',
      'placeholder' => '$',
      'edit_field_class'    => 'vc_col-md-3 vc_column',
    ),
    array(
      'type'        => 'vc_cs_textfield',
      'heading'     => 'Interval',
      'param_name'  => 'interval',
      'placeholder' => 'per year',
      'edit_field_class'    => 'vc_col-md-3 vc_column',
    ),
    array(
      'type'          => 'vc_cs_exploded_textarea',
      'heading'       => 'Features',
      'param_name'    => 'content',
      'value'         => 'some~feature~here',
      'description'   => 'textarea, where each line will be imploded with comma (~)',
    ),

    // Custom Colors
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Featured Column',
      'param_name'  => 'featured',
      'label'       => 'Set this column as featured!',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Predefined Colors',
      'param_name'  => 'color',
      'value'       => array(
        'Accent'    => 'accent',
        'Blue'      => 'blue',
        'Green'     => 'green',
        'Red'       => 'red',
        'Yellow'    => 'yellow',
        'Gray'      => 'gray',
        'Black'     => 'black',
        'Custom'    => 'custom',
      ),
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Title Background Color',
      'param_name'  => 'title_bgcolor',
      'dependency'  => array( 'element' => 'color', 'value' => array( 'custom' ) ),
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Title Color',
      'param_name'  => 'title_color',
      'dependency'  => array( 'element' => 'color', 'value' => array( 'custom' ) ),
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Price Background Color',
      'param_name'  => 'price_bgcolor',
      'dependency'  => array( 'element' => 'color', 'value' => array( 'custom' ) ),
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Price Color',
      'param_name'  => 'price_color',
      'dependency'  => array( 'element' => 'color', 'value' => array( 'custom' ) ),
      'group'       => 'Custom Colors',
    ),


    // Price Button
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text',
      'param_name'  => 'button_content',
      'value'       => '',
      'group'       => 'Button',
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Link',
      'param_name'  => 'button_link',
      'group'       => 'Button',
    ),
    array(
      'type'        => 'vc_cs_icon',
      'heading'     => 'Icon',
      'param_name'  => 'button_icon',
      'group'       => 'Button',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Type',
      'param_name'  => 'button_type',
      'value'       => $vc_params_button_type,
      'group'       => 'Button',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Shape',
      'param_name'  => 'button_shape',
      'value'       => $vc_params_button_shape,
      'group'       => 'Button',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Size',
      'param_name'  => 'button_size',
      'value'       => $vc_params_button_size,
      'std'         => 'sm',
      'group'       => 'Button',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Color',
      'param_name'  => 'button_color',
      'value'       => array(
        'Accent'    => 'accent',
        'Blue'      => 'blue',
        'Green'     => 'green',
        'Red'       => 'red',
        'Yellow'    => 'yellow',
        'Gray'      => 'gray',
        'Black'     => 'black',
      ),
      'group'       => 'Button',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Full Width Block Button',
      'param_name'  => 'button_block',
      'group'       => 'Button',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  )
) );

// ==========================================================================================
// CS TABLE
// ==========================================================================================
vc_map( array(
  'name'            => 'Table',
  'base'            => 'cs_table',
  'icon'            => 'fa fa-table',
  'description'     => 'Create a table',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Striped rows',
      'param_name'  => 'striped',
      'edit_field_class'    => 'vc_col-md-five',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Bordered',
      'edit_field_class'    => 'vc_col-md-five',
      'param_name'  => 'bordered',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Hover rows',
      'param_name'  => 'hover',
      'edit_field_class'    => 'vc_col-md-five',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Condensed',
      'param_name'  => 'condensed',
      'edit_field_class'    => 'vc_col-md-five',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Responsive',
      'param_name'  => 'responsive',
      'edit_field_class'    => 'vc_col-md-five',
    ),
    array(
      'holder'      => 'div',
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'value'       => '<table><thead><tr><th>#</th><th>First Name</th><th>Last Name</th><th>Username</th></tr></thead><tbody><tr><td>1</td><td>Mark</td><td>Otto</td><td>@mdo</td></tr><tr><td>2</td><td>Jacob</td><td>Thornton</td><td>@fat</td></tr></tbody></table>',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  )
) );

// ==========================================================================================
// CS TOOLTIP
// ==========================================================================================
vc_map( array(
  'name'            => 'ToolTip',
  'base'            => 'cs_tooltip',
  'icon'            => 'fa fa-comment',
  'description'     => 'Create a tooltip',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'vc_cs_textfield',
      'heading'     => 'Unique ID',
      'param_name'  => 'selector',
      'placeholder' => 'tooltip_'. uniqid(),
      'description' => 'Copy-paste this unique id for any element class attribute',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Placement',
      'param_name'  => 'placement',
      'value'       => array(
        'Top'       => 'top',
        'Bottom'    => 'bottom',
        'Left'      => 'left',
        'Right'     => 'right',
        'Auto'      => 'auto',
      ),
      'description' => 'how to position the tooltip - top | bottom | left | right | auto. When "auto" is specified, it will dynamically reorient the tooltip.',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Trigger',
      'param_name'  => 'trigger',
      'value'       => array(
        'Hover'     => 'hover',
        'Focus'     => 'focus',
        'Click'     => 'click',
      ),
      'description' => 'how tooltip is triggered - click | hover | focus | manual',
    ),
    array(
      'holder'      => 'div',
      'type'        => 'textarea',
      'heading'     => 'Tooltip Content',
      'param_name'  => 'content',
    ),
  )
) );

// ==========================================================================================
// CS Popover
// ==========================================================================================
vc_map( array(
  'name'            => 'Popover',
  'base'            => 'cs_popover',
  'icon'            => 'fa fa-comment',
  'description'     => 'Create a popover',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'vc_cs_textfield',
      'heading'     => 'Unique ID',
      'param_name'  => 'selector',
      'placeholder' => 'popover_'. uniqid(),
      'description' => 'Copy-paste this unique id for any element class attribute',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Placement',
      'param_name'  => 'placement',
      'value'       => array(
        'Top'       => 'top',
        'Bottom'    => 'bottom',
        'Left'      => 'left',
        'Right'     => 'right',
        'Auto'      => 'auto',
      ),
      'description' => 'how to position the popover - top | bottom | left | right | auto. When "auto" is specified, it will dynamically reorient the popover.',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Trigger',
      'param_name'  => 'trigger',
      'value'       => array(
        'Hover'     => 'hover',
        'Focus'     => 'focus',
        'Click'     => 'click',
      ),
      'description' => 'how popover is triggered - click | hover | focus | manual',
    ),
    array(
      'holder'      => 'div',
      'type'        => 'textfield',
      'heading'     => 'Popover Title',
      'param_name'  => 'title',
    ),
    array(
      'holder'      => 'div',
      'type'        => 'textarea',
      'heading'     => 'Popover Content',
      'param_name'  => 'content',
    ),
  )
) );


// ==========================================================================================
// CS MODAL
// ==========================================================================================
vc_map( array(
  'name'            => 'Modal',
  'base'            => 'cs_modal',
  'icon'            => 'fa fa-info-circle',
  'description'     => 'Create a modal',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Unique ID',
      'param_name'  => 'id',
      'value'       => 'modal_'. uniqid(),
      'description' => 'Copy-paste this unique id for any element class attribute',
    ),
    array(
      'holder'      => 'div',
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
    ),
    array(
      'holder'      => 'div',
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Open modal in center',
      'param_name'  => 'center',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Modal size',
      'param_name'  => 'size',
      'value'       => array(
        'Large'  => 'lg',
        'Small'  => 'sm',
      ),
    ),
  )
) );


// ==========================================================================================
// CS Divider
// ==========================================================================================
vc_map( array(
  'name'            => 'Divider',
  'base'            => 'cs_divider',
  'icon'            => 'fa fa-minus',
  'description'     => 'Create a divider line',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Type',
      'param_name'  => 'type',
      'value'       => array(
        'Solid'         => '',
        'Dashed'        => 'dashed',
        'Dotted'        => 'dotted',
        'Double'        => 'double',
        'Solid Dashed'  => 'solid-dashed',
        'Dashed Solid'  => 'dashed-solid',
      ),
      'admin_label' => true,
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Color',
      'param_name'  => 'color',
    ),

    // Extras
    array(
      'type'        => 'dropdown',
      'heading'     => 'Width',
      'param_name'  => 'width',
      'value'       => array(
        '100%'      => '',
        '75%'       => '75%',
        '50%'       => '50%',
        '25%'       => '25%',
        '10%'       => '10%',
        '5%'        => '5%',
        'custom'    => 'custom',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Custom Width',
      'param_name'  => 'custom_width',
      'dependency'  => array( 'element' => 'width', 'value' => array( 'custom' ) ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Align',
      'param_name'  => 'align',
      'value'       => array(
        'Select align'  => '',
        'left'          => 'left',
        'center'        => 'center',
        'right'         => 'right',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Margin (spacing)',
      'param_name'  => 'margin',
      'value'       => array(
        'Small'     => '',
        'X Small'   => 'xs',
        'Medium'    => 'md',
        'Large'     => 'lg',
        'X Large'   => 'xl',
        'Custom'    => 'custom',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Top',
      'param_name'  => 'margin_top',
      'dependency'  => array( 'element' => 'margin', 'value' => array( 'custom' ) ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Bottom',
      'param_name'  => 'margin_bottom',
      'dependency'  => array( 'element' => 'margin', 'value' => array( 'custom' ) ),
      'group'       => 'Extras',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  )
) );

// ==========================================================================================
// CS Divider with Icon
// ==========================================================================================
vc_map( array(
  'name'            => 'Divider with Icon',
  'base'            => 'cs_divider_icon',
  'icon'            => 'fa fa-ellipsis-h',
  'description'     => 'Create a divider with icon or text',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'vc_cs_icon',
      'heading'     => 'Icon',
      'param_name'  => 'icon',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Text',
      'param_name'  => 'text',
      'admin_label' => true,
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon & Text Align',
      'param_name'  => 'align',
      'value'       => array(
        'Center'    => 'center',
        'Left'      => 'left',
        'Right'     => 'right',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Icon & Text Size',
      'param_name'  => 'size',
    ),

    // Custom Colors
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Icon & Text Color',
      'param_name'  => 'color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color',
      'group'       => 'Custom Colors',
    ),

    // Extars
    array(
      'type'        => 'dropdown',
      'heading'     => 'Border Type',
      'param_name'  => 'border_type',
      'value'       => array(
        'Solid'         => '',
        'Dashed'        => 'dashed',
        'Dotted'        => 'dotted',
        'Double'        => 'double',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Width',
      'param_name'  => 'width',
      'value'       => array(
        '100%'      => '',
        '75%'       => '75%',
        '50%'       => '50%',
        '25%'       => '25%',
        '10%'       => '10%',
        '5%'        => '5%',
        'custom'    => 'custom',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Custom Width',
      'param_name'  => 'custom_width',
      'dependency'  => array( 'element' => 'width', 'value' => array( 'custom' ) ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Margin (spacing)',
      'param_name'  => 'margin',
      'value'       => array(
        'sm'        => '',
        'xs'        => 'xs',
        'md'        => 'md',
        'lg'        => 'lg',
        'xl'        => 'xl',
        'custom'    => 'custom',
      ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Top',
      'param_name'  => 'margin_top',
      'dependency'  => array( 'element' => 'margin', 'value' => array( 'custom' ) ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Bottom',
      'param_name'  => 'margin_bottom',
      'dependency'  => array( 'element' => 'margin', 'value' => array( 'custom' ) ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'No Border Space',
      'param_name'  => 'no_space',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_shortcode_textarea',
      'heading'     => 'Custom Content',
      'param_name'  => 'content',
      'group'       => 'Extras',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  )
) );


// ==========================================================================================
// CS CAROUSEL CONTENTS
// ==========================================================================================
vc_map( array(
  'name'                    => 'Carousel Contents',
  'base'                    => 'cs_carousel',
  'icon'                    => 'fa fa-exchange',
  'description'             => 'Create some carousel contents',
  'category'                => 'Route Theme',
  'params'                  => array(
    array(
      'type'                => 'textfield',
      'heading'             => 'Min Items',
      'param_name'          => 'min',
      'value'               => 1,
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Max Items',
      'param_name'          => 'max',
      'value'               => 4,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Items Width',
      'param_name'  => 'items_width',
      'value'       => 225,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Items Per Scroll',
      'param_name'  => 'items_scroll',
      'value'       => 1,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Autoplay Delay',
      'param_name'  => 'delay',
      'value'       => 3,
    ),

    // Extras
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'No Items Padding',
      'param_name'  => 'no_padding',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'No MouseWheel',
      'param_name'  => 'no_mousewheel',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'No Swipe',
      'param_name'  => 'no_swipe',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'No Autoplay',
      'param_name'  => 'no_autoplay',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'No Navigation',
      'param_name'  => 'no_nav',
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Move Nav Bottom',
      'param_name'  => 'nav_bottom',
      'dependency'  => array( 'element' => 'no_nav', 'is_empty' => true ),
      'group'       => 'Extras',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Navigation Position',
      'param_name'  => 'nav_pos',
      'value'       => array(
        'Center'    => 'center',
        'Left'      => 'left',
        'Right'     => 'right',
        'Fluid'     => 'fluid',
      ),
      'dependency'  => array( 'element' => 'no_nav', 'is_empty' => true ),
      'group'       => 'Extras',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  ),
  'as_parent'       => array('only' => 'cs_carousel_item'),
  'js_view'         => 'CSCarouselView',
) );

vc_map( array(
  'name'            => 'Carousel Content',
  'base'            => 'cs_carousel_item',
  'label_class'     => 'success',
  'category'        => 'Route Theme',
  'as_child'        => array('only' => 'cs_carousel'),
  'is_container'    => true,
  'content_element' => false,
  'js_view'         => 'VcColumnView',
) );




// ==========================================================================================
// CS FAQ
// ==========================================================================================
$faq_unique_id_1 = time() . '-1-' . rand( 0, 100 );
$faq_unique_id_2 = time() . '-2-' . rand( 0, 100 );
$faq_unique_id_3 = time() . '-3-' . rand( 0, 100 );

vc_map( array(
  'name'                    => 'FAQ',
  'base'                    => 'cs_faq',
  'icon'                    => 'fa fa-question-circle',
  'description'             => 'Create a faq',
  'class'                   => 'wpb_vc_tabs',
  'is_container'            => true,
  'show_settings_on_create' => false,
  'category'                => 'Route Theme',
  'params'                  => $vc_map_defaults,
  'custom_markup'           => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children"><ul class="tabs_controls"></ul>%content%</div>',
  'default_content'         => '
    [cs_faq_block title="FAQ 1" tab_id="' . $faq_unique_id_1 . '"][vc_toggle title="Question"]Answer[/vc_toggle][/cs_faq_block]
    [cs_faq_block title="FAQ 2" tab_id="' . $faq_unique_id_2 . '"][vc_toggle title="Question"]Answer[/vc_toggle][/cs_faq_block]
    [cs_faq_block title="FAQ 3" tab_id="' . $faq_unique_id_3 . '"][vc_toggle title="Question"]Answer[/vc_toggle][/cs_faq_block]',
  'js_view'                 => 'CSFAQSView'
) );


// ==========================================================================================
// CS FAQ BLOCK
// ==========================================================================================
vc_map( array(
  'name'                      => 'FAQ Block',
  'base'                      => 'cs_faq_block',
  'allowed_container_element' => 'vc_row',
  'as_parent'                 => array('only' => 'vc_toggle'),
  'is_container'              => true,
  'content_element'           => false,
  'category'                  => 'Route Theme',
  'params'                    => array(
    array(
      'type'                  => 'tab_id',
      'heading'               => 'Tab Unique ID',
      'param_name'            => 'tab_id'
    ),
    array(
      'type'                  => 'textfield',
      'heading'               => 'Title',
      'param_name'            => 'title',
    ),
  ),
  'js_view'                   => 'CSFAQView'
) );



// ==========================================================================================
// CS Google Map
// ==========================================================================================
vc_map( array(
  'name'            => 'Google Map',
  'base'            => 'cs_gmap',
  'icon'            => 'fa fa-map-marker',
  'description'     => 'Create a google map',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'                => 'textfield',
      'heading'             => 'Latitude',
      'param_name'          => 'latitude',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Longitude',
      'param_name'          => 'longitude',
      'edit_field_class'    => 'vc_col-md-6 vc_column vc_no_top_padding',
    ),
    array(
      'type'                => 'dropdown',
      'heading'             => 'Map Type',
      'param_name'          => 'map_type',
      'value'               => array(
        'roadmap'     => 'roadmap',
        'terrain'     => 'terrain',
        'satellite'   => 'satellite',
        'hybrid'      => 'hybrid',
      ),
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Zoom Level',
      'param_name'          => 'zoom',
      'value'               => 15,
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Map Static-Height',
      'param_name'          => 'height',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'Disable Zoom Control',
      'param_name'          => 'no_zoom',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'No Bordered',
      'param_name'          => 'no_border',
    ),
    array(
      'type'                => 'vc_cs_on_off',
      'heading'             => 'Disable Scrollwheel',
      'param_name'          => 'no_scrollwheel',
    ),
    array(
      'type'                => 'vc_cs_upload',
      'heading'             => 'Marker Icon',
      'param_name'          => 'icon',
      'group'               => 'Map Markers',
    ),
    array(
      'type'                => 'vc_cs_exploded_textarea',
      'heading'             => 'Markers',
      'param_name'          => 'markers',
      'group'               => 'Map Markers',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  ),
) );

// ==========================================================================================
// CS RESPONSIVE IMAGE
// ==========================================================================================
vc_map( array(
  'name'            => 'Responsive Single Image',
  'base'            => 'cs_responsive_image',
  'icon'            => 'fa fa-image',
  'description'     => 'Create a responsive single image',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'attach_image',
      'heading'     => 'Images',
      'param_name'  => 'image',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Image Size',
      'param_name'  => 'size',
      'value'       => cs_get_image_sizes( true ),
      'std'         => 'full',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Alignment',
      'param_name'  => 'alignment',
      'value'       => array(
        'None'    => '',
        'Left'    => 'alignleft',
        'Right'   => 'alignright',
        'Center'  => 'aligncenter',
      ),
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Image Border',
      'param_name'  => 'border',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Image Border Radius',
      'param_name'  => 'radius',
    ),

    // animation
    $vc_map_animation,
    $vc_map_animation_delay,
    $vc_map_animation_duration,

    // link
    array(
      'type'        => 'textfield',
      'heading'     => 'Image Link',
      'param_name'  => 'href',
      'group'       => 'Link'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Link Target',
      'param_name'  => 'target',
      'value'       => array(
        '_self'     => '',
        '_blank'    => '_blank',
      ),
      'group'       => 'Link'
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Link open with Lightbox',
      'param_name'  => 'lightbox',
      'group'       => 'Link'
    ),

    // extras
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,
  ),
) );


// ==========================================================================================
// CS RESPONSIVE SLIDER
// ==========================================================================================
vc_map( array(
  'name'            => 'Responsive Slider or Gallery',
  'base'            => 'cs_responsive_slider',
  'icon'            => 'fa fa-image',
  'description'     => 'Create a responsive slider',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'attach_images',
      'heading'     => 'Images',
      'param_name'  => 'ids',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Type',
      'param_name'  => 'cstype',
      'value'       => array(
        'Slideshow'               => 'slideshow',
        'Gallery with Thumbnails' => 'gallery_thumb',
        'Gallery visibleNearby'   => 'gallery_nearby',
        'Gallery with Lightbox'   => 'gallery_lightbox',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Image Scale',
      'param_name'  => 'scale',
      'value'       => array(
        'Default'         => '',
        'Fill'            => 'fill',
        'Fit'             => 'fit',
        'Fit if smaller'  => 'fit-if-smaller',
        'None'            => 'none',
      ),
      'dependency'  => array( 'element' => 'cstype', 'value' => array( 'slideshow', 'gallery_thumb', 'gallery_nearby' ) ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Image Size',
      'param_name'  => 'size',
      'value'       => cs_get_image_sizes( true ),
      'std'         => 'large',
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Width (optional)',
      'param_name'          => 'width',
      'placeholder'         => 850,
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'dependency'          => array( 'element' => 'cstype', 'value' => array( 'slideshow', 'gallery_thumb', 'gallery_nearby' ) ),
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Height (optional)',
      'param_name'          => 'height',
      'placeholder'         => 400,
      'edit_field_class'    => 'vc_col-md-6 vc_column',
      'dependency'          => array( 'element' => 'cstype', 'value' => array( 'slideshow', 'gallery_thumb', 'gallery_nearby' ) ),
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Columns (optional)',
      'param_name'          => 'columns',
      'placeholder'         => 3,
      'dependency'          => array( 'element' => 'cstype', 'value' => array( 'gallery_lightbox' ) ),
    ),

    // extra settings
    array(
      'type'        => 'vc_cs_content',
      'param_name'  => 'notice-responsive-slider',
      'content'     => '<p class="cs-alert cs-alert-info">This settings is <strong>optional</strong>.</p>',
      'group'       => 'Extra Settings',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Border',
      'param_name'  => 'border',
      'group'       => 'Extra Settings',
    ),
    array(
      'type'        => 'vc_cs_textfield',
      'heading'     => 'Autoplay',
      'param_name'  => 'autoplay',
      'placeholder' => '5000 = 5ms for each slide',
      'group'       => 'Extra Settings',
    ),
    array(
      'type'        => 'vc_cs_textfield',
      'heading'     => 'Transition',
      'param_name'  => 'transition',
      'placeholder' => 'move or fade',
      'group'       => 'Extra Settings',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Loop Slides',
      'param_name'  => 'loop',
      'group'       => 'Extra Settings',
    ),

    // extras
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,
  ),
) );

// ==========================================================================================
// CS RESPONSIVE VIDEO
// ==========================================================================================
vc_map( array(
  'name'            => 'Responsive Video',
  'base'            => 'cs_responsive_video',
  'icon'            => 'fa fa-video-camera',
  'description'     => 'Create a responsive video iframe',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'                => 'textarea',
      'heading'             => 'Paste an external video url or iframe code',
      'param_name'          => 'content',
      'param_holder_class'  => 'cs-large-textarea',
      'description'         => 'You can use directly youtube, vimeo and more about supported formats at <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Aspect Radio',
      'param_name'  => 'radio',
      'value'       => '16:9',
      'description' => 'Aspect Radios "1:1", "3:1", "3:2", "4:3", "5:4", "5:3" or you know',
    ),

    // Self-Hosted Video
    array(
      'type'        => 'vc_cs_upload',
      'heading'     => 'Video/mp4',
      'param_name'  => 'mp4',
      'settings'    => array(
        'upload_type'   => 'video',
        'insert_title'  => 'Use This Video',
        'button_title'  => 'Upload / MP4',
      ),
      'group'       => 'Use Self-Hosted Video',
    ),
    array(
      'type'        => 'vc_cs_upload',
      'heading'     => 'Video/ogv',
      'param_name'  => 'ogv',
      'settings'    => array(
        'upload_type'   => 'video',
        'insert_title'  => 'Use This Video',
        'button_title'  => 'Upload / OGV',
      ),
      'group'       => 'Use Self-Hosted Video',
    ),
    array(
      'type'        => 'vc_cs_upload',
      'heading'     => 'Video/webm',
      'param_name'  => 'webm',
      'settings'    => array(
        'upload_type'   => 'video',
        'insert_title'  => 'Use This Video',
        'button_title'  => 'Upload / WEBM',
      ),
      'group'       => 'Use Self-Hosted Video',
    ),
    array(
      'type'        => 'vc_cs_upload',
      'heading'     => 'Poster',
      'param_name'  => 'poster',
      'settings'    => array(
        'upload_type'   => 'image',
        'insert_title'  => 'Use This Poster',
        'button_title'  => 'Upload Poster',
      ),
      'group'       => 'Use Self-Hosted Video',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Autoplay',
      'param_name'  => 'autoplay',
      'group'       => 'Use Self-Hosted Video',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Loop',
      'param_name'  => 'loop',
      'group'       => 'Use Self-Hosted Video',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  ),
) );

// ==========================================================================================
// CS COUNTDOWN
// ==========================================================================================
vc_map( array(
  'name'            => 'Countdown',
  'base'            => 'cs_countdown',
  'icon'            => 'fa fa-arrow-circle-o-down',
  'description'     => 'Create a countdown date',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Count Type ( down or up )',
      'param_name'  => 'count',
      'value'       => array(
        'down' => 'down',
        'up'   => 'up',
      ),
    ),
    array(
      'type'        => 'vc_cs_content',
      'param_name'  => 'notice-countdown-format',
      'content'     => '<p class="cs-alert cs-alert-info">Yeah, You choose countup, be sure for date. you must write a older date. eg for 1 day ago. <strong>'. date( 'M d Y', strtotime('-1 days') ) .'</strong></p>',
      'dependency'  => array( 'element' => 'count', 'value' => array( 'up' ) ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Date',
      'param_name'  => 'date',
      'value'       => date( 'M d Y' ),
      'description' => 'Currently value is today, change date, write your own upcoming date',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Format',
      'param_name'  => 'format',
      'value'       => 'yowdhms',
    ),
    array(
      'type'        => 'vc_cs_content',
      'param_name'  => 'notice-countup',
      'content'     => '
      <p class="cs-alert cs-alert-info">
        <strong>y</strong>: year <strong>o</strong>: month <strong>w</strong>: week <strong>d</strong>: day <strong>h</strong>: hour <strong>m</strong>: minuites <strong>s</strong>: second<br /><br />
        if you write <strong>YOWDHMS</strong> as uppercase this is mean optional if there is year it will show else hide.<br />
        Eg. Formats: <strong>dhms</strong> or <strong>wdh</strong> or <strong>od</strong> you know...
      </p>',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Layout',
      'param_name'  => 'layout',
      'value'       => array(
        'boxed'     => 'boxed',
        'line'      => 'line',
        'normal'    => 'normal',
      ),
    ),

    // Custom Colors
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Text Color',
      'param_name'  => 'color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'vc_cs_color_picker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
    $vc_map_extra_style,

  ),
) );



// ==========================================================================================
// CS TEAM
// ==========================================================================================
vc_map( array(
  'name'                    => 'Team',
  'base'                    => 'cs_team',
  'icon'                    => 'fa fa-users',
  'description'             => 'Create a team',
  'show_settings_on_create' => false,
  'category'                => 'Route Theme',
  'params'                  => array(
    $vc_map_id,
    $vc_map_class,
    $vc_map_style,
  ),
  'as_parent'               => array(
    'only'                  => 'cs_team_member'
  ),
  'js_view'                 => 'VcColumnView',
) );

vc_map( array(
  'name'                    => 'Team Member',
  'base'                    => 'cs_team_member',
  'icon'                    => 'fa fa-user',
  'description'             => 'Create a member',
  'as_child'                => array(
    'only'                  => 'cs_team'
  ),
  'category'                => 'Route Theme',
  'params'                  => array(
    array(
      'type'                => 'vc_cs_upload',
      'heading'             => 'Image',
      'param_name'          => 'image',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Member Name',
      'param_name'          => 'name',
    ),
    array(
      'type'                => 'textfield',
      'heading'             => 'Member Title / Role',
      'param_name'          => 'role',
    ),
    array(
      'type'                => 'textarea',
      'heading'             => 'About Member',
      'param_name'          => 'content',
      'param_holder_class'  => 'cs-large-textarea',
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Mail',
      'param_name'          => 'mail',
      'placeholder'         => 'info@domain.com',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Facebook',
      'param_name'          => 'facebook',
      'placeholder'         => 'Facebook URL',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Twitter',
      'param_name'          => 'twitter',
      'placeholder'         => 'Twitter URL',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Linkedin',
      'param_name'          => 'linkedin',
      'placeholder'         => 'LinkedIn URL',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Google+',
      'param_name'          => 'google_plus',
      'placeholder'         => 'Google Plus URL',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Tumblr',
      'param_name'          => 'tumblr',
      'placeholder'         => 'Tumblr URL',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Youtube',
      'param_name'          => 'youtube',
      'placeholder'         => 'Youtube URL',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'                => 'vc_cs_textfield',
      'heading'             => 'Vimeo',
      'param_name'          => 'vimeo',
      'placeholder'         => 'Vimeo URL',
      'edit_field_class'    => 'vc_col-md-6 vc_column',
    ),
    array(
      'type'                => 'exploded_textarea',
      'heading'             => 'Extra Social Networks',
      'param_name'          => 'extra_social',
      'description'         => 'Example Usage:<br/>fa fa-github|Github|https://github.com/envato<br/>fa fa-lastfm|Last.fm|http://www.last.fm/music/Envato',
    ),
  )
) );

// ==========================================================================================
// CS WIDGET SIDEBAR
// ==========================================================================================
vc_map( array(
  'name'          => 'Widgetised Sidebar',
  'base'          => 'cs_widget_sidebar',
  'icon'          => 'fa fa-indent',
  'description'   => 'Place widgetised sidebar',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'        => 'widgetised_sidebars',
      'heading'     => 'Sidebar',
      'param_name'  => 'sidebar_id',
      'description' => 'Select which widget area output.',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra class name',
      'param_name'  => 'class',
      'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.',
    )
  )
) );


// ==========================================================================================
// CS PRE CODE
// ==========================================================================================
vc_map( array(
  'name'            => 'Pre/Code',
  'base'            => 'cs_precode',
  'icon'            => 'fa fa-code',
  'description'     => 'Create a pre and code',
  'category'        => 'Route Theme',
  'params'          => array(
    array(
      'holder'      => 'div',
      'type'        => 'textarea_raw_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Max Height',
      'param_name'  => 'max_height',
    ),
    array(
      'type'        => 'vc_cs_on_off',
      'heading'     => 'Enable Horizotal Scroll',
      'param_name'  => 'scroll_horz',
    ),
  )
) );

// ==========================================================================================
// CS RAW HTML
// ==========================================================================================
vc_map( array(
  'name'          => 'Raw HTML',
  'base'          => 'cs_raw_html',
  'icon'          => 'fa fa-code',
  'description'   => 'Output raw html code on your page',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'        => 'textarea_raw_html',
      'holder'      => 'div',
      'heading'     => 'Raw HTML',
      'param_name'  => 'content',
      'value'       => base64_encode( '<p>I am raw html block.<br/>Click edit button to change this html</p>' ),
      'description' => 'Enter your HTML content.',
    ),
  )
) );

// ==========================================================================================
// CS RAW JS
// ==========================================================================================
vc_map( array(
  'name'          => 'Raw JS',
  'base'          => 'cs_raw_js',
  'icon'          => 'fa fa-code',
  'description'   => 'Output raw html code on your page',
  'category'      => 'Route Theme',
  'params'        => array(
    array(
      'type'        => 'textarea_raw_html',
      'holder'      => 'div',
      'heading'     => 'Raw JS',
      'param_name'  => 'content',
      'value'       => base64_encode( '<script type="text/javascript"> alert("Enter your js here!" ); </script>' ),
      'description' => 'Enter your JS content.',
    ),
  )
) );

// ==========================================================================================
// CS CLEAR
// ==========================================================================================
vc_map( array(
  'name'                    => 'Clear',
  'base'                    => 'cs_clear',
  'icon'                    => 'fa fa-arrows-h',
  'description'             => 'Clear floated blocks in content',
  'show_settings_on_create' => false,
  'category'                => 'Route Theme',
  'params'                  => $vc_map_defaults,
) );