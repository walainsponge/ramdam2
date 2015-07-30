<?php
/**
 *
 * CSFramework Shortcode Config
 * @since 1.0.0
 * @version 1.0.0
 *
 */
$cs_animation_names = cs_get_animations();
$cs_animations      = array();
foreach ($cs_animation_names as $key => $value) {
  $cs_animations[$value] = $value; 
}

// Animation
// ------------------------------------------------------------------------------------------
$cs_map_animation          = array(
  'id'                     => 'animation',
  'type'                   => 'select',
  'title'                  => 'Animation',
  'options'                => $cs_animations,
);

$cs_map_animation_delay    = array(
  'id'                     => 'animation_delay',
  'type'                   => 'text',
  'title'                  => 'Animation Delay',
  'attributes'             => array( 'placeholder' => 0.1 ),
  'dependency'             => array('animation', '!=', ''),
);

$cs_map_animation_duration = array(
  'id'                     => 'animation_duration',
  'type'                   => 'text',
  'title'                  => 'Animation Duration',
  'attributes'             => array( 'placeholder' => 0.1 ),
  'dependency'             => array('animation', '!=', ''),
);

// Extras
// ------------------------------------------------------------------------------------------
$cs_map_id                 = array(
  'id'                     => 'id',
  'type'                   => 'text',
  'title'                  => 'ID <em>(Optional)</em>',
);
$cs_map_class              = array(
  'id'                     => 'class',
  'type'                   => 'text',
  'title'                  => 'Class <em>(Optional)</em>',
);
$cs_map_style              = array(
  'id'                     => 'in_style',
  'type'                   => 'text',
  'title'                  => 'Inline Style <em>(Optional)</em>',
);
$cs_map_content            = array(
  'id'                     => 'content',
  'type'                   => 'textarea',
  'title'                  => 'Content',
);

$cs_shortcodes                   = array(

  'helpers'                      => array(
    'title'                      => 'Quick Helpers',
    'shortcodes'                 => array(

      //                         ==========================================
      // SPACE
      //                         ==========================================
      'cs_space'                 => array(
        'title'                  => 'Space',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'size',
            'type'               => 'text',
            'title'              => 'Size',
            'info'               => 'Eg. 100px 10em -25px 25% etc...',
          ),
        ),
      ),

      //                         ==========================================
      // CLEAR
      //                         ==========================================
      'cs_clear'                 => array(
        'title'                  => 'Clear',
        'view'                   => 'single',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'clear',
            'type'               => 'content',
            'content'            => '<p class="cs-alert cs-alert-info">Clear floated blocks in content, Just click insert shortcode</p>',
          )
        ),
      ),

      //                         ==========================================
      // DIVIDER
      //                         ==========================================
      'cs_divider'               => array(
        'title'                  => 'Divider',
        'view'                   => 'single',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'type',
            'type'               => 'select', 
            'title'              => 'Type',
            'options'            => array(
              ''                 => 'Solid',
              'dashed'           => 'Dashed',
              'dotted'           => 'Dotted',
              'double'           => 'Double',
              'solid-dashed'     => 'Solid Dashed',
              'dashed-solid'     => 'Dashed Solid',
            ),
          ),
          array(
            'id'                 => 'color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Border Color',
          ),
          array(
            'id'                 => 'width',
            'type'               => 'select', 
            'title'              => 'Width',
            'options'            => array(
              ''                 => '100%',
              '75%'              => '75%',
              '50%'              => '50%',
              '25%'              => '25%',
              '10%'              => '10%',
              '5%'               => '5%',
              'custom'           => 'custom',
            ),
          ),
          array(
            'id'                 => 'custom_width',
            'type'               => 'text', 
            'title'              => 'Custom Width',
            'dependency'         => array('width', '==', 'custom'),
          ),
          array(
            'id'                 => 'align',
            'type'               => 'select', 
            'title'              => 'Align',
            'options'            => array(
              ''                 => 'Select align',
              'left'             => 'Left',
              'center'           => 'Center',
              'right'            => 'right',
            ),
          ),
          array(
            'id'                 => 'margin',
            'type'               => 'select', 
            'title'              => 'Margin (spacing)',
            'options'            => array(
              ''                 => 'Small',
              'xs'               => 'X Small',
              'md'               => 'Medium',
              'lg'               => 'Large',
              'xl'               => 'X Large',
              'custom'           => 'Custom',
            ),
          ),
          array(
            'id'                 => 'margin_top',
            'type'               => 'text', 
            'title'              => 'Margin Top',
            'dependency'         => array('margin', '==', 'custom'),
          ),
          array(
            'id'                 => 'margin_bottom',
            'type'               => 'text', 
            'title'              => 'Margin Bottom',
            'dependency'         => array('margin', '==', 'custom'),
          ),
        ),
      ),

      //                         ==========================================
      // DIVIDER WITH ICON
      //                         ==========================================
      'cs_divider_icon'          => array(
        'title'                  => 'Divider with Icon',
        'shortcode_atts'         => array(

          array(
            'id'                 => 'icon',
            'type'               => 'icon', 
            'title'              => 'Icon',
          ),
          array(
            'id'                 => 'text',
            'type'               => 'text', 
            'title'              => 'Text',
          ),
          array(
            'id'                 => 'align',
            'type'               => 'select', 
            'title'              => 'Icon & Text Align',
            'options'            => array(
              ''                 => 'Select align',
              'left'             => 'Left',
              'center'           => 'Center',
              'right'            => 'right',
            ),
          ),
          array(
            'id'                 => 'size',
            'type'               => 'text', 
            'title'              => 'Icon & Text Size',
          ),
          array(
            'id'                 => 'color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon & Text Color',
          ),
          array(
            'id'                 => 'border_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Border Color',
          ),
          array(
            'id'                 => 'border_type',
            'type'               => 'select', 
            'title'              => 'Border Type',
            'options'            => array(
              ''                 => 'Solid',
              'dashed'           => 'Dashed',
              'dotted'           => 'Dotted',
              'double'           => 'Double',
            ),
          ),
          array(
            'id'                 => 'width',
            'type'               => 'select', 
            'title'              => 'Width',
            'options'            => array(
              ''                 => '100%',
              '75%'              => '75%',
              '50%'              => '50%',
              '25%'              => '25%',
              '10%'              => '10%',
              '5%'               => '5%',
              'custom'           => 'custom',
            ),
          ),
          array(
            'id'                 => 'custom_width',
            'type'               => 'text', 
            'title'              => 'Custom Width',
            'dependency'         => array('width', '==', 'custom'),
          ),
          array(
            'id'                 => 'margin',
            'type'               => 'select', 
            'title'              => 'Margin (spacing)',
            'options'            => array(
              ''                 => 'Small',
              'xs'               => 'X Small',
              'md'               => 'Medium',
              'lg'               => 'Large',
              'xl'               => 'X Large',
              'custom'           => 'Custom',
            ),
          ),
          array(
            'id'                 => 'margin_top',
            'type'               => 'text', 
            'title'              => 'Margin Top',
            'dependency'         => array('margin', '==', 'custom'),
          ),
          array(
            'id'                 => 'margin_bottom',
            'type'               => 'text', 
            'title'              => 'Margin Bottom',
            'dependency'         => array('margin', '==', 'custom'),
          ),
          array(
            'id'                 => 'no_space',
            'type'               => 'on_off', 
            'title'              => 'No Border Space',
          ),
          $cs_map_content,
        ),
      ),

      //                         ==========================================
      // ALERT
      //                         ==========================================
      'cs_alert'                 => array(
        'title'                  => 'Alert',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'type',
            'type'               => 'select', 
            'title'              => 'Type',
            'options'            => array(
              'success'          => 'Success',
              'info'             => 'Info',
              'warning'          => 'Warning',
              'danger'           => 'Danger',
              'note'             => 'Note',
            ),
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon',
            'title'              => 'Icon',
          ),
          array(
            'id'                 => 'outlined',
            'type'               => 'on_off', 
            'title'              => 'Outlined',
          ),
          array(
            'id'                 => 'close',
            'type'               => 'on_off', 
            'title'              => 'Close Button',
          ),
          array(
            'id'                 => 'bgcolor',
            'type'               => 'color_picker', 
            'title'              => 'Custom Background Color',
          ),
          array(
            'id'                 => 'border_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Border Color',
          ),
          array(
            'id'                 => 'text_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Text Color',
          ),
          $cs_map_animation,
          $cs_map_animation_delay,
          $cs_map_animation_duration,

          $cs_map_content,
        ),
      ),

      //                         ==========================================
      // DROPCAP
      //                         ==========================================
      'cs_dropcap'               => array(
        'title'                  => 'Dropcap',
        'view'                   => 'single',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'word',
            'type'               => 'text', 
            'title'              => 'Word(s)',
          ),
          array(
            'id'                 => 'size',
            'type'               => 'text', 
            'title'              => 'Word Size',
          ),
          array(
            'id'                 => 'color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Text Color',
          ),
          array(
            'id'                 => 'bgcolor',
            'type'               => 'color_picker', 
            'title'              => 'Custom Background Color',
          ),
          array(
            'id'                 => 'shape',
            'type'               => 'select', 
            'title'              => 'Background Shape',
            'options'            => array(
              ''                 => 'Square',
              'rounded'          => 'Rounded',
              'circle'           => 'Circle',
            ),
          ),
        ),
      ),

      //                         ==========================================
      // SINGLE RESPONSIVE IMAGE
      //                         ==========================================
      'cs_responsive_image'      => array(
        'title'                  => 'Responsive Single Image',
        'view'                   => 'single',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'image',
            'type'               => 'upload', 
            'title'              => 'Upload',
          ),
          array(
            'id'                 => 'size',
            'type'               => 'select', 
            'title'              => 'Image Size',
            'options'            => array_flip( cs_get_image_sizes( true ) ),
            'default'            => 'full',
          ),
          array(
            'id'                 => 'alignment',
            'type'               => 'select', 
            'title'              => 'Alignment',
            'options'            => array(
              ''                 => 'None',
              'alignleft'        => 'Left',
              'alignright'       => 'Right',
              'aligncenter'      => 'Center',
            ),
          ),
          array(
            'id'                 => 'border',
            'type'               => 'on_off', 
            'title'              => 'Image Border',
          ),
          array(
            'id'                 => 'radius',
            'type'               => 'on_off', 
            'title'              => 'Image Border Radius',
          ),

          $cs_map_animation,
          $cs_map_animation_delay,
          $cs_map_animation_duration,

          array(
            'id'                 => 'href',
            'type'               => 'text', 
            'title'              => 'Image Link',
          ),
          array(
            'id'                 => 'target',
            'type'               => 'select', 
            'title'              => 'Link Target',
            'options'            => array(
              ''                 => '_self',
              '_blank'           => '_blank',
            ),
          ),
          array(
            'id'                 => 'lightbox',
            'type'               => 'on_off', 
            'title'              => 'Link open with Lightbox',
          ),
        ),
      ),

      //                         ==========================================
      // RESPONSIVE VIDEO
      //                         ==========================================
      'cs_responsive_video'      => array(
        'title'                  => 'Responsive Video',
        'view'                   => 'single',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'radio',
            'type'               => 'text', 
            'title'              => 'Aspect Radio',
            'default'            => '16:9',
            'info'               => 'Aspect Radios "1:1", "3:1", "3:2", "4:3", "5:4", "5:3" or you know'
          ),
          array(
            'id'                 => 'mp4',
            'type'               => 'upload', 
            'title'              => 'Video/mp4',
            'settings'           => array(
              'upload_type'      => 'video',
              'insert_title'     => 'Use this Video',
              'button_title'     => 'Upload(mp4)',
            ),
          ),
          array(
            'id'                 => 'ogv',
            'type'               => 'upload', 
            'title'              => 'Video/ogv',
            'settings'           => array(
              'upload_type'      => 'video',
              'insert_title'     => 'Use this Video',
              'button_title'     => 'Upload(ogv)',
            ),
          ),
          array(
            'id'                 => 'webm',
            'type'               => 'upload', 
            'title'              => 'Video/webm',
            'settings'           => array(
              'upload_type'      => 'video',
              'insert_title'     => 'Use this Video',
              'button_title'     => 'Upload(webm)',
            ),
          ),
          array(
            'id'                 => 'poster',
            'type'               => 'upload', 
            'title'              => 'Poster',
          ),
          array(
            'id'                 => 'autoplay',
            'type'               => 'on_off', 
            'title'              => 'Autoplay',
          ),
          array(
            'id'                 => 'loop',
            'type'               => 'on_off', 
            'title'              => 'Loop',
          ),
          array(
            'id'                 => 'explain-video', 
            'type'               => 'content', 
            'content'            => '<p class="cs-alert cs-alert-success"> Use Self-Hosted video Or embed External URL or IFRAME</p>',
          ),
          array(
            'id'                 => 'content',
            'type'               => 'textarea', 
            'title'              => 'URL or IFRAME code',
            'attributes'         => array(
              'rows'             => 10,
            )
          ),
        ),
      ),

    ),
  ),

  'useful'                       => array(
    'title'                      => 'Usefuls',
    'shortcodes'                 => array(

      //                         ==========================================
      // TABS
      //                         ==========================================
      'vc_tabs'                  => array(
        'title'                  => 'Tabs',
        'view'                   => 'flexible',
        'clone_id'               => 'vc_tab',
        'clone_title'            => 'Add New Tab',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'type',
            'type'               => 'select',
            'title'              => 'Tab Nav Block',
            'options'            => array(
              'default'          => 'Default',
              'left'             => 'Left',
              'right'            => 'Right',
            ),
          ),
          array(
            'id'                 => 'center',
            'type'               => 'on_off',
            'title'              => 'Tab Nav Center',
            'dependency'         => array('type', '==', 'default'),
          ),
          array(
            'id'                 => 'fit',
            'type'               => 'on_off',
            'title'              => 'Tab Nav Fit',
            'dependency'         => array('type', '==', 'default'),
          ),
          array(
            'id'                 => 'color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Color',
          ),
          array(
            'id'                 => 'active',
            'type'               => 'text', 
            'title'              => 'Active Tab Nav',
            'info'               => 'You can active any tab as default. Eg. 1 or 2 or 3'
          ),
        ),
        'multiple_atts'          => array(
          array(
            'id'                 => 'title',
            'type'               => 'text',
            'title'              => 'Tab Title',
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon', 
            'title'              => 'Tab Icon',
          ),
          $cs_map_content
        )
      ),

      //                         ==========================================
      // ACCORDION
      //                         ==========================================
      'vc_accordion'             => array(
        'title'                  => 'Accordion',
        'view'                   => 'flexible',
        'clone_id'               => 'vc_accordion',
        'clone_title'            => 'Add New Accordion',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'active_tab',
            'type'               => 'text', 
            'title'              => 'Active Tab',
          ),
          array(
            'id'                 => 'no_icons',
            'type'               => 'on_off',
            'title'              => 'No section icons',
          ),
          array(
            'id'                 => 'icon_color',
            'type'               => 'color_picker', 
            'title'              => 'Icons Colors',
          ),
          array(
            'id'                 => 'title_color',
            'type'               => 'color_picker', 
            'title'              => 'Title Colors',
          ),
          array(
            'id'                 => 'border_color',
            'type'               => 'color_picker', 
            'title'              => 'Border Colors',
          ),
        ),
        'multiple_atts'          => array(
          array(
            'id'                 => 'title',
            'type'               => 'text',
            'title'              => 'Accordion Title',
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon', 
            'title'              => 'Accordion Icon',
          ),
          $cs_map_content
        )
      ),

      //                         ==========================================
      // TOGGLE
      //                         ==========================================
      'vc_toggle'                => array(
        'title'                  => 'Toggle',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'title',
            'type'               => 'text',
            'title'              => 'Title',
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon',
            'title'              => 'Custom icon',
          ),
          array(
            'id'                 => 'open',
            'type'               => 'select', 
            'title'              => 'Default state',
            'options'            => array(
              ''                 => 'Closed',
              1                  => 'Open',
            ),
          ),
          array(
            'id'                 => 'no_icon',
            'type'               => 'on_off',
            'title'              => 'No any icon',
          ),
          array(
            'id'                 => 'icon_color',
            'type'               => 'color_picker', 
            'title'              => 'Icons Colors',
          ),
          array(
            'id'                 => 'title_color',
            'type'               => 'color_picker', 
            'title'              => 'Title Colors',
          ),
          array(
            'id'                 => 'border_color',
            'type'               => 'color_picker', 
            'title'              => 'Border Colors',
          ),
          $cs_map_content,
        ),
      ),

      //                         ==========================================
      // BUTTON
      //                         ==========================================
      'cs_button'                => array(
        'title'                  => 'Button',
        'shortcode_atts'         => array(

          array(
            'id'                 => 'href',
            'type'               => 'text', 
            'title'              => 'Link',
          ),
          array(
            'id'                 => 'target',
            'type'               => 'select', 
            'title'              => 'Target',
            'options'            => array(
              ''                 => '_self',
              '_blank'           => '_blank',
            ),
            'dependency'         => array('href', '!=', ''),
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon',
            'title'              => 'Icon',
          ),
          array(
            'id'                 => 'type',
            'type'               => 'select', 
            'title'              => 'Type',
            'options'            => array(
              'flat'             => 'Flat',
              'outlined'         => 'Outlined',
              '3d'               => '3D',
            ),
          ),
          array(
            'id'                 => 'shape',
            'type'               => 'select', 
            'title'              => 'Shape',
            'options'            => array(
              'square'           => 'Square',
              'rounded'          => 'Rounded',
              'pill'             => 'Pill',
              'circle'           => 'Circle',
            ),
          ),
          array(
            'id'                 => 'size',
            'type'               => 'select', 
            'title'              => 'Size',
            'options'            => array(
              'xxs'              => 'X Small',
              'xs'               => 'Small',
              'sm'               => 'Pill',
              'md'               => 'Medium',
              'lg'               => 'Large',
              'xl'               => 'X Large',
              'xxl'              => 'XX Large',
            ),
          ),
          array(
            'id'                 => 'color',
            'type'               => 'select', 
            'title'              => 'Color',
            'options'            => array(
              'accent'           => 'Accent',
              'blue'             => 'Blue',
              'green'            => 'Green',
              'red'              => 'Red',
              'yellow'           => 'Yellow',
              'black'            => 'Black',
              'white'            => 'White',
            ),
          ),
          array(
            'id'                 => 'align',
            'type'               => 'select', 
            'title'              => 'Align',
            'options'            => array(
              ''                 => 'Select align',
              'left'             => 'Left',
              'center'           => 'Center',
              'right'            => 'Right',
            ),
          ),

          array(
            'id'                 => 'block',
            'type'               => 'on_off', 
            'title'              => 'Full Block Button',
          ),
          array(
            'id'                 => 'textshadow',
            'type'               => 'on_off', 
            'title'              => 'Text Shadow',
          ),
          array(
            'id'                 => 'no_uppercase',
            'type'               => 'on_off', 
            'title'              => 'No Text Uppercase',
          ),
          array(
            'id'                 => 'no_bold',
            'type'               => 'on_off', 
            'title'              => 'No Text Bold',
          ),
          array(
            'id'                 => 'no_transition',
            'type'               => 'on_off', 
            'title'              => 'No Transition',
          ),

          array(
            'id'                 => 'bgcolor',
            'type'               => 'color_picker', 
            'title'              => 'Background Color',
          ),
          array(
            'id'                 => 'bghovercolor',
            'type'               => 'color_picker', 
            'title'              => 'Background Hover Color',
          ),
          array(
            'id'                 => 'textcolor',
            'type'               => 'color_picker', 
            'title'              => 'Text Color',
          ),
          array(
            'id'                 => 'texthovercolor',
            'type'               => 'color_picker', 
            'title'              => 'Text Hover Color',
          ),
          array(
            'id'                 => 'bordercolor',
            'type'               => 'color_picker', 
            'title'              => 'Border Color',
          ),
          array(
            'id'                 => 'borderhovercolor',
            'type'               => 'color_picker', 
            'title'              => 'Border Hover Color',
          ),

          $cs_map_id,
          $cs_map_class,

          array(
            'id'                 => 'in_style',
            'type'               => 'textarea', 
            'title'              => 'Custom CSS',
          ),
          array(
            'id'                 => 'in_style_hover',
            'type'               => 'textarea', 
            'title'              => 'Custom Hover CSS',
          ),

          $cs_map_animation,
          $cs_map_animation_delay,
          $cs_map_animation_duration,

          array(
            'id'                 => 'content',
            'type'               => 'textarea',
            'title'              => 'Content',
            'default'            => 'Click',
          )
        ),
      ),

      //                         ==========================================
      // BUTTON GROUP
      //                         ==========================================
      'cs_button_group'          => array(
        'title'                  => 'Button Group',
        'shortcode_atts'         => array( $cs_map_content ),
      ),

    ),
  ),

  'infographics'                 => array(
    'title'                      => 'Infographics',
    'shortcodes'                 => array(

      //                         ==========================================
      // PROGRESS BAR
      //                         ==========================================
      'cs_progress'              => array(
        'title'                  => 'Progress Bar',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'Title',
          ),
          array(
            'id'                 => 'percentage',
            'type'               => 'text', 
            'title'              => 'Percentage',
            'default'            => 100
          ),
          array(
            'id'                 => 'unit',
            'type'               => 'text', 
            'title'              => 'Unit',
            'default'            => '%'
          ),
          array(
            'id'                 => 'height',
            'type'               => 'text', 
            'title'              => 'Height',
          ),
          array(
            'id'                 => 'vertical',
            'type'               => 'on_off', 
            'title'              => 'Vertical Bar',
          ),
          array(
            'id'                 => 'striped',
            'type'               => 'on_off', 
            'title'              => 'Striped Effect',
          ),
          array(
            'id'                 => 'inside',
            'type'               => 'on_off', 
            'title'              => 'Inside Percentage',
          ),
          array(
            'id'                 => 'circle',
            'type'               => 'on_off', 
            'title'              => 'Circle Bar',
          ),
          array(
            'id'                 => 'bar_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Bar Color',
          ),
          array(
            'id'                 => 'bg_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Background Color',
          ),
          array(
            'id'                 => 'text_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Text Color',
          ),
        ),
      ),

      //                         ==========================================
      // PROGRESS BAR GROUP
      //                         ==========================================
      'cs_progress_group'        => array(
        'title'                  => 'Progress Bar Group',
        'shortcode_atts'         => array( $cs_map_content ),
      ),

      //                         ==========================================
      // PROGRESS ICON
      //                         ==========================================
      'cs_progress_icon'         => array(
        'title'                  => 'Progress Icon',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'icon',
            'type'               => 'text', 
            'title'              => 'Icon',
          ),
          array(
            'id'                 => 'total',
            'type'               => 'text', 
            'title'              => 'Total Icons',
            'default'            => 20,
          ),
          array(
            'id'                 => 'active',
            'type'               => 'text', 
            'title'              => 'Active Icons',
            'default'            => 10,
          ),
          array(
            'id'                 => 'size',
            'type'               => 'text', 
            'title'              => 'Icon Size',
          ),
          array(
            'id'                 => 'active_color',
            'type'               => 'color_picker', 
            'title'              => 'Active Icon Color',
          ),
          array(
            'id'                 => 'base_color',
            'type'               => 'color_picker', 
            'title'              => 'Icon Base Color',
          ),
        ),
      ),

      //                         ==========================================
      // COUNTER
      //                         ==========================================
      'cs_counter'               => array(
        'title'                  => 'Counter',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'Title',
          ),
          array(
            'id'                 => 'from',
            'type'               => 'text', 
            'title'              => 'From',
            'default'            => 0,
          ),
          array(
            'id'                 => 'to',
            'type'               => 'text', 
            'title'              => 'To',
            'default'            => 100,
          ),
          array(
            'id'                 => 'decimals',
            'type'               => 'text', 
            'title'              => 'Decimals',
          ),
          array(
            'id'                 => 'duration',
            'type'               => 'text', 
            'title'              => 'Duration',
          ),
          array(
            'id'                 => 'separator',
            'type'               => 'text', 
            'title'              => 'Separator',
          ),
          array(
            'id'                 => 'prefix_icon',
            'type'               => 'icon', 
            'title'              => 'Prefix Icon',
          ),
          array(
            'id'                 => 'prefix_pos',
            'type'               => 'select', 
            'title'              => 'Radio Field',
            'options'            => array(
              ''                 => 'Right',
              'left'             => 'Left',
              'top'              => 'Top',
              'bottom'           => 'Bottom',
            ),
          ),
          array(
            'id'                 => 'prefix_size',
            'type'               => 'text', 
            'title'              => 'Prefix Size',
          ),
          array(
            'id'                 => 'prefix_opacity',
            'type'               => 'text', 
            'title'              => 'Prefix Opacity',
          ),
          array(
            'id'                 => 'prefix_text',
            'type'               => 'text', 
            'title'              => 'Prefix Extra Text',
          ),
          array(
            'id'                 => 'counter_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Counter Color',
          ),
          array(
            'id'                 => 'prefix_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Prefix Color',
          ),
          array(
            'id'                 => 'title_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Title Color',
          ),
          array(
            'id'                 => 'title_size',
            'type'               => 'text', 
            'title'              => 'Title Size',
          ),
          array(
            'id'                 => 'counter_size',
            'type'               => 'text', 
            'title'              => 'Counter Size',
          ),
        ),
      ),

      //                         ==========================================
      // PIE CHART
      //                         ==========================================
      'cs_piechart'              => array(
        'title'                  => 'Pie Chart',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'type',
            'type'               => 'select', 
            'title'              => 'Type',
            'options'            => array(
              'count'            => 'Count Number',
              'icon'             => 'Only Icon',
              'text'             => 'Only Text',
            ),
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon', 
            'title'              => 'Icon',
            'dependency'         => array('type', '==', 'icon'),
          ),
          array(
            'id'                 => 'text',
            'type'               => 'text', 
            'title'              => 'Text',
            'dependency'         => array('type', '==', 'text'),
          ),
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'Title',
          ),
          array(
            'id'                 => 'percent',
            'type'               => 'text', 
            'title'              => 'Percent',
            'default'            => 100
          ),
          array(
            'id'                 => 'size',
            'type'               => 'text', 
            'title'              => 'Size',
          ),
          array(
            'id'                 => 'line_width',
            'type'               => 'text', 
            'title'              => 'Line Width',
            'default'            => 2,
          ),
          array(
            'id'                 => 'bar_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Bar Color',
          ),
          array(
            'id'                 => 'track_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Track Color',
          ),
          array(
            'id'                 => 'text_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Text Color',
          ),
          array(
            'id'                 => 'title_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Title Color',
          ),
          array(
            'id'                 => 'text_size',
            'type'               => 'text', 
            'title'              => 'Text Size',
          ),
          array(
            'id'                 => 'title_size',
            'type'               => 'text', 
            'title'              => 'Title Size',
          ),
          array(
            'id'                 => 'prefix',
            'type'               => 'text', 
            'title'              => 'Prefix',
          ),
        ),
      ),

      //                         ==========================================
      // COUNTDOWN
      //                         ==========================================
      'cs_countdown'             => array(
        'title'                  => 'Countdown',
        'view'                   => 'single',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'count',
            'type'               => 'select', 
            'title'              => 'Count Type ( down or up )',
            'options'            => array(
              'down'             => 'down',
              'up'               => 'up',
            ),
          ),
          array(
            'id'                 => 'notice-countdown-format', 
            'type'               => 'content', 
            'content'            => '<p class="cs-alert cs-alert-info">Yeah, You choose countup, be sure for date. you must write a older date. eg for 1 day ago. <strong>'. date( 'M d Y', strtotime('-1 days') ) .'</strong></p>',
            'dependency'         => array('count', '==', 'up'),
          ),
          array(
            'id'                 => 'date',
            'type'               => 'text', 
            'title'              => 'Date',
            'default'            => date( 'M d Y' ),
            'info'               => 'Currently value is today, change date, write your own upcoming date',
          ),
          array(
            'id'                 => 'format',
            'type'               => 'text', 
            'title'              => 'Format',
            'default'            => 'yowdhms',
          ),
          array(
            'id'                 => 'notice-countdown', 
            'type'               => 'content', 
            'content'            => '
            <p class="cs-alert cs-alert-info">
              <strong>y</strong>: year <strong>o</strong>: month <strong>w</strong>: week <strong>d</strong>: day <strong>h</strong>: hour <strong>m</strong>: minuites <strong>s</strong>: second<br /><br />
              if you write <strong>YOWDHMS</strong> as uppercase this is mean optional if there is year it will show else hide.<br />
              Eg. Formats: <strong>dhms</strong> or <strong>wdh</strong> or <strong>od</strong> you know...
            </p>',
          ),
          array(
            'id'                 => 'layout',
            'type'               => 'select', 
            'title'              => 'Layout',
            'options'            => array(
              'boxed'            => 'boxed',
              'line'             => 'line',
              'normal'           => 'normal',
            ),
          ),
          array(
            'id'                 => 'color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Text Color',
          ),
          array(
            'id'                 => 'border_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Border Color',
          ),
        ),
      ),

      //                         ==========================================
      // ICON BOX
      //                         ==========================================
      'cs_iconbox'               => array(
        'title'                  => 'Icon Box',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'Box Title',
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon', 
            'title'              => 'Box Icon',
          ),
          array(
            'id'                 => 'align',
            'type'               => 'select', 
            'title'              => 'Icon and Text Align',
            'options'            => array(
              'left'             => 'Box Left',
              'center'           => 'Box Center',
              'right'            => 'Box Right',
              'heading-left'     => 'Heading Left',
              'heading-right'    => 'Heading Right',
            ),
            'info'               => 'Set icon position, also this is text align',
          ),
          array(
            'id'                 => 'icon_type',
            'type'               => 'select', 
            'title'              => 'Icon Type',
            'options'            => array(
              'bgcolor'          => 'Background Color',
              'outlined'         => 'Outlined',
              'bordered'         => 'Bordered',
              'nocolor'          => 'No Colors',
            ),
          ),
          array(
            'id'                 => 'icon_shape',
            'type'               => 'select', 
            'title'              => 'Icon Shape',
            'options'            => array(
              'square'           => 'Square',
              'circle'           => 'Circle',
              'rounded'          => 'Rounded',
            ),
          ),

          array(
            'id'                 => 'icon_size',
            'type'               => 'select', 
            'title'              => 'Icon Size',
            'options'            => array(
              'xxs'              => 'XX Small',
              'xs'               => 'X Small',
              'sm'               => 'Small',
              'md'               => 'Medium',
              'lg'               => 'Large',
              'xl'               => 'X Large',
              'xxl'              => 'XX Large',
              'custom'           => 'Custom',
            ),
            'default'            => 'sm',
          ),
          array(
            'id'                 => 'custom_icon_size',
            'type'               => 'text', 
            'title'              => 'Icon Size',
            'dependency'         => array('icon_size', '==', 'custom'),
          ),
          array(
            'id'                 => 'custom_icon_spacing',
            'type'               => 'text', 
            'title'              => 'Icon Spacing',
            'dependency'         => array('icon_size', '==', 'custom'),
          ),
          array(
            'id'                 => 'icon_border_width',
            'type'               => 'text', 
            'title'              => 'Icon Border Width',
          ),
          array(
            'id'                 => 'icon_border_style',
            'type'               => 'select', 
            'title'              => 'Icon Border Style',
            'options'            => array(
              ''                 => 'Solid',
              'dashed'           => 'Dashed',
              'dotted'           => 'Dotted',
              'double'           => 'Double',
              'groove'           => 'Groove',
              'ridge'            => 'Ridge',
              'inset'            => 'Inset',
              'outset'           => 'Outset',
            ),
          ),

          array(
            'id'                 => 'icon_background',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Background Color',
          ),
          array(
            'id'                 => 'icon_border',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Border Color',
          ),
          array(
            'id'                 => 'icon_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Color',
          ),
          array(
            'id'                 => 'title_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Title Color',
          ),

          array(
            'id'                 => 'link',
            'type'               => 'text', 
            'title'              => 'Box Link',
          ),
          array(
            'id'                 => 'target',
            'type'               => 'select', 
            'title'              => 'Box Link Target',
            'options'            => array(
              ''                 => '_self',
              '_blank'           => '_blank',
            ),
          ),
          array(
            'id'                 => 'apply_link',
            'type'               => 'select', 
            'title'              => 'Apply link to',
            'options'            => array(
              ''                 => 'Box',
              'title'            => 'Title',
            ),
          ),
          array(
            'id'                 => 'title_size',
            'type'               => 'select', 
            'title'              => 'Box Title Size',
            'options'            => array(
              ''                 => 'Select a heading',
              'h1'               => 'h1',
              'h2'               => 'h2',
              'h3'               => 'h3',
              'h4'               => 'h4',
              'h5'               => 'h4',
              'h6'               => 'h5',
              'custom'           => 'custom',
            ),
          ),
          array(
            'id'                 => 'custom_title_size',
            'type'               => 'text', 
            'title'              => 'Custom Title Size',
            'dependency'         => array('title_size', '==', 'custom'),
          ),
          array(
            'id'                 => 'effect',
            'type'               => 'on_off', 
            'title'              => 'Icon Hover Effect',
          ),
          $cs_map_animation,
          $cs_map_animation_delay,
          $cs_map_animation_duration,
          $cs_map_content,
        ),
      ),

      //                         ==========================================
      // ICON FANCYBOX
      //                         ==========================================
      'cs_fancybox'              => array(
        'title'                  => 'Icon Fancybox',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'Box Title',
          ),
          array(
            'id'                 => 'box_type',
            'type'               => 'select', 
            'title'              => 'Box Type',
            'options'            => array(
              'bgcolor'          => 'Background Color',
              'outlined'         => 'Outlined',
            ),
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon', 
            'title'              => 'Box Icon',
          ),
          array(
            'id'                 => 'icon_position',
            'type'               => 'select', 
            'title'              => 'Icon Position',
            'options'            => array(
              'tc'               => 'Top Center',
              'tl'               => 'Top Left',
              'tr'               => 'Top Right',
              'cl'               => 'Center Left',
              'cr'               => 'Center Right',
              'bc'               => 'Bottom Center',
              'bl'               => 'Bottom Left',
              'br'               => 'Bottom Right',
            ),
          ),
          array(
            'id'                 => 'icon_type',
            'type'               => 'select', 
            'title'              => 'Icon Type',
            'options'            => array(
              'bgcolor'          => 'Background Color',
              'outlined'         => 'Outlined',
            ),
          ),
          array(
            'id'                 => 'icon_shape',
            'type'               => 'select', 
            'title'              => 'Icon Shape',
            'options'            => array(
              'square'           => 'Square',
              'circle'           => 'Circle',
              'rounded'          => 'Rounded',
            ),
          ),

          array(
            'id'                 => 'icon_size',
            'type'               => 'select', 
            'title'              => 'Icon Size',
            'options'            => array(
              'xxs'              => 'XX Small',
              'xs'               => 'X Small',
              'sm'               => 'Small',
              'md'               => 'Medium',
              'lg'               => 'Large',
              'xl'               => 'X Large',
              'xxl'              => 'XX Large',
            ),
            'default'            => 'sm',
          ),

          array(
            'id'                 => 'link',
            'type'               => 'text', 
            'title'              => 'Box Link',
          ),
          array(
            'id'                 => 'target',
            'type'               => 'select', 
            'title'              => 'Box Link Target',
            'options'            => array(
              ''                 => '_self',
              '_blank'           => '_blank',
            ),
          ),
          array(
            'id'                 => 'apply_link',
            'type'               => 'select', 
            'title'              => 'Apply link to',
            'options'            => array(
              ''                 => 'Box',
              'title'            => 'Title',
            ),
          ),
          array(
            'id'                 => 'title_size',
            'type'               => 'select', 
            'title'              => 'Box Title Size',
            'options'            => array(
              ''                 => 'Select a heading',
              'h1'               => 'h1',
              'h2'               => 'h2',
              'h3'               => 'h3',
              'h4'               => 'h4',
              'h5'               => 'h4',
              'h6'               => 'h5',
              'custom'           => 'custom',
            ),
          ),
          array(
            'id'                 => 'custom_title_size',
            'type'               => 'text', 
            'title'              => 'Custom Title Size',
            'dependency'         => array('title_size', '==', 'custom'),
          ),
          array(
            'id'                 => 'box_rounded',
            'type'               => 'on_off', 
            'title'              => 'Box Rounded',
          ),
          array(
            'id'                 => 'box_border_width',
            'type'               => 'text', 
            'title'              => 'Box Border Width',
          ),
          array(
            'id'                 => 'box_border_style',
            'type'               => 'select', 
            'title'              => 'Box Border Style',
            'options'            => array(
              ''                 => 'Solid',
              'dashed'           => 'Dashed',
              'dotted'           => 'Dotted',
              'double'           => 'Double',
              'groove'           => 'Groove',
              'ridge'            => 'Ridge',
              'inset'            => 'Inset',
              'outset'           => 'Outset',
            ),
          ),

          array(
            'id'                 => 'icon_background',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Background Color',
          ),
          array(
            'id'                 => 'icon_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Color',
          ),
          array(
            'id'                 => 'icon_border',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Border Color',
          ),
          array(
            'id'                 => 'box_background',
            'type'               => 'color_picker', 
            'title'              => 'Custom Box Background Color',
          ),
          array(
            'id'                 => 'box_border',
            'type'               => 'color_picker', 
            'title'              => 'Custom Box Border Color',
          ),
          array(
            'id'                 => 'box_text_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Box Text Color',
          ),
          array(
            'id'                 => 'box_title_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Box Title Color',
          ),

          $cs_map_content,
        ),
      ),

      //                         ==========================================
      // ICON BOX
      //                         ==========================================
      'cs_iconbox'               => array(
        'title'                  => 'Icon Box',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'Box Title',
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon', 
            'title'              => 'Box Icon',
          ),
          array(
            'id'                 => 'align',
            'type'               => 'select', 
            'title'              => 'Icon and Text Align',
            'options'            => array(
              'left'             => 'Box Left',
              'center'           => 'Box Center',
              'right'            => 'Box Right',
              'heading-left'     => 'Heading Left',
              'heading-right'    => 'Heading Right',
            ),
            'info'               => 'Set icon position, also this is text align',
          ),
          array(
            'id'                 => 'icon_type',
            'type'               => 'select', 
            'title'              => 'Icon Type',
            'options'            => array(
              'bgcolor'          => 'Background Color',
              'outlined'         => 'Outlined',
              'bordered'         => 'Bordered',
              'nocolor'          => 'No Colors',
            ),
          ),
          array(
            'id'                 => 'icon_shape',
            'type'               => 'select', 
            'title'              => 'Icon Shape',
            'options'            => array(
              'square'           => 'Square',
              'circle'           => 'Circle',
              'rounded'          => 'Rounded',
            ),
          ),

          array(
            'id'                 => 'icon_size',
            'type'               => 'select', 
            'title'              => 'Icon Size',
            'options'            => array(
              'xxs'              => 'XX Small',
              'xs'               => 'X Small',
              'sm'               => 'Small',
              'md'               => 'Medium',
              'lg'               => 'Large',
              'xl'               => 'X Large',
              'xxl'              => 'XX Large',
              'custom'           => 'Custom',
            ),
            'default'            => 'sm',
          ),
          array(
            'id'                 => 'custom_icon_size',
            'type'               => 'text', 
            'title'              => 'Icon Size',
            'dependency'         => array('icon_size', '==', 'custom'),
          ),
          array(
            'id'                 => 'custom_icon_spacing',
            'type'               => 'text', 
            'title'              => 'Icon Spacing',
            'dependency'         => array('icon_size', '==', 'custom'),
          ),
          array(
            'id'                 => 'icon_border_width',
            'type'               => 'text', 
            'title'              => 'Icon Border Width',
          ),
          array(
            'id'                 => 'icon_border_style',
            'type'               => 'select', 
            'title'              => 'Icon Border Style',
            'options'            => array(
              ''                 => 'Solid',
              'dashed'           => 'Dashed',
              'dotted'           => 'Dotted',
              'double'           => 'Double',
              'groove'           => 'Groove',
              'ridge'            => 'Ridge',
              'inset'            => 'Inset',
              'outset'           => 'Outset',
            ),
          ),

          array(
            'id'                 => 'icon_background',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Background Color',
          ),
          array(
            'id'                 => 'icon_border',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Border Color',
          ),
          array(
            'id'                 => 'icon_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Color',
          ),
          array(
            'id'                 => 'title_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Title Color',
          ),

          array(
            'id'                 => 'link',
            'type'               => 'text', 
            'title'              => 'Box Link',
          ),
          array(
            'id'                 => 'target',
            'type'               => 'select', 
            'title'              => 'Box Link Target',
            'options'            => array(
              ''                 => '_self',
              '_blank'           => '_blank',
            ),
          ),
          array(
            'id'                 => 'apply_link',
            'type'               => 'select', 
            'title'              => 'Apply link to',
            'options'            => array(
              ''                 => 'Box',
              'title'            => 'Title',
            ),
          ),
          array(
            'id'                 => 'title_size',
            'type'               => 'select', 
            'title'              => 'Box Title Size',
            'options'            => array(
              ''                 => 'Select a heading',
              'h1'               => 'h1',
              'h2'               => 'h2',
              'h3'               => 'h3',
              'h4'               => 'h4',
              'h5'               => 'h4',
              'h6'               => 'h5',
              'custom'           => 'custom',
            ),
          ),
          array(
            'id'                 => 'custom_title_size',
            'type'               => 'text', 
            'title'              => 'Custom Title Size',
            'dependency'         => array('title_size', '==', 'custom'),
          ),
          array(
            'id'                 => 'effect',
            'type'               => 'on_off', 
            'title'              => 'Icon Hover Effect',
          ),
          $cs_map_animation,
          $cs_map_animation_delay,
          $cs_map_animation_duration,
          $cs_map_content,
        ),
      ),

      //                         ==========================================
      // ICON FANCYBOX
      //                         ==========================================
      'cs_fancybox'              => array(
        'title'                  => 'Icon Fancybox',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'Box Title',
          ),
          array(
            'id'                 => 'box_type',
            'type'               => 'select', 
            'title'              => 'Box Type',
            'options'            => array(
              'bgcolor'          => 'Background Color',
              'outlined'         => 'Outlined',
            ),
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon', 
            'title'              => 'Box Icon',
          ),
          array(
            'id'                 => 'icon_position',
            'type'               => 'select', 
            'title'              => 'Icon Position',
            'options'            => array(
              'tc'               => 'Top Center',
              'tl'               => 'Top Left',
              'tr'               => 'Top Right',
              'cl'               => 'Center Left',
              'cr'               => 'Center Right',
              'bc'               => 'Bottom Center',
              'bl'               => 'Bottom Left',
              'br'               => 'Bottom Right',
            ),
          ),
          array(
            'id'                 => 'icon_type',
            'type'               => 'select', 
            'title'              => 'Icon Type',
            'options'            => array(
              'bgcolor'          => 'Background Color',
              'outlined'         => 'Outlined',
            ),
          ),
          array(
            'id'                 => 'icon_shape',
            'type'               => 'select', 
            'title'              => 'Icon Shape',
            'options'            => array(
              'square'           => 'Square',
              'circle'           => 'Circle',
              'rounded'          => 'Rounded',
            ),
          ),

          array(
            'id'                 => 'icon_size',
            'type'               => 'select', 
            'title'              => 'Icon Size',
            'options'            => array(
              'xxs'              => 'XX Small',
              'xs'               => 'X Small',
              'sm'               => 'Small',
              'md'               => 'Medium',
              'lg'               => 'Large',
              'xl'               => 'X Large',
              'xxl'              => 'XX Large',
            ),
            'default'            => 'sm',
          ),

          array(
            'id'                 => 'link',
            'type'               => 'text', 
            'title'              => 'Box Link',
          ),
          array(
            'id'                 => 'target',
            'type'               => 'select', 
            'title'              => 'Box Link Target',
            'options'            => array(
              ''                 => '_self',
              '_blank'           => '_blank',
            ),
          ),
          array(
            'id'                 => 'apply_link',
            'type'               => 'select', 
            'title'              => 'Apply link to',
            'options'            => array(
              ''                 => 'Box',
              'title'            => 'Title',
            ),
          ),
          array(
            'id'                 => 'title_size',
            'type'               => 'select', 
            'title'              => 'Box Title Size',
            'options'            => array(
              ''                 => 'Select a heading',
              'h1'               => 'h1',
              'h2'               => 'h2',
              'h3'               => 'h3',
              'h4'               => 'h4',
              'h5'               => 'h4',
              'h6'               => 'h5',
              'custom'           => 'custom',
            ),
          ),
          array(
            'id'                 => 'custom_title_size',
            'type'               => 'text', 
            'title'              => 'Custom Title Size',
            'dependency'         => array('title_size', '==', 'custom'),
          ),
          array(
            'id'                 => 'box_rounded',
            'type'               => 'on_off', 
            'title'              => 'Box Rounded',
          ),
          array(
            'id'                 => 'box_border_width',
            'type'               => 'text', 
            'title'              => 'Box Border Width',
          ),
          array(
            'id'                 => 'box_border_style',
            'type'               => 'select', 
            'title'              => 'Box Border Style',
            'options'            => array(
              ''                 => 'Solid',
              'dashed'           => 'Dashed',
              'dotted'           => 'Dotted',
              'double'           => 'Double',
              'groove'           => 'Groove',
              'ridge'            => 'Ridge',
              'inset'            => 'Inset',
              'outset'           => 'Outset',
            ),
          ),

          array(
            'id'                 => 'icon_background',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Background Color',
          ),
          array(
            'id'                 => 'icon_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Color',
          ),
          array(
            'id'                 => 'icon_border',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Border Color',
          ),
          array(
            'id'                 => 'box_background',
            'type'               => 'color_picker', 
            'title'              => 'Custom Box Background Color',
          ),
          array(
            'id'                 => 'box_border',
            'type'               => 'color_picker', 
            'title'              => 'Custom Box Border Color',
          ),
          array(
            'id'                 => 'box_text_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Box Text Color',
          ),
          array(
            'id'                 => 'box_title_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Box Title Color',
          ),

          $cs_map_content,
        ),
      ),


    ),
  ),


  'pages'                        => array(
    'title'                      => 'Pages',
    'shortcodes'                 => array(

      //                         ==========================================
      // PORTFOLIO
      //                         ==========================================
      'cs_portfolio'             => array(
        'title'                  => 'Portfolio',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'cats',
            'type'               => 'select', 
            'title'              => 'Custom Categories',
            'class'              => 'chosen',
            'options'            => 'categories',
            'query_args'         => array(
              'sort_order'       => 'ASC',
              'taxonomy'         => 'portfolio-category',
              'hide_empty'       => 0,
            ),
            'attributes'         => array(
              'data-placeholder' => 'Choose category (optional)',
              'multiple'         => 'multiple',
            ),
            'info'               => 'you can choose spesific categories for portfolio, default is all categories',
          ),
          array(
            'id'                 => 'style',
            'type'               => 'select', 
            'title'              => 'Style',
            'options'            => array(
              'default'          => 'Default',
              'without-space'    => 'Without Space',
              'with-one-px'      => 'With 1px',
            ),
          ),
          array(
            'id'                 => 'layout',
            'type'               => 'select', 
            'title'              => 'Layout',
            'options'            => array(
              'masonry'          => 'Masonry',
              'fitRows'          => 'Grid',
            ),
          ),
          array(
            'id'                 => 'model',
            'type'               => 'select', 
            'title'              => 'Model',
            'options'            => array(
              'default'          => 'Default',
              'ajax'             => 'Ajax',
              'gallery'          => 'Lightbox Gallery',
              'text'             => 'Text',
            ),
          ),
          array(
            'id'                 => 'columns',
            'type'               => 'select', 
            'title'              => 'Columns',
            'options'            => array(
              1                  => '1 Column',
              2                  => '2 Columns',
              3                  => '3 Columns',
              4                  => '4 Columns',
              5                  => '5 Columns',
              6                  => '6 Columns',
              7                  => '7 Columns',
              8                  => '8 Columns',
              9                  => '9 Columns',
              10                 => '10 Columns',
              11                 => '11 Columns',
              12                 => '12 Columns',
            ),
            'default'            => 3,
          ),
          array(
            'id'                 => 'size',
            'type'               => 'select', 
            'title'              => 'Thumbnail Size (optional)',
            'options'            => array_flip( cs_get_image_sizes( true ) ),
            'default'            => 'large',
          ),
          array(
            'id'                 => 'nav',
            'type'               => 'select', 
            'title'              => 'Pagination Type',
            'options'            => array(
              'paging'           => 'Pagination',
              'load'             => 'Load More',
              'hide'             => 'Hide',
            ),
          ),
          array(
            'id'                 => 'limit',
            'type'               => 'text', 
            'title'              => 'Posts Per Page',
            'default'            => 9,
          ),
          array(
            'id'                 => 'no_filter',
            'type'               => 'on_off', 
            'title'              => 'No Filterable',
          ),
          array(
            'id'                 => 'filter_color',
            'type'               => 'color_picker', 
            'title'              => 'Filter Color',
          ),
          array(
            'id'                 => 'filter_hover_color',
            'type'               => 'color_picker', 
            'title'              => 'Filter Active Color',
          ),
          array(
            'id'                 => 'filter_align',
            'type'               => 'select', 
            'title'              => 'Filter Align',
            'options'            => array(
              'left'             => 'Left',
              'center'           => 'Center',
              'right'            => 'Right',
            ),
            'default'            => 'center',
          ),
          array(
            'id'                 => 'filter_shape',
            'type'               => 'select', 
            'title'              => 'Filter Shape',
            'options'            => array(
              'pill'             => 'Pill',
              'rounded'          => 'Rounded',
              'square'           => 'Square',
            ),
          ),
          array(
            'id'                 => 'no_love',
            'type'               => 'text', 
            'title'              => 'No Love Button',
          ),
        ),
      ),

      //                         ==========================================
      // BLOG
      //                         ==========================================
      'cs_blog'                  => array(
        'title'                  => 'Blog',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'cats',
            'type'               => 'select', 
            'title'              => 'Custom Categories',
            'class'              => 'chosen',
            'options'            => 'categories',
            'query_args'         => array(
              'sort_order'       => 'ASC',
              'taxonomy'         => 'category',
              'hide_empty'       => 0,
            ),
            'attributes'         => array(
              'data-placeholder' => 'Choose category (optional)',
              'multiple'         => 'multiple',
            ),
            'info'               => 'you can choose spesific categories for portfolio, default is all categories',
          ),
          array(
            'id'                 => 'type',
            'type'               => 'select', 
            'title'              => 'Type',
            'options'            => array(
              'default'          => 'Blog Large Image',
              'medium'           => 'Blog Medium Image',
              'small'            => 'Blog Small Image',
              'masonry'          => 'Blog Masonry',
              'grid'             => 'Blog Grid',
            ),
          ),
          array(
            'id'                 => 'columns',
            'type'               => 'select', 
            'title'              => 'Columns',
            'options'            => array(
              ''                 => '3 Columns',
              4                  => '4 Columns',
             2                   =>  '2 Columns',
            ),
            'dependency'         => array('type', 'any', '["masonry","grid"]'),
          ),
          array(
            'id'                 => 'size',
            'type'               => 'select', 
            'title'              => 'Thumbnail Size (optional)',
            'options'            => array_flip( cs_get_image_sizes( true ) ),
            'default'            => 'large',
          ),

                    array(
            'id'                 => 'nav',
            'type'               => 'select', 
            'title'              => 'Pagination',
            'options'            => array(
              'paging'           => 'Pagination',
              'load'             => 'Load More',
              'hide'             => 'Hide',
            ),
          ),
          array(
            'id'                 => 'limit',
            'type'               => 'text', 
            'title'              => 'Posts Per Page',
            'default'            => get_option( 'posts_per_page' ),
          ),
        ),
      ),







    )
  ),


  'lists'                        => array(
    'title'                      => 'Lists',
    'shortcodes'                 => array(

      //                         ==========================================
      // ICON LIST
      //                         ==========================================
      'cs_icon_list'             => array(
        'title'                  => 'Icon List',
        'view'                   => 'flexible',
        'clone_id'               => 'cs_icon_list_item',
        'clone_title'            => 'Add New List Item',
        'shortcode_atts'         => array(),
        'multiple_atts'          => array(
          array(
            'id'                 => 'icon',
            'type'               => 'icon',
            'title'              => 'Icon',
          ),
          array(
            'id'                 => 'icon_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Color',
          ),
          array(
            'id'                 => 'text_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Text Color',
          ),
          $cs_map_content
        )
      ),

      //                         ==========================================
      // CLIENT LIST
      //                         ==========================================
      'cs_clients'               => array(
        'title'                  => 'Clients List',
        'view'                   => 'flexible',
        'clone_id'               => 'cs_client',
        'clone_title'            => 'Add New List Item',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'columns',
            'type'               => 'select', 
            'title'              => 'Columns',
            'options'            => array(
              1                  => '1 Column',
              2                  => '2 Columns',
              3                  => '3 Columns',
              4                  => '4 Columns',
              5                  => '5 Columns',
              6                  => '6 Columns',
              7                  => '7 Columns',
              8                  => '8 Columns',
              9                  => '9 Columns',
              10                 => '10 Columns',
            ),
            'default'            => 4,
          ),
          array(
            'id'                 => 'effect',
            'type'               => 'on_off', 
            'title'              => 'No Hover Effect',
          ),
          array(
            'id'                 => 'border_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Border Color',
          ),
        ),
        'multiple_atts'          => array(
          array(
            'id'                 => 'image',
            'type'               => 'upload', 
            'title'              => 'Image',
          ),
          array(
            'id'                 => 'link',
            'type'               => 'text', 
            'title'              => 'Link',
          ),
          array(
            'id'                 => 'target',
            'type'               => 'select', 
            'title'              => 'Link Target',
            'options'            => array(
              ''                 => '_self',
              '_blank'           => '_blank',
            ),
          ),
        )
      ),

      //                         ==========================================
      // TESTIMONIAL SLIDER
      //                         ==========================================
      'cs_testimonials'          => array(
        'title'                  => 'Testimonials',
        'view'                   => 'flexible',
        'clone_id'               => 'cs_testimonial',
        'clone_title'            => 'Add New Blockqutoe',
        'shortcode_atts'         => array(),
        'multiple_atts'          => array(
          array(
            'id'                 => 'author',
            'type'               => 'text',
            'title'              => 'Author',
          ),
          array(
            'id'                 => 'slogan',
            'type'               => 'text', 
            'title'              => 'Slogan',
          ),
          array(
            'id'                 => 'avatar',
            'type'               => 'upload', 
            'title'              => 'Avatar',
          ),
          $cs_map_content
        )
      ),

      //                         ==========================================
      // FAQ
      //                         ==========================================
      'cs_faq'                   => array(
        'title'                  => 'FAQ',
        'view'                   => 'flexible',
        'clone_id'               => 'cs_faq_block',
        'clone_title'            => 'Add New Question / Answer',
        'shortcode_atts'         => array(),
        'multiple_atts'          => array(
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'FAQ Tab Title',
          ),
          array(
            'id'                 => 'content',
            'type'               => 'textarea', 
            'title'              => 'Textarea Field',
            'default'            => '[vc_toggle title="Question"]Answer[/vc_toggle]
[vc_toggle title                 ="Question"]Answer[/vc_toggle]
[vc_toggle title                 ="Question"]Answer[/vc_toggle]'
          ),
        )
      ),
    )
  ),

  'tables'                       => array(
    'title'                      => 'Tables',
    'shortcodes'                 => array(

      //                         ==========================================
      // PRICING TABLE
      //                         ==========================================
      'cs_pricing_table'         => array(
        'title'                  => 'Pricing Table',
        'view'                   => 'flexible',
        'clone_id'               => 'cs_pricing_column',
        'clone_title'            => 'Add New Pricing Column',
        'shortcode_atts'         => array(),
        'multiple_atts'          => array(
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'Title',
          ),
          array(
            'id'                 => 'price',
            'type'               => 'text', 
            'title'              => 'Price',
          ),
          array(
            'id'                 => 'subtitle',
            'type'               => 'text', 
            'title'              => 'Price Subtitle',
          ),
          array(
            'id'                 => 'currency',
            'type'               => 'text', 
            'title'              => 'Currency',
            'default'            => '$',
          ),
          array(
            'id'                 => 'interval',
            'type'               => 'text', 
            'title'              => 'Interval',
            'default'            => 'per year',
          ),
          array(
            'id'                 => 'featured',
            'type'               => 'on_off', 
            'title'              => 'Featured Column',
            'info'               => 'Set this column as featured!',
          ),
          array(
            'id'                 => 'color',
            'type'               => 'select', 
            'title'              => 'Predefined Colors',
            'options'            => array(
              'accent'           => 'Accent',
              'blue'             => 'Blue',
              'green'            => 'Green',
              'red'              => 'Red',
              'yellow'           => 'Yellow',
              'gray'             => 'Gray',
              'black'            => 'Black',
              'custom'           => 'Custom',
            ),
          ),
          array(
            'id'                 => 'title_bgcolor',
            'type'               => 'color_picker', 
            'title'              => 'Title Background Color',
            'dependency'         => array('color', '==', 'custom'),
          ),
          array(
            'id'                 => 'title_color',
            'type'               => 'color_picker', 
            'title'              => 'Title Color',
            'dependency'         => array('color', '==', 'custom'),
          ),
          array(
            'id'                 => 'price_bgcolor',
            'type'               => 'color_picker', 
            'title'              => 'Price Background Color',
            'dependency'         => array('color', '==', 'custom'),
          ),
          array(
            'id'                 => 'price_color',
            'type'               => 'color_picker', 
            'title'              => 'Price Color',
            'dependency'         => array('color', '==', 'custom'),
          ),
          array(
            'id'                 => 'button_content',
            'type'               => 'text', 
            'title'              => 'Button Text',
          ),
          array(
            'id'                 => 'button_link',
            'type'               => 'text', 
            'title'              => 'Link',
          ),
          array(
            'id'                 => 'button_target',
            'type'               => 'select', 
            'title'              => 'Link Target',
            'options'            => array(
              ''                 => '_self',
              '_blank'           => '_blank',
            ),
          ),
          array(
            'id'                 => 'button_icon',
            'type'               => 'icon', 
            'title'              => 'Button Icon',
          ),
          array(
            'id'                 => 'button_type',
            'type'               => 'select', 
            'title'              => 'Button Type',
            'options'            => array(
              'flat'             => 'Flat',
              'outlined'         => 'Outlined',
              '3d'               => '3D',
            ),
          ),
          array(
            'id'                 => 'button_shape',
            'type'               => 'select', 
            'title'              => 'Button Shape',
            'options'            => array(
              'square'           => 'Square',
              'rounded'          => 'Rounded',
              'pill'             => 'Pill',
              'circle'           => 'Circle',
            ),
          ),
          array(
            'id'                 => 'button_size',
            'type'               => 'select', 
            'title'              => 'Button Size',
            'options'            => array(
              'xxs'              => 'X Small',
              'xs'               => 'Small',
              'sm'               => 'Pill',
              'md'               => 'Medium',
              'lg'               => 'Large',
              'xl'               => 'X Large',
              'xxl'              => 'XX Large',
            ),
          ),
          array(
            'id'                 => 'button_color',
            'type'               => 'select', 
            'title'              => 'Button Color',
            'options'            => array(
              'accent'           => 'Accent',
              'blue'             => 'Blue',
              'green'            => 'Green',
              'red'              => 'Red',
              'yellow'           => 'Yellow',
              'black'            => 'Black',
            ),
          ),
          array(
            'id'                 => 'button_block',
            'type'               => 'on_off', 
            'title'              => 'Full Width Block Button',
          ),
          array(
            'id'                 => 'content',
            'type'               => 'textarea', 
            'title'              => 'Features',
            'default'            => 'some~feature~here',
            'info'               => 'textarea, where each line will be imploded with comma (~)'
          ),
        )
      ),


      //                         ==========================================
      // TABLE
      //                         ==========================================
      'cs_table'                 => array(
        'title'                  => 'Table',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'striped',
            'type'               => 'on_off', 
            'title'              => 'Striped rows',
          ),
          array(
            'id'                 => 'bordered',
            'type'               => 'on_off', 
            'title'              => 'Bordered',
          ),
          array(
            'id'                 => 'hover',
            'type'               => 'on_off', 
            'title'              => 'Hover rows',
          ),
          array(
            'id'                 => 'condensed',
            'type'               => 'on_off', 
            'title'              => 'Condensed',
          ),
          array(
            'id'                 => 'responsive',
            'type'               => 'on_off', 
            'title'              => 'Responsive',
          ),
          array(
            'id'                 => 'content',
            'type'               => 'textarea', 
            'title'              => 'Content',
            'default'            => '<table>
 <thead>
  <tr>
   <th>#</th>
   <th>First Name</th>
   <th>Last Name</th>
   <th>Username</th>
  </tr>
 </thead>
 <tbody>
  <tr>
   <td>1</td>
   <td>Mark</td>
   <td>Otto</td>
   <td>@mdo</td>
  </tr>
  <tr>
   <td>2</td>
   <td>Jacob</td>
   <td>Thornton</td>
   <td>@fat</td>
  </tr>
 </tbody>
 </table>',
       'attributes'              => array(
          'rows'                 => 20,
        )
          ),
        ),
      ),

    )
  ),

  'others'                       => array(
    'title'                      => 'Others',
    'shortcodes'                 => array(

      //                         ==========================================
      // TOOLTIP
      //                         ==========================================
      'cs_tooltip'               => array(
        'title'                  => 'ToolTip',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'selector',
            'type'               => 'text', 
            'title'              => 'Unique ID',
            'default'            => 'tooltip_'. uniqid(),
            'info'               => 'Copy-paste this unique id for any element class attribute',
          ),
          array(
            'id'                 => 'placement',
            'type'               => 'select', 
            'title'              => 'Placement',
            'options'            => array(
              'top'              => 'Top',
              'bottom'           => 'Bottom',
              'left'             => 'Left',
              'right'            => 'Right',
              'auto'             => 'Auto',
            ),
            'info'               => 'how to position the tooltip - top | bottom | left | right | auto. When "auto" is specified, it will dynamically reorient the tooltip.',
          ),
          array(
            'id'                 => 'trigger',
            'type'               => 'select', 
            'title'              => 'Trigger',
            'options'            => array(
              'hover'            => 'Hover',
              'focus'            => 'Focus',
              'click'            => 'Click',
            ),
            'info'               => 'how tooltip is triggered - click | hover | focus | manual',
          ),
          $cs_map_content,
        ),
      ),

      //                         ==========================================
      // POPOVER
      //                         ==========================================
      'cs_popover'               => array(
        'title'                  => 'Popover',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'selector',
            'type'               => 'text', 
            'title'              => 'Unique ID',
            'default'            => 'popover_'. uniqid(),
            'info'               => 'Copy-paste this unique id for any element class attribute',
          ),
          array(
            'id'                 => 'placement',
            'type'               => 'select', 
            'title'              => 'Placement',
            'options'            => array(
              'top'              => 'Top',
              'bottom'           => 'Bottom',
              'left'             => 'Left',
              'right'            => 'Right',
              'auto'             => 'Auto',
            ),
            'info'               => 'how to position the tooltip - top | bottom | left | right | auto. When "auto" is specified, it will dynamically reorient the tooltip.',
          ),
          array(
            'id'                 => 'trigger',
            'type'               => 'select', 
            'title'              => 'Trigger',
            'options'            => array(
              'hover'            => 'Hover',
              'focus'            => 'Focus',
              'click'            => 'Click',
            ),
            'info'               => 'how tooltip is triggered - click | hover | focus | manual',
          ),
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'Title',
          ),
          $cs_map_content,
        ),
      ),

      //                         ==========================================
      // MODAL
      //                         ==========================================
      'cs_modal'                 => array(
        'title'                  => 'Modal',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'id',
            'type'               => 'text', 
            'title'              => 'Unique ID',
            'default'            => 'modal_'. uniqid(),
            'info'               => 'Copy-paste this unique id for any element class attribute',
          ),
          array(
            'id'                 => 'center',
            'type'               => 'on_off', 
            'title'              => 'Open modal in center',
          ),
          array(
            'id'                 => 'size',
            'type'               => 'select', 
            'title'              => 'Modal Size',
            'options'            => array(
              'lg'               => 'Large',
              'sm'               => 'Small',
            ),
          ),
          array(
            'id'                 => 'title',
            'type'               => 'text', 
            'title'              => 'Title',
          ),
          $cs_map_content,
        ),
      ),

      //                         ==========================================
      // BlockQuote
      //                         ==========================================
      'cs_blockquote'            => array(
        'title'                  => 'BlockQuote',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'cite',
            'type'               => 'text', 
            'title'              => 'Cite',
          ),
          array(
            'id'                 => 'type',
            'type'               => 'select', 
            'title'              => 'Type',
            'options'            => array(
              ''                 => 'Select a type',
              'left'             => 'Quote Left Half',
              'right'            => 'Quote Right Half',
            ),
          ),
          array(
            'id'                 => 'border_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Border Color',
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'icon', 
            'title'              => 'Use Quote Icon',
          ),
          array(
            'id'                 => 'icon_color',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Color',
          ),
          array(
            'id'                 => 'icon_size',
            'type'               => 'color_picker', 
            'title'              => 'Custom Icon Size',
          ),
          $cs_map_content,
        ),
      ),

      //                         ==========================================
      // GOOGLE MAP
      //                         ==========================================
      'cs_gmap'                  => array(
        'title'                  => 'Google Map',
        'view'                   => 'single',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'latitude',
            'type'               => 'text', 
            'title'              => 'Latitude',
          ),
          array(
            'id'                 => 'longitude',
            'type'               => 'text', 
            'title'              => 'Longitude',
          ),
          array(
            'id'                 => 'map_type',
            'type'               => 'select', 
            'title'              => 'Map Type',
            'options'            => array(
              'roadmap'          => 'Roadmap',
              'terrain'          => 'Terrain',
              'satellite'        => 'Satellite',
              'hybrid'           => 'Hybrid',
            ),
          ),
          array(
            'id'                 => 'zoom',
            'type'               => 'text', 
            'title'              => 'Zoom Level',
            'default'            => 15,
          ),
          array(
            'id'                 => 'height',
            'type'               => 'text', 
            'title'              => 'Map Static-Height',
          ),
          array(
            'id'                 => 'no_zoom',
            'type'               => 'on_off', 
            'title'              => 'Disable Zoom Control',
          ),
          array(
            'id'                 => 'no_border',
            'type'               => 'on_off', 
            'title'              => 'No Bordered',
          ),
          array(
            'id'                 => 'no_scrollwheel',
            'type'               => 'on_off', 
            'title'              => 'Disable Scrollwheel',
          ),
          array(
            'id'                 => 'icon',
            'type'               => 'upload', 
            'title'              => 'Marker Icon',
          ),
          array(
            'id'                 => 'markers',
            'type'               => 'textarea', 
            'title'              => 'Markers',
            'attributes'         => array(
              'placeholder'      => '40.7080276|-74.0098655|Route Ltd #1~
40.7060000|-74.0060000|Route Ltd #2',
            ),
            'info'               => 'textarea, where each line will be imploded with comma (~)'
          ),
        ),
      ),

      //                         ==========================================
      // CAROUSEL CONTENTS
      //                         ==========================================
      'cs_carousel'              => array(
        'title'                  => 'Carousel Contents',
        'view'                   => 'flexible',
        'clone_id'               => 'cs_carousel_item',
        'clone_title'            => 'Add New Carousel Item',
        'shortcode_atts'         => array(
          array(
            'id'                 => 'min',
            'type'               => 'text', 
            'title'              => 'Min Items',
            'default'            => 1,
          ),
          array(
            'id'                 => 'max',
            'type'               => 'text', 
            'title'              => 'Max Items',
            'default'            => 4,
          ),
          array(
            'id'                 => 'items_width',
            'type'               => 'text', 
            'title'              => 'Items Width',
            'default'            => 225
          ),
          array(
            'id'                 => 'items_scroll',
            'type'               => 'text', 
            'title'              => 'Items Per Scroll',
            'default'            => 1
          ),
          array(
            'id'                 => 'delay',
            'type'               => 'text', 
            'title'              => 'Autoplay Delay',
            'default'            => 3
          ),
          array(
            'id'                 => 'no_padding',
            'type'               => 'on_off', 
            'title'              => 'No Items Padding',
          ),
          array(
            'id'                 => 'no_mousewheel',
            'type'               => 'on_off', 
            'title'              => 'No MouseWheel',
          ),
          array(
            'id'                 => 'no_swipe',
            'type'               => 'on_off', 
            'title'              => 'No Swipe',
          ),
          array(
            'id'                 => 'no_autoplay',
            'type'               => 'on_off', 
            'title'              => 'No Autoplay',
          ),
          array(
            'id'                 => 'no_nav',
            'type'               => 'on_off', 
            'title'              => 'No Navigation',
          ),
          array(
            'id'                 => 'nav_bottom',
            'type'               => 'on_off', 
            'title'              => 'Move Nav Bottom',
            'dependency'         => array('no_nav', '!=', ''),
          ),
          array(
            'id'                 => 'nav_pos',
            'type'               => 'select', 
            'title'              => 'Navigation Position',
            'options'            => array(
              ''                 => 'Center',
              'left'             => 'Left',
              'right'            => 'Right',
              'fluid'            => 'Fluid',
            ),
            'dependency'         => array('no_nav', '!=', ''),
          ),

        ),
        'multiple_atts'          => array(
          $cs_map_content
        )
      ),


    )
  ),


);

new CSFramework_Shortcodes_API( $cs_shortcodes );