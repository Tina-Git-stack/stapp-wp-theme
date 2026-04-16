<?php
/**
 * STApp Responsive Blocks — PHP Backend
 *
 * - Enqueues editor JS/CSS and frontend CSS
 * - Renders inline <style> with media queries per block
 *
 * @package STApp_WP_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ──────────────────────────────────────────
   1. Enqueue editor assets
   ────────────────────────────────────────── */
add_action( 'enqueue_block_editor_assets', 'stapp_responsive_blocks_editor_assets' );

function stapp_responsive_blocks_editor_assets() {
    $theme_uri = get_template_directory_uri();
    $theme_dir = get_template_directory();

    wp_enqueue_script(
        'stapp-responsive-blocks',
        $theme_uri . '/assets/js/responsive-blocks.js',
        array( 'wp-blocks', 'wp-element', 'wp-hooks', 'wp-compose', 'wp-block-editor', 'wp-components', 'wp-i18n' ),
        filemtime( $theme_dir . '/assets/js/responsive-blocks.js' ),
        true
    );

    wp_enqueue_style(
        'stapp-responsive-blocks-editor',
        $theme_uri . '/assets/css/responsive-blocks-editor.css',
        array(),
        filemtime( $theme_dir . '/assets/css/responsive-blocks-editor.css' )
    );
}

/* ──────────────────────────────────────────
   2. Enqueue frontend stylesheet
   ────────────────────────────────────────── */
add_action( 'wp_enqueue_scripts', 'stapp_responsive_blocks_frontend_assets' );

function stapp_responsive_blocks_frontend_assets() {
    wp_enqueue_style(
        'stapp-responsive-blocks',
        get_template_directory_uri() . '/assets/css/responsive-blocks.css',
        array(),
        filemtime( get_template_directory() . '/assets/css/responsive-blocks.css' )
    );
}

/* ──────────────────────────────────────────
   3. render_block filter — inject inline CSS
   ────────────────────────────────────────── */
add_filter( 'render_block', 'stapp_responsive_blocks_render', 10, 2 );

function stapp_responsive_blocks_render( $block_content, $block ) {
    if ( empty( $block['attrs']['stappResponsive'] ) ) {
        return $block_content;
    }

    $responsive = $block['attrs']['stappResponsive'];

    // Check if any values are actually set
    $has_values = false;
    foreach ( array( 'desktop', 'tablet', 'mobile' ) as $bp ) {
        if ( empty( $responsive[ $bp ] ) || ! is_array( $responsive[ $bp ] ) ) {
            continue;
        }
        foreach ( $responsive[ $bp ] as $key => $val ) {
            if ( $val !== '' && $val !== 'visible' ) {
                $has_values = true;
                break 2;
            }
        }
    }

    if ( ! $has_values ) {
        return $block_content;
    }

    // Generate a unique class name
    $hash  = substr( md5( wp_json_encode( $responsive ) . uniqid() ), 0, 7 );
    $class = 'stapp-rb-' . $hash;

    // CSS property mapping
    $prop_map = array(
        'paddingTop'    => 'padding-top',
        'paddingBottom' => 'padding-bottom',
        'paddingLeft'   => 'padding-left',
        'paddingRight'  => 'padding-right',
        'marginTop'     => 'margin-top',
        'marginBottom'  => 'margin-bottom',
        'fontSize'      => 'font-size',
        'maxWidth'      => 'max-width',
    );

    // Build CSS per breakpoint
    $desktop_css = stapp_responsive_build_declarations( $responsive, 'desktop', $prop_map, $class );
    $tablet_css  = stapp_responsive_build_declarations( $responsive, 'tablet',  $prop_map, $class );
    $mobile_css  = stapp_responsive_build_declarations( $responsive, 'mobile',  $prop_map, $class );

    $style = '';
    if ( $desktop_css ) {
        $style .= '.' . $class . '{' . $desktop_css . '}';
    }
    if ( $tablet_css ) {
        $style .= '@media(max-width:768px){.' . $class . '{' . $tablet_css . '}}';
    }
    if ( $mobile_css ) {
        $style .= '@media(max-width:480px){.' . $class . '{' . $mobile_css . '}}';
    }

    if ( empty( $style ) ) {
        return $block_content;
    }

    // Inject class into the first HTML tag of the block
    $block_content = preg_replace(
        '/^(<\w+\s)/',
        '$1class="' . esc_attr( $class ) . '" ',
        $block_content,
        1,
        $count
    );

    // If the tag already has a class attribute, merge instead
    if ( 0 === $count ) {
        $block_content = preg_replace(
            '/^(<\w+[^>]*?\bclass=["\'])/',
            '$1' . esc_attr( $class ) . ' ',
            $block_content,
            1
        );
    }

    return '<style>' . $style . '</style>' . "\n" . $block_content;
}

/**
 * Build CSS declarations string for one breakpoint.
 */
function stapp_responsive_build_declarations( $responsive, $bp, $prop_map, $class ) {
    if ( empty( $responsive[ $bp ] ) || ! is_array( $responsive[ $bp ] ) ) {
        return '';
    }

    $vals = $responsive[ $bp ];
    $css  = '';

    foreach ( $prop_map as $attr_key => $css_prop ) {
        if ( ! empty( $vals[ $attr_key ] ) ) {
            $css .= $css_prop . ':' . esc_attr( $vals[ $attr_key ] ) . ';';
        }
    }

    // Visibility: hidden → display:none
    if ( isset( $vals['display'] ) && 'hidden' === $vals['display'] ) {
        $css .= 'display:none!important;';
    }

    return $css;
}
