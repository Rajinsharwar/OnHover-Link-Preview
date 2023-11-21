<?php
/*
 * Plugin Name: OnHover Link Preview
 * Description: WordPress plugin for showing the link preview on mouse-hover.
 * Version: 1.0
 * Requires at least: 5.9
 * Author: Rajin Sharwar
 * Author URI: https://profiles.wordpress.org/rajinsharwar
 * Text Domain: on-hover-link-prev
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Enqueue Frontend Scripts.
 *
 * @since 1.0
 */

function on_hover_link_prev_script() {
    $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

    wp_enqueue_script('link-preview-script', plugin_dir_url(__FILE__) . "assets/link-preview$suffix.js", array('jquery'), on_hover_link_prev_plugin_version(), true);

    wp_localize_script('link-preview-script', 'link_preview_vars', array(
        'mshots_url' => 'https://s0.wp.com/mshots/v1/',
        'width' => get_option('preview_box_size'),
        'excluded_elements' => get_option('excluded_elements'),
        'excluded_classes' => get_option('excluded_classes'),
        'excluded_ids' => get_option('excluded_ids'),
    ));
}

add_action('wp_enqueue_scripts', 'on_hover_link_prev_script');


/**
 * Enqueue Backend Scripts.
 *
 * @since 1.0
 */

function on_hover_link_prev_adm_style() {
    wp_enqueue_style( 'link-preview-script', plugin_dir_url(__FILE__) . 'assets/link-preview.css', array(), on_hover_link_prev_plugin_version(), 'all' );
}
add_action( 'admin_enqueue_scripts', 'on_hover_link_prev_adm_style' );


/**
 * Get plugin version.
 *
 * @since 1.0
 */

function on_hover_link_prev_plugin_version() {
    if( !function_exists('get_plugin_data') ){
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }
    $plugin_path = plugin_dir_url(__FILE__);
    $plugin_data = get_plugin_data(plugin_dir_path(__FILE__) . 'on-hover-link-prev.php'); 
    return $plugin_data['Version'];
}


/**
 * Add menu Page.
 *
 * @since 1.0
 */

function on_hover_link_prev_plugin_menu() {
    add_menu_page(
        'Link Preview Settings',
        'Link Preview',
        'manage_options',
        'on-hover-link-prev-settings',
        'on_hover_link_prev_plugin_page',
        'dashicons-admin-links'
    );
}
add_action('admin_menu', 'on_hover_link_prev_plugin_menu');


/**
 * Creating Admin Page.
 *
 * @since 1.0
 */

function on_hover_link_prev_plugin_page() {
    if (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
        echo '<div id="message" class="updated notice is-dismissible"><p>Settings saved.</p></div>';
    }
    ?>
    <div class="wrap">
        <h2>Link Preview Settings</h2>
        <div class="on-hover-link-prev-warning">
            <p class="on-hover-link-prev-warning-text"> By default, the preview for the links are shown for all &lt;a&gt; tags for the pages. This excludes the header, footer, nav-menu links etc, also any excludes any Images with a link (&lt;img&gt tag). If you want any specific HTML Elements, Classes, or IDs to be excluded from showing the Link Preview on hover, please enter those below separated by commas. Learn more <a href="https://www.w3schools.com/css/css_selectors.asp" target="_blank" >about the CSS selectors from here</a>.</p>
        </div>
        <form method="post" action="options.php">
            <?php settings_fields('on_hover_link_prev_settings'); ?>
            <?php do_settings_sections('on_hover_link_prev_settings'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Preview Box Size</th>
                    <td>
                        <input type="number" name="preview_box_size" value="<?php echo esc_attr(get_option('preview_box_size', 400)); ?>" min="1" required />
                        <p class="description">Enter the size of the preview box (default is 400).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Excluded Elements</th>
                    <td>
                        <input type="text" name="excluded_elements" value="<?php echo esc_attr(get_option('excluded_elements')); ?>" size="50" />
                        <p class="description">Enter the HTML elements you want to exclude, separated by commas (Ex: <b>h1, h2, span, p</b>).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Excluded Classes</th>
                    <td>
                        <input type="text" name="excluded_classes" value="<?php echo esc_attr(get_option('excluded_classes')); ?>" size="50" />
                        <p class="description">Enter the CSS classes you want to exclude, separated by commas. Remember to include the DOT. (Ex: <b>.my-class, .another-class</b>).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Excluded IDs</th>
                    <td>
                        <input type="text" name="excluded_ids" value="<?php echo esc_attr(get_option('excluded_ids')); ?>" size="50" />
                        <p class="description">Enter the HTML IDs you want to exclude, separated by commas. Remember to include the HASH. (Ex: <b>#my-id, #another-id</b>).</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}


/**
 * Save Admin options.
 *
 * @since 1.0
 */

function on_hover_link_prev_settings() {
    register_setting('on_hover_link_prev_settings', 'excluded_elements', 'sanitize_text_field');
    register_setting('on_hover_link_prev_settings', 'excluded_classes', 'sanitize_text_field');
    register_setting('on_hover_link_prev_settings', 'excluded_ids', 'sanitize_text_field');
    register_setting('on_hover_link_prev_settings', 'preview_box_size', 'intval');
}
add_action('admin_init', 'on_hover_link_prev_settings');
