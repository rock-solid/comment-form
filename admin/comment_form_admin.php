<?php

class Comment_Form_Admin extends Comment_Form_Main {

    public function __construct() {
        parent::__construct();

        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        add_action('admin_menu', array($this, 'add_menu_item'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    /**
     * Enqueue admin assets
     *
     * @since 1.0.0
     *
     * @param void
     * @return void
     */
    public function enqueue_admin_assets() {
        $plugin_slug = SNAZZY_COMMENTS_PLUGIN_SLUG;

        wp_enqueue_style( "{$plugin_slug}-admin-styles", plugin_dir_url( SNAZZY_COMMENTS__FILE__ ) . 'admin/dist/main.css', array(), SNAZZY_COMMENTS_PLUGIN_VERSION );
        wp_enqueue_script( "{$plugin_slug}-admin-scripts", plugin_dir_url( SNAZZY_COMMENTS__FILE__ ) . 'admin/dist/main.js', array( 'jquery', 'underscore' ), SNAZZY_COMMENTS_PLUGIN_VERSION, true );
    }

    /**
     * add a menu item unter the comment comments menu
     *
     * @since 1.0.0
     */
    public function add_menu_item() {
        add_comments_page(
            __('Customize Comment Form', 'commentform'),
            __('Comment Form', 'commentform'),
            'manage_options',
            'comment-form-customizer',
            array($this, 'render_settings_page')
        );
    }

    /**
     * render the comment form settings page
     *
     * @since 1.0.0
     */
    public function render_settings_page() {
        $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'fields';
        ?>
        <div id="<?php echo esc_attr( SNAZZY_COMMENTS_PLUGIN_SLUG . '-admin' ) ?>">
            <div class="<?php echo esc_attr( SNAZZY_COMMENTS_PLUGIN_SLUG . '-wrap' ) ?> wrap">

                <h1><?php esc_attr_e('Snazzy Comments', 'snazzy-comments'); ?></h1>
            
                <div class="snazzy-comments-container flex">
                    <div class="form-container">
                        <div class="nav-tab-wrapper">
                            <a href="?page=comment-form-customizer&tab=fields" class="nav-tab <?php echo esc_attr($active_tab) == 'fields' ? 'nav-tab-active' : ''; ?>">
                                <?php esc_attr_e('Fields', 'snazzy-comments'); ?>
                            </a>
                            <a href="?page=comment-form-customizer&tab=text" class="nav-tab <?php echo esc_attr($active_tab) == 'text' ? 'nav-tab-active' : ''; ?>">
                                <?php esc_attr_e('Text', 'snazzy-comments'); ?>
                            </a>
                            <a href="?page=comment-form-customizer&tab=layout" class="nav-tab <?php echo esc_attr($active_tab) == 'layout' ? 'nav-tab-active' : ''; ?>">
                                <?php esc_attr_e('Layout', 'snazzy-comments'); ?>
                            </a>
                            <a href="?page=comment-form-customizer&tab=recaptcha" class="nav-tab <?php echo esc_attr($active_tab) == 'recaptcha' ? 'nav-tab-active' : ''; ?>">
                                <?php esc_attr_e('Recaptcha', 'snazzy-comments'); ?>
                                <span class="pro-pill">PRO</span>
                            </a>
                            <a href="?page=comment-form-customizer&tab=email" class="nav-tab <?php echo esc_attr($active_tab) == 'email' ? 'nav-tab-active' : ''; ?>">
                                <?php esc_attr_e('Email Integration', 'snazzy-comments'); ?>
                                <span class="pro-pill">PRO</span>
                            </a>
                        </div>

                        <form method="post" action="options.php">
                            <?php settings_fields( 'comment_form_url_section' ); ?>
                            <?php if ($active_tab === 'fields') : ?>
                                <div class="box-container"><?php do_settings_sections( 'comment-form-fields' ); ?></div>
                            <?php elseif ($active_tab === 'text' ) : ?>
                                <div class="box-container"><?php do_settings_sections( 'comment-form-text' ); ?></div>
                            <?php elseif ($active_tab === 'layout' ) : ?>
                                <div class="box-container"><?php do_settings_sections( 'comment-form-layout' ); ?></div>
                            <?php endif; ?>
                            <?php submit_button(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * initialize settings with Settings API
     *
     * @since 1.0.0
     * @link http://codex.wordpress.org/Settings_API
     */
    public function register_settings() {
        // register setting for $_POST handling
        register_setting(
            'comment_form_url_section',
            'commentform_settings',
            array( 'sanitize_callback' => array( $this, 'sanitize_settings' ) )
        );
    }

    /**
	 * sanitize and save the option
	 */
    public function sanitize_settings ( $data ){

    	$data['text_before'] = wp_kses_post( $data['text_before'] );
    	$data['text_after']  = wp_kses_post( $data['text_after'] );

    	return $data;
	}

}

// Include pages
require_once( 'views/fields.php' );
require_once( 'views/text.php' );
require_once( 'views/layout.php' );