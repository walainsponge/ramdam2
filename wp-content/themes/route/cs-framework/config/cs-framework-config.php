<?php
/**
 *
 * CSFramework Config
 * @since 1.0.0
 * @version 1.0.0
 *
 */
$sections = array();

// top bar
// -----------------------------------------------------------------------------------------
$top_bar_fields = array(
  array(
    'id'             => 'module',
    'type'           => 'select',
    'title'          => 'Module',
    'options'        => array(
      'text'         => 'Text',
      'link'         => 'Link',
      'social'       => 'Social',
      'modal'        => 'Modal',
      'search'       => 'Search',
      'wplogin'      => 'WP Login',
      'wpml'         => 'WPML Language Switcher',
      'qtranslate'   => 'qTranslate Language Switcher',
      'polylang'     => 'Polylang Language Switcher',
    ),
    'default_option' => 'Choose a Module',
  ),
  array(
    'id'             => 'icon',
    'type'           => 'icon',
    'title'          => 'Icon',
    'dependency'     => array('module', 'any', '["text", "link", "social", "modal"]'),
  ),
  array(
    'id'             => 'text',
    'type'           => 'text',
    'title'          => 'Text',
    'multilang'      => true,
    'dependency'     => array('module', 'any', '["text", "link", "modal"]'),
  ),
  array(
    'id'             => 'content',
    'type'           => 'textarea',
    'title'          => 'Content',
    'shortcode'      => true,
    'multilang'      => true,
    'attributes'     => array( 'rows' => 10 ),
    'dependency'     => array('module', '==', 'modal'),
  ),
  array(
    'id'             => 'link',
    'type'           => 'text',
    'title'          => 'Link URL',
    'attributes'     => array(
      'placeholder'  => 'http://'
    ),
    'multilang'      => true,
    'dependency'     => array('module', 'any', '["link", "social"]'),
  ),
  array(
    'id'             => 'target',
    'type'           => 'select',
    'title'          => 'Link Target',
    'options'        => array(
      ''             => '_self',
      '_blank'       => '_blank',
    ),
    'dependency'     => array('module', 'any', '["link", "social"]'),
  ),
  array(
    'id'             => 'check',
    'type'           => 'on_off',
    'title'          => 'Hide <small>( is user logged in )</small>',
    'label'          => 'Hide this module if is user logged in!',
    'dependency'     => array('module', '!=', ''),
  ),
);


//
// Woo Modules adding if plugin activated
// ---------------------------------------------------------------------------------------------------
if( is_woocommerce_activated() ) {

  $woo_modules = array(
    'woologin'     => 'WooCommerce Login & Logout',
    'woocount'     => 'WooCommerce Cart Count',
    'wooprice'     => 'WooCommerce Cart Count and Price',
    'woominicart'  => 'WooCommerce Mini Cart',
  );

  $top_bar_fields[0]['options'] = cs_array_insert( $top_bar_fields[0]['options'], $woo_modules );

}

$sections['top_bar']    = array(
  'title'               => 'Top Bar',
  'desc'                => 'Top bar block settings',
  'fields'              => array(
    array(
      'id'              => 'top_bar',
      'type'            => 'on_off',
      'title'           => 'Top Bar',
      'default'         => 1,
    ),
    array(
      'id'              => 'top_left',
      'title'           => 'Top Left Block',
      'desc'            => 'Top bar left block. Just add a module. so easy.<br />also you can drag drop position',
      'type'            => 'group',
      'fields'          => $top_bar_fields,
      'accordion'       => true,
      'button_title'    => 'Add New Module',
      'accordion_title' => 'New Module',
      'default'         => array(
        array(
          'module'      => 'text',
          'icon'        => 'fa-phone',
          'text'        => 'Call us Today 0800 555 5555',
          'link'        => '',
          'target'      => '',
          'content'     => '',
        ),
        array(
          'module'      => 'link',
          'icon'        => 'fa-envelope-o',
          'text'        => 'info@domain.com',
          'link'        => 'mailto:info@domain.com',
          'target'      => '',
          'content'     => '',
        ),
      )
    ),
    array(
      'id'              => 'top_right',
      'title'           => 'Top Right Block',
      'desc'            => 'Top bar right block. Just add a module. so easy.<br />also you can drag drop position',
      'type'            => 'group',
      'fields'          => $top_bar_fields,
      'accordion'       => true,
      'button_title'    => 'Add New Module',
      'accordion_title' => 'New Module',
      'default'         => array(
        array(
          'module'      => 'social',
          'icon'        => 'fa-facebook',
          'text'        => '',
          'link'        => 'https://facebook.com/envato',
          'target'      => '_blank',
          'content'     => '',
        ),
        array(
          'module'      => 'social',
          'icon'        => 'fa-twitter',
          'text'        => '',
          'link'        => 'https://twitter.com/envato',
          'target'      => '_blank',
          'content'     => '',
        ),
        array(
          'module'      => 'social',
          'icon'        => 'fa-google-plus',
          'text'        => '',
          'link'        => 'https://plus.google.com/+envato',
          'target'      => '_blank',
          'content'     => '',
        ),
        array(
          'module'      => 'link',
          'icon'        => 'fa-star-o',
          'text'        => 'Codestar',
          'link'        => 'http://themeforest.net/user/Codestar/portfolio',
          'target'      => '_blank',
          'content'     => '',
        ),
      )
    ),
  ),
);

// Header
// -----------------------------------------------------------------------------------------
$sections['header'] = array(
  'title'           => 'Header',
  'desc'            => 'Main menu and header settings from here. Select your header model!',
  'fields'          => array(
    array(
      'id'          => 'logo',
      'type'        => 'upload',
      'title'       => 'Site Logo',
    ),
    array(
      'id'          => 'logo2x',
      'type'        => 'upload',
      'title'       => 'Site Logo @2x for Retina',
    ),
    array(
      'id'          => 'logo_alt',
      'type'        => 'upload',
      'title'       => 'Transparency Logo',
      'info'        => 'Advising a white (lightness) logo for transparent header',
    ),
    array(
      'id'          => 'logo2x_alt',
      'type'        => 'upload',
      'title'       => 'Transparency Logo @2x for Retina',
      'info'        => 'Advising a white (lightness) logo for transparent header',
    ),
    array(
      'id'          => 'favicon',
      'type'        => 'upload',
      'title'       => 'Favicon',
    ),
    array(
      'id'          => 'logo_text',
      'type'        => 'text',
      'title'       => 'Site Logo Text',
      'default'     => get_bloginfo( 'name' ),
      'info'        => 'This is optional if you upload any logo, this is will disable...',
    ),
    array(
      'id'          => 'logo_top',
      'type'        => 'number',
      'title'       => 'Logo Padding-Top',
      'attributes'  => array( 'placeholder' => 5 ),
      'unit'        => 'px',
    ),
    array(
      'id'          => 'logo_bottom',
      'type'        => 'number',
      'title'       => 'Logo Padding-Bottom',
      'attributes'  => array( 'placeholder' => 5 ),
      'unit'        => 'px',
    ),
    array(
      'id'          => 'header_height',
      'type'        => 'number',
      'title'       => 'Header Height',
      'attributes'  => array( 'placeholder' => 100 ),
      'unit'        => 'px',
    ),
    array(
      'id'          => 'header_height_sticky',
      'type'        => 'number',
      'title'       => 'Header Height in Sticky',
      'attributes'  => array( 'placeholder' => 50 ),
      'unit'        => 'px',
    ),
    array(
      'id'          => 'menu_max_width',
      'type'        => 'number',
      'title'       => 'Disable menu in max-width',
      'default'     => 992,
      'unit'        => 'viewport',
      'info'        => 'so you can set it eg. 1200, 992, 768 or any width etc..'
    ),
    array(
      'id'          => 'header_sticky',
      'type'        => 'on_off',
      'title'       => 'Sticky Header',
      'default'     => 1
    ),
    array(
      'id'          => 'menu_search',
      'type'        => 'on_off',
      'title'       => 'Show Search on Menu',
      'default'     => 1
    ),
    array(
      'id'          => 'menu_down_icon',
      'type'        => 'on_off',
      'title'       => 'Show dropdown icon',
      'info'        => 'Show icon ( <i class="fa fa-angle-down"></i> )',
      'default'     => 1
    ),
    array(
      'id'          => 'visible_top_bar',
      'type'        => 'on_off',
      'title'       => 'Show top-bar in small-screen',
    ),
    array(
      'id'          => 'menu_effect',
      'type'        => 'select',
      'title'       => 'Header Menu Hover Effect',
      'options'     => array(
        1           => 'Effect 1',
        2           => 'Effect 2',
        3           => 'Effect 3',
        4           => 'Effect 4',
        5           => 'Effect 5',
        6           => 'Effect 6',
        7           => 'Effect 7',
        'none'      => 'No Effect',
      ),
      'default'     => 1
    ),
    array(
      'id'          => 'header_style',
      'type'        => 'select',
      'title'       => 'Header Style',
      'options'     => array(
        'default'   => 'Style 1 Default',
        'left'      => 'Style 2 Left',
        'center'    => 'Style 3 Center',
      ),
      'default'     => 'default'
    ),
  )
);

// Blog
// -----------------------------------------------------------------------------------------
$sections['blog']      = array(
  'title'              => 'Blog',
  'desc'               => 'Front-End Blog Options, This blog setting for default posts loop.',
  'fields'             => array(
    array(
      'id'             => 'blog_layout',
      'type'           => 'select',
      'title'          => 'Blog Layout',
      'options'        => array(
        'default'      => 'Blog Large Image',
        'medium'       => 'Blog Medium Image',
        'small'        => 'Blog Small Image',
        'masonry'      => 'Blog Masonry',
        'grid'         => 'Blog Grid',
      ),
      'default'        => 'default',
    ),
    array(
      'id'             => 'blog_column',
      'type'           => 'select',
      'title'          => 'Blog Columns',
      'options'        => array(
        2              => '2 Columns',
        3              => '3 Columns',
        4              => '4 Columns',
        6              => '6 Columns',
      ),
      'default'        => 3,
      'dependency'     => array('blog_layout', 'any', '["masonry", "grid"]'),
    ),
    array(
      'id'             => 'blog_sidebar',
      'type'           => 'select',
      'title'          => 'Blog Sidebar',
      'options'        => array(
        'right'        => 'Right Sidebar',
        'left'         => 'Left Sidebar',
        'full'         => 'No Sidebar',
      ),
      'default'        => 'right',
    ),
    array(
      'id'             => 'blog_widget',
      'type'           => 'select',
      'title'          => 'Blog Sidebar Widget',
      'options'        => cs_wp_registered_sidebars(),
      'default_option' => 'Select a sidebar (default primary)',
      'dependency'     => array('blog_sidebar', 'any', '["right", "left"]'),
    ),
    array(
      'id'             => 'blog_image_size',
      'type'           => 'select',
      'title'          => 'Blog Featured Image Size',
      'options'        => cs_get_image_sizes( true, false ),
      'default'        => 'blog-large-image',
    ),
    array(
      'id'             => 'blog_pagination',
      'type'           => 'select',
      'title'          => 'Blog Pagination',
      'options'        => array(
        'pagination'   => 'Pagination (default)',
        'load'         => 'Load More',
        'hide'         => 'Hide',
      ),
      'default'        => 'pagination',
    ),
    array(
      'id'             => 'blog_auto_excerpt',
      'type'           => 'on_off',
      'title'          => 'Blog Automatically Excerpt',
      'info'           => 'A little summary from post content as automatically',
    ),
    array(
      'id'             => 'blog_excerpt_world_limit',
      'type'           => 'text',
      'title'          => 'Blog Excerpt Word Limit',
      'attributes'     => array(
        'placeholder'  => 55,
      ),
      'dependency'     => array('blog_auto_excerpt', '==', 'true'),
    ),
    array(
      'id'             => 'heading',
      'type'           => 'heading',
      'content'        => 'Blog Single Options',
    ),
    array(
      'id'             => 'blog_single_image_show',
      'type'           => 'on_off',
      'title'          => 'Show Featured Image in Blog Single',
      'default'        => 1,
    ),
    array(
      'id'             => 'blog_single_image_size',
      'type'           => 'select',
      'title'          => 'Blog Single Featured Image Size',
      'options'        => cs_get_image_sizes( true, false ),
      'default'        => 'blog-large-image',
      'dependency'     => array('blog_single_image_show', '==', 'true'),
    ),
    array(
      'id'             => 'single_recents',
      'type'           => 'select',
      'title'          => 'Single Recent Posts',
      'options'        => array(
        'recent'       => 'Recent Posts',
        'related'      => 'Related Posts',
        'random'       => 'Random Posts',
        'commented'    => 'Most Commented Posts',
        'loved'        => 'Most Loved Posts',
      ),
      'default'        => 'random',
    ),
    array(
      'id'             => 'single_recents_title',
      'type'           => 'text',
      'title'          => 'Single Recent Title',
      'multilang'      => true,
    ),
    array(
      'id'             => 'blog_single_author',
      'type'           => 'on_off',
      'title'          => 'About Author',
      'default'        => 1,
    ),
    array(
      'id'             => 'blog_single_recents',
      'type'           => 'on_off',
      'title'          => 'Recent Posts',
      'default'        => 1,
    ),
    array(
      'id'             => 'blog_single_navigation',
      'type'           => 'on_off',
      'title'          => 'Post Navigation',
      'default'        => 1,
    ),
  )
);

// Portfolio
// -----------------------------------------------------------------------------------------
$sections['portfolio'] = array(
  'title'             => 'Portfolio',
  'desc'              => 'Portfolio Permalink Options',
  'fields'            => array(
    array(
      'id'            => 'portfolio_comment',
      'type'          => 'on_off',
      'title'         => 'Show Portfolio Item Comments',
      'info'          => 'Enable Comment Form on Portfolio Items',
    ),
    array(
      'id'            => 'portfolio_search',
      'type'          => 'on_off',
      'title'         => 'Show Portfolio Item on Search Results',
      'info'          => 'Enable Portfolio Items on Site Search Results',
    ),
    array(
      'id'            => 'portfolio_nav',
      'type'          => 'on_off',
      'title'         => 'Disable Portfolio Navigation',
      'info'          => 'Disable Portfolio Left/Right Nav on Item Detail Page',
    ),
    array(
      'id'            => 'portfolio_item_slug',
      'type'          => 'text',
      'title'         => 'Portfolio Item Slug',
      'attributes'    => array(
        'placeholder' => 'portfolio-item',
      ),
    ),
    array(
      'id'            => 'portfolio_category_slug',
      'type'          => 'text',
      'title'         => 'Portfolio Category Slug',
      'attributes'    => array(
        'placeholder' => 'portfolio-category',
      ),
    ),
    array(
      'id'            => 'portfolio_tag_slug',
      'type'          => 'text',
      'title'         => 'Portfolio Tag Slug',
      'attributes'    => array(
        'placeholder' => 'portfolio-tag',
      ),
    ),
    array(
      'type'          => 'content',
      'content'       => '<div class="cs-alert cs-alert-info"><strong>Avoid Conflict</strong>: Please do not set slug name as a same page slug. Can not be same with a page slug name.</div>',
    ),
  )
);

// Footer
// -----------------------------------------------------------------------------------------
$sections['footer'] = array(
  'title'           => 'Footer',
  'desc'            => 'Footer and Copyright Options',
  'fields'          => array(
    array(
      'id'          => 'disable_footer',
      'type'        => 'on_off',
      'title'       => 'Disable Footer',
      'info'        => 'Disable footer widgets area in all pages.',
    ),

    array(
      'id'          => 'footer_block_before',
      'type'        => 'on_off',
      'title'       => 'Footer Block Before',
      'info'        => 'A full-width container footer block before',
    ),

    array(
      'id'          => 'footer_before',
      'type'        => 'on_off',
      'title'       => 'Footer Widgets Before',
      'info'        => 'A full-width widget before footer widgets',
    ),
    array(
      'id'          => 'footer_widgets',
      'type'        => 'image_select',
      'title'       => 'Footer Widgets',
      'desc'        => 'Go to Appearance -> <a href="'. admin_url('widgets.php') .'">Widgets</a> after create sidebars',
      'options'     => array(
        1           => FRAMEWORK_URI . '/config/widgets/model1.png',
        2           => FRAMEWORK_URI . '/config/widgets/model2.png',
        3           => FRAMEWORK_URI . '/config/widgets/model3.png',
        4           => FRAMEWORK_URI . '/config/widgets/model4.png',
        5           => FRAMEWORK_URI . '/config/widgets/model5.png',
        6           => FRAMEWORK_URI . '/config/widgets/model6.png',
        7           => FRAMEWORK_URI . '/config/widgets/model7.png',
        8           => FRAMEWORK_URI . '/config/widgets/model8.png',
        9           => FRAMEWORK_URI . '/config/widgets/model9.png',
        10          => FRAMEWORK_URI . '/config/widgets/model10.png',
      ),
      'default'     => 4,
    ),
    array(
      'id'          => 'footer_after',
      'type'        => 'on_off',
      'title'       => 'Footer Widgets After',
      'info'        => 'A full-width widget after footer widgets',
    ),

    array(
      'id'          => 'footer_block_after',
      'type'        => 'on_off',
      'title'       => 'Footer Block After',
      'info'        => 'A full-width container footer block after',
    ),

    array(
      'id'          => 'heading',
      'type'        => 'heading',
      'content'     => 'Copyright Settings',
    ),
    array(
      'id'          => 'disable_copyright',
      'type'        => 'on_off',
      'title'       => 'Disable Copyright',
      'info'        => 'Disable copyright area in all pages.',
    ),
    array(
      'id'          => 'copyright_text',
      'type'        => 'textarea',
      'title'       => 'Copyright',
      'shortcode'   => true,
      'multilang'   => true,
      'default'     => '<div class="pull-left">Copyright &copy; [cs_current_year]</div>
<div class="pull-right">Build with [cs_fa icon="heart" style="color: red"] WordPress</div>',
      'after'       => '<p class="cs-alert cs-alert-info">Helpful shortcodes: [cs_current_year] [cs_home_url] or any shortcode.</p>',
    ),
  )
);

// Skin
// -----------------------------------------------------------------------------------------
if( ! is_writable( THEME_CACHE_DIR ) ) {
  $is_writable = '<div class="cs-alert cs-alert-danger">Fatal Error: <strong>CACHE</strong> folder ( /'. str_replace( ABSPATH, '', THEME_DIR ) .'/<strong>cache</strong> ) is not writeable. Try to set <a href="http://codex.wordpress.org/Changing_File_Permissions" target="_blank"><strong>CHMOD</strong></a> 777 or 755 or do not use this!</div>';
} else {
  $is_writable = '<div class="cs-alert cs-alert-success">Successful. <strong>CACHE</strong> folder ( /'. str_replace( ABSPATH, '', THEME_DIR ) .'/<strong>cache</strong> ) is writeable. you use it!</div>';
}

$sections['skin']  = array(
  'title'          => 'Skin',
  'desc'           => 'Choose your theme skin, use a predefined skin or create your own skin!',
  'fields'         => array(
    array(
      'id'         => 'skin',
      'type'       => 'select',
      'title'      => 'Skin',
      'options'    => array(
        'default'  => 'Default',
        'accent'   => 'Accent Color',
        'custom'   => 'Build own skin',
      ),
      'default'    => 'default',
    ),
    array(
      'type'       => 'content',
      'content'    => '<div class="cs-alert cs-alert-warning"><strong>"Default"</strong>, default mod using default style.css files no any dynamic colors</div>',
      'dependency' => array('skin', '==', 'default'),
    ),
    array(
      'type'       => 'content',
      'content'    => '<div class="cs-alert cs-alert-info"><strong>"Accent Color"</strong>, default is accent color method and can be changed accent color from <strong>Appearance > <a href="'. admin_url('customize.php') .'">Customize</a></strong></div>',
      'dependency' => array('skin', '==', 'accent'),
    ),
    array(
      'type'       => 'content',
      'content'    => '<div class="cs-alert cs-alert-success"><strong>"Build own skin"</strong>, Highly customizable method there is a lot of option in customize panel for your own skin. enjoy use them <strong>Appearance > <a href="'. admin_url('customize.php') .'">Customize</a></strong></div>',
      'dependency' => array('skin', '==', 'custom'),
    ),

    array(
      'id'         => 'cache_css',
      'type'       => 'on_off',
      'title'      => 'Cache Dynamic CSS',
      'info'       => 'Write dynamic styles inside a static custom.css on header'
    ),
    array(
      'type'       => 'content',
      'content'    => $is_writable,
      'dependency' => array('cache_css', '==', 'true'),
    ),
  )
);

// Typography
// -----------------------------------------------------------------------------------------
$sections['typography']     = array(
  'title'                   => 'Typography',
  'desc'                    => 'Typography Settings',
  'fields'                  => array(

    array(
      'id'                  => 'typography',
      'type'                => 'group',
      'fields'              => array(
        array(
          'id'              => 'title',
          'type'            => 'text',
          'title'           => 'Title',
        ),
        array(
          'id'              => 'selector',
          'type'            => 'text',
          'title'           => 'Selector',
          'info'            => 'body or .big-title or .fancy-title or .element1, .element2',
        ),
        array(
          'id'              => 'font',
          'type'            => 'typography',
          'title'           => 'Font Family',
          'default'         => array(
            'family'        => 'Open Sans',
            'variant'       => 'regular',
            'fontsize'      => false,
            'lineheight'    => false,
            'letterspacing' => false,
          ),
        ),
        array(
          'id'              => 'size',
          'type'            => 'text',
          'title'           => 'Font Size <em>(optional)</em>',
        ),
        array(
          'id'              => 'line_height',
          'type'            => 'text',
          'title'           => 'Line-Height <em>(optional)</em>',
        ),
        array(
          'id'              => 'css',
          'type'            => 'textarea',
          'title'           => 'Custom CSS <em>(optional)</em>',
        ),
      ),
      'accordion'           => true,
      'button_title'        => 'Add New Typography',
      'accordion_title'     => 'New Typography',
      'default'             => array(
        array(
          'title'           => 'Body Typography',
          'selector'        => 'body',
          'font'            => array(
            'family'        => 'Open Sans',
            'variant'       => 'regular',
          ),
          'size'            => '13px',
          'line_height'     => '1.65em',
        ),
        array(
          'title'           => 'Menu Typography',
          'selector'        => '#site-nav .cs-link',
          'font'            => array(
            'family'        => 'Open Sans',
            'variant'       => 'regular',
          ),
          'size'            => '13px',
        ),
        array(
          'title'           => 'Sub Menu Typography',
          'selector'        => '#site-nav ul li ul li .cs-link',
          'font'            => array(
            'family'        => 'Open Sans',
            'variant'       => 'regular',
          ),
          'size'            => '12px',
          'line_height'     => '1em',
        ),
        array(
          'title'           => 'Headings Typography',
          'selector'        => 'h1, h2, h3, h4, h5, h6',
          'font'            => array(
            'family'        => 'Open Sans',
            'variant'       => '600',
          ),
        ),
        array(
          'title'           => 'Open Sans Bold',
          'selector'        => '.cs-bold',
          'font'            => array(
            'family'        => 'Open Sans',
            'variant'       => '700',
          ),
        ),
        array(
          'title'           => 'Open Sans Extra Bold',
          'selector'        => '.cs-extra-bold',
          'font'            => array(
            'family'        => 'Open Sans',
            'variant'       => '800',
          ),
        ),
      ),
    ),
    array(
      'id'                  => 'subsets',
      'type'                => 'select',
      'title'               => 'Subsets',
      'class'               => 'chosen',
      'options'             => array(
        'latin'             => 'latin',
        'latin-ext'         => 'latin-ext',
        'cyrillic'          => 'cyrillic',
        'cyrillic-ext'      => 'cyrillic-ext',
        'greek'             => 'greek',
        'greek-ext'         => 'greek-ext',
        'vietnamese'        => 'vietnamese',
        'devanagari'        => 'devanagari',
        'khmer'             => 'khmer',
      ),
      'attributes'          => array(
        'data-placeholder'  => 'subsets',
        'multiple'          => 'multiple',
      ),
      'default'             => array( 'latin' ),
    ),

    array(
      'id'                 => 'font_family',
      'type'               => 'group',
      'title'              => 'Upload Custom Fonts',
      'button_title'       => 'Add New Custom Font',
      'accordion_title'    => 'Adding New Font',
      'accordion'          => true,
      'desc'               => 'It is simple. Only add your custom fonts and click to save. After you can check "Font Family" selector. Do not forget to Save!',
      'fields'             => array(

        array(
          'id'             => 'name',
          'type'           => 'text',
          'title'          => 'Font-Family Name',
          'attributes'     => array(
            'placeholder'  => 'for eg. Arial'
          ),
        ),

        array(
          'id'             => 'ttf',
          'type'           => 'upload',
          'title'          => 'Upload .ttf <small><i>(optional)</i></small>',
          'settings'       => array(
            'upload_type'  => 'font',
            'insert_title' => 'Use this Font-Format',
            'button_title' => 'Upload <i>.ttf</i>',
          ),
        ),

        array(
          'id'             => 'eot',
          'type'           => 'upload',
          'title'          => 'Upload .eot <small><i>(optional)</i></small>',
          'settings'       => array(
            'upload_type'  => 'font',
            'insert_title' => 'Use this Font-Format',
            'button_title' => 'Upload <i>.eot</i>',
          ),
        ),

        array(
          'id'             => 'svg',
          'type'           => 'upload',
          'title'          => 'Upload .svg <small><i>(optional)</i></small>',
          'settings'       => array(
            'upload_type'  => 'font',
            'insert_title' => 'Use this Font-Format',
            'button_title' => 'Upload <i>.svg</i>',
          ),
        ),

        array(
          'id'             => 'otf',
          'type'           => 'upload',
          'title'          => 'Upload .otf <small><i>(optional)</i></small>',
          'settings'       => array(
            'upload_type'  => 'font',
            'insert_title' => 'Use this Font-Format',
            'button_title' => 'Upload <i>.otf</i>',
          ),
        ),

        array(
          'id'             => 'woff',
          'type'           => 'upload',
          'title'          => 'Upload .woff <small><i>(optional)</i></small>',
          'settings'       => array(
            'upload_type'  => 'font',
            'insert_title' => 'Use this Font-Format',
            'button_title' => 'Upload <i>.woff</i>',
          ),
        ),

        array(
          'id'             => 'css',
          'type'           => 'textarea',
          'title'          => 'Extra CSS Style <small><i>(optional)</i></small>',
          'attributes'     => array(
            'placeholder'  => 'for eg. font-weight: normal;'
          ),
        ),

      ),
    ),

  )
);

// Sidebars
// -----------------------------------------------------------------------------------------
$sections['sidebars']   = array(
  'title'               => 'Sidebars',
  'desc'                => 'Add some custom sidebars',
  'fields'              => array(
    array(
      'id'              => 'sidebars',
      'title'           => 'Sidebars',
      'desc'            => 'Go to Appearance -> <a href="'. admin_url('widgets.php') .'">Widgets</a> after create sidebars',
      'type'            => 'group',
      'fields'          => array(
        array(
          'id'          => 'sidebar_name',
          'type'        => 'text',
          'title'       => 'Sidebar Name',
        )
      ),
      'accordion'       => true,
      'button_title'    => 'Add New Sidebar',
      'accordion_title' => 'New Sidebar',
    ),
  )
);

// Media
// -----------------------------------------------------------------------------------------
$sections['media']      = array(
  'title'               => 'Media',
  'desc'                => 'Media Image Sizes Settings',
  'fields'              => array(
    array(
      'id'              => 'custom_image_sizes',
      'type'            => 'group',
      'title'           => 'Add Image Size',
      'fields'          => array(
        array(
          'id'          => 'name',
          'type'        => 'text',
          'title'       => 'Size Name',
        ),
        array(
          'id'          => 'size',
          'type'        => 'dimensions',
          'title'       => 'Dimensions',
          'options'     => array(
            'width'     => 'Width <span class="cs-text-desc">(px)</span>',
            'height'    => 'Height <span class="cs-text-desc">(px)</span>',
          ),
          'settings'    => array(
            'min'       => 0,
            'max'       => 1600,
            'step'      => 1,
            'seperator' => 'x',
          ),
        ),
        array(
          'id'          => 'crop',
          'type'        => 'on_off',
          'title'       => 'Crop',
          'default'     => 1,
          'info'        => 'Whether to crop images to specified height and width or resize.',
        ),
      ),
      'accordion'       => true,
      'button_title'    => 'Add New Image Size',
      'accordion_title' => 'New Image Size',
      'default'         => array(
        array(
          'name'        => 'Blog Large Image',
          'size'        => array( 'width' => 848, 'height' => 300 ),
          'crop'        => 1
        ),
      ),
    ),
  )
);

// Extras
// -----------------------------------------------------------------------------------------
update_option( 'cs-installed', false );
$is_installed          = get_option( 'cs-installed' );
$one_click_content     = ( ! $is_installed ) ? '<div id="cs-one-click"><p><label><input id="cs-install-attachment" type="checkbox" value="1" />Download and import file attachments</label></p><span class="cs-spinner"></span><a id="cs-install" href="#" class="button button-primary">Install / Import Dump XML</a> <a id="cs-visit-site" href="'. home_url( '/' ) .'" class="button hidden" target="_blank">Visit Site</a><p id="cs-few-minutes" class="cs-text-desc hidden">This can take a few minutes. No Worries, Please Wait...</p></div>' : '<strong>You imported dump xml already.</strong>';

$sections['extras']    = array(
  'title'              => 'Extras',
  'desc'               => 'Extra Settings',
  'fields'             => array(
    array(
      'id'             => 'maintenance',
      'type'           => 'on_off',
      'title'          => 'Maintenance Mode',
      'info'           => 'Enable Maintenance Mode',
    ),
    array(
      'id'             => 'maintenance_page_id',
      'type'           => 'select',
      'title'          => 'Maintenance Mode Page',
      'options'        => 'pages',
      'query_args'     => array(
        'sort_order'   => 'DESC',
        'sort_column'  => 'post_date',
      ),
      'default_option' => 'Select a page for Maintance Mode',
      'dependency'     => array('maintenance', '==', 'true'),
    ),
    array(
      'id'             => 'mobile_animations',
      'type'           => 'on_off',
      'title'          => 'Disable Element Animations',
      'info'           => 'Stop animations on Mobile Devices',
    ),
    array(
      'id'             => 'icomoon',
      'type'           => 'on_off',
      'title'          => 'Icomoon Fonts',
      'info'           => 'Embed 1600+ icomoon fonts',
    ),
    array(
      'id'             => 'boxed_layout',
      'type'           => 'on_off',
      'title'          => 'Boxed Layout',
    ),
    array(
      'id'             => 'home_loader',
      'type'           => 'on_off',
      'title'          => 'Loader Homepage',
    ),
    array(
      'id'             => 'non_responsive',
      'type'           => 'on_off',
      'title'          => 'Disable Responsive Layout',
    ),
    array(
      'id'             => 'page_comment',
      'type'           => 'on_off',
      'title'          => 'Show Page Comments',
      'info'           => 'Enable Comment Form on Pages',
    ),
    array(
      'id'             => 'ga',
      'type'           => 'text',
      'title'          => 'Google Analytics - Tracking Code',
      'attributes'     => array(
        'placeholder'  => 'UA-12345678-9'
      ),
    ),
    array(
      'id'             => 'ga_position',
      'type'           => 'on_off',
      'title'          => 'Google Analytics Position',
      'info'           => 'Put Google Analytics code head, btw default position is footer',
      'dependency'     => array('ga', '!=', ''),
    ),
    array(
      'type'           => 'content',
      'title'          => 'One-Click Install',
      'desc'           => 'Think twice before a import dump xml.',
      'content'        => $one_click_content,
    ),
  )
);


// Custom CSS & JS
// -----------------------------------------------------------------------------------------
$sections['custom_css_js'] = array(
  'title'               => 'Custom CSS & JS',
  'fields'              => array(
    array(
      'id'             => 'heading',
      'type'           => 'heading',
      'content'        => 'Custom CSS',
    ),
    array(
      'id'              => 'custom_css',
      'type'            => 'textarea',
      'attributes'      => array(
        'rows'          => 25,
        'placeholder'   => '// do stuff'
      ),
    ),
    array(
      'id'             => 'heading',
      'type'           => 'heading',
      'content'        => 'Custom Javascript',
    ),
    array(
      'id'              => 'custom_js',
      'type'            => 'textarea',
      'attributes'      => array(
        'rows'          => 15,
        'placeholder'   => '// do stuff'
      ),
      'info'           => 'Do not include &lt;script>&lt;/script> tag.',
    ),
  )
);

// Backup
// -----------------------------------------------------------------------------------------
$sections['backup'] = array(
  'title'           => 'Export &amp; Import',
  'desc'            => 'Export - Import Options',
  'fields'          => array(
    array(
      'id'          => 'backup',
      'type'        => 'backup',
    ),
  )
);

// Auto Update
// -----------------------------------------------------------------------------------------
if ( function_exists( 'wp_get_theme' ) ) {

  $get_theme     = wp_get_theme();
  $current_theme = ( $get_theme->parent() ) ? $get_theme->parent()->Name : $get_theme->Name;

  if ( $current_theme == 'Route' ) {

    $sections['update'] = array(
      'title'       => 'Auto Update',
      'desc'        => 'Auto Theme Update via Envato API',
      'fields'      => array(
        array(
          'id'      => 'envato_username',
          'type'    => 'text',
          'title'   => 'Envato Username',
        ),
        array(
          'id'      => 'envato_apikey',
          'type'    => 'text',
          'title'   => 'Envato API-KEY',
          'class'   => 'text-security',
          'after'   => '<p>This field <strong><u>not meant</u></strong> your Envato password! Check twice.</p>'
        ),
        array(
          'type'    => 'content',
          'content' => '<div class="cs-alert cs-alert-info"><strong>How to Generate a Envato API-KEY</strong>: You will need to generate an API key to link your WordPress site to your Themeforest account. Login to Themeforest, go to your dashboard and click on <strong>"My Settings > API Keys"</strong> The API Keys screen allows you to generate a free API key. <a href="'. FRAMEWORK_ASSETS .'/images/how-to-get-api-key.jpg" target="_blank">Click for How to Generate a Envato Screenshot</a></div>',
        ),
        array(
          'type'    => 'content',
          'content' => '<div class="cs-alert cs-alert-danger"><strong>Avoid Missing Data</strong>: Please be sure for your changes files before update theme. Make a backup before update theme.</div>',
        ),
      )
    );

  }

}

$sections['vc_composer'] = array(
  'title'                  => 'Visual Composer',
  'desc'                   => 'Visual Composer Plugin Settings',
  'fields'                 => array(
    array(
      'id'                 => 'vc_exclude_shortcodes',
      'type'               => 'checkbox',
      'title'              => 'Exclude Route Modifications for:',
      'options'            => array(
        'vc_row'           => 'vc_row',
        'vc_column'        => 'vc_column',
        'vc_column_text'   => 'vc_column_text',
        'vc_tab'           => 'vc_tab',
        'vc_accordion'     => 'vc_accordion',
        'vc_toggle'        => 'vc_toggle',
      ),
      'info'               => 'We modifyed some shortcodes, you can exclude this modifications.',
    ),
  )
);

// WooCommerce Options
// -----------------------------------------------------------------------------------------
if( is_woocommerce_activated() ) {

  $sections['woocommerce'] = array(
    'title'                => 'WooCommerce',
    'desc'                 => 'WooCommerce settings!',
    'fields'               => array(
      array(
        'id'               => 'woo_menu_cart',
        'type'             => 'on_off',
        'title'            => 'Show Cart on Menu',
      ),
      array(
        'id'               => 'woo_product_sidebar',
        'type'             => 'on_off',
        'title'            => 'Sidebar in Single Product',
      ),
      array(
        'id'               => 'woo_convert_search',
        'type'             => 'on_off',
        'title'            => 'Convert Searches',
        'info'             => 'Set TOP and MENU searches for WooCommerce'
      ),
      array(
        'id'               => 'woo_loop_columns',
        'type'             => 'select',
        'title'            => 'Shop Columns',
        'options'          => array(
          2                => '2 Columns',
          3                => '3 Columns',
          4                => '4 Columns',
          6                => '6 Columns'
        ),
        'default'          => 4,
      ),
      array(
        'id'               => 'woo_related_columns',
        'type'             => 'select',
        'title'            => 'Related Columns',
        'options'          => array(
          2                => '2 Columns',
          3                => '3 Columns',
          4                => '4 Columns',
          6                => '6 Columns'
        ),
        'default'          => 4,
      ),
      array(
        'id'               => 'woo_upsells_columns',
        'type'             => 'select',
        'title'            => 'Up-Sells Columns',
        'options'          => array(
          2                => '2 Columns',
          3                => '3 Columns',
          4                => '4 Columns',
          6                => '6 Columns'
        ),
        'default'          => 4,
      ),
    )
  );

}

// bbPress Options
// -----------------------------------------------------------------------------------------
if( is_bbpress_activated() ) {

  $sections['bbpress'] = array(
    'title'                => 'bbPress',
    'desc'                 => 'bbPress Forum settings!',
    'fields'               => array(
      array(
        'id'             => 'bbpress_sidebar',
        'type'           => 'select',
        'title'          => 'bbPress Sidebar',
        'options'        => array(
          'right'        => 'Right Sidebar',
          'left'         => 'Left Sidebar',
          'full'         => 'No Sidebar',
        ),
        'default'        => 'full',
      ),
      array(
        'id'             => 'bbpress_widget',
        'type'           => 'select',
        'title'          => 'bbPress Sidebar Widget',
        'options'        => cs_wp_registered_sidebars(),
        'default'        => 'bbpress-forum',
        'dependency'     => array('bbpress_sidebar', 'any', '["right", "left"]'),
      ),
    )
  );

}

new CSFramework( $sections );