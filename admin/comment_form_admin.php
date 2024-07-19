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
    
        wp_localize_script(
            "{$plugin_slug}-admin-scripts",
            'SNAZZYWP',
            [
                'pluginSlug' => $plugin_slug,
            ]
        );
    }

    /**
     * add a menu item unter the comment comments menu
     *
     * @since 1.0.0
     */
    public function add_menu_item() {
        add_comments_page(
            __('Customize Comment Form', 'commentform'),
            __('Snazzy Comments', 'commentform'),
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
        $images_url = plugin_dir_url( SNAZZY_COMMENTS__FILE__ ) . 'admin/assets/images/';
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
                                <?php if (!sc_fs()->is__premium_only()) : ?>
                                <span class="pro-pill">PRO</span>
                                <?php endif; ?>
                            </a>
                            <a href="?page=comment-form-customizer&tab=email" class="nav-tab <?php echo esc_attr($active_tab) == 'email' ? 'nav-tab-active' : ''; ?>">
                                <?php esc_attr_e('Email Integration', 'snazzy-comments'); ?>
                                <?php if (!sc_fs()->is__premium_only()) : ?>
                                <span class="pro-pill">PRO</span>
                                <?php endif; ?>
                            </a>
                        </div>

                        <form method="post" action="options.php">
                            <?php settings_fields( 'comment_form_url_section' ); ?>
                            <div class="box-container" style="<?php echo ($active_tab === 'fields' ) ? '' : 'display: none' ?>">
                                <?php do_settings_sections( 'comment-form-fields' ); ?>
                            </div>
                            <div class="box-container" style="<?php echo ($active_tab === 'text' ) ? '' : 'display: none' ?>">
                                <?php do_settings_sections( 'comment-form-text' ); ?>
                            </div>
                            <div class="box-container" style="<?php echo ($active_tab === 'layout' ) ? '' : 'display: none' ?>">
                                <?php do_settings_sections( 'comment-form-layout' ); ?>
                            </div>
                            <div class="box-container" style="<?php echo ($active_tab === 'recaptcha' ) ? '' : 'display: none' ?>">
                                <?php do_settings_sections( 'comment-form-recaptcha' ); ?>
                            </div>
                            <div class="box-container" style="<?php echo ($active_tab === 'email' ) ? '' : 'display: none' ?>">
                                <?php do_settings_sections( 'comment-form-email' ); ?>
                            </div>
                            <?php submit_button(__('Save', 'snazzy-comments'), 'btn-submit'); ?>
                        </form>
                    </div>

                    <div class="right-panel">
                        <?php if (!sc_fs()->is__premium_only()) : ?>
                        <div class="bg-white-100 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="mb-4">Unlock all settings</h3>
                                    <p class="text-base">Use code <span class="promo">snaz</span> to <br><b>get 10%</b> on all plans!</p>
                                </div>

                                <div class="flex-shrink-0">
                                    <img src="<?php echo esc_url( $images_url . 'campaign.svg' ) ?>" alt="">
                                </div>
                            </div>

                            <a href="" class="btn-round mt-4">
                                <img class="mr-4" src="<?php echo esc_url( $images_url . 'ticket.svg' ) ?>" alt="">
                                Buy now
                            </a>
                        </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <div class="text-green-100 font-bold mb-6">Explore more from Snazzy Comments</div>
                            
                            <a href="" class="flex items-center">
                                <img class="panel-image" src="<?php echo esc_url( $images_url . 'rightpanel1.svg' ) ?>" alt="">
                                
                                <span class="text-green-100">View plugin docs & FAQs</span>
                            </a>

                            <a href="mailto:info@rocksoliddigital.com" class="flex items-center mt-4">
                                <img class="panel-image" src="<?php echo esc_url( $images_url . 'rightpanel2.svg' ) ?>" alt="">
                                
                                <span class="text-green-100">Suggest a feature </span>
                            </a>

                            <a href="" class="flex items-center mt-4">
                                <img class="panel-image" src="<?php echo esc_url( $images_url . 'rightpanel3.svg' ) ?>" alt="">
                                
                                <span class="text-green-100">Like this plugin? Please give us a 5 star review!</span>
                            </a>

                            <a href="" class="flex items-center mt-4">
                                <img class="panel-image" src="<?php echo esc_url( $images_url . 'rightpanel4.svg' ) ?>" alt="">
                                
                                <span class="text-green-100">Check out other Rock Solid Plugins</span>
                            </a>
                        </div>
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
        $data['recaptcha_site_key'] = wp_kses_post( $data['recaptcha_site_key'] );
    	$data['recaptcha_secret_key']  = wp_kses_post( $data['recaptcha_secret_key'] );

    	return $data;
	}

}

// Include pages
require_once( 'views/fields.php' );
require_once( 'views/text.php' );
require_once( 'views/layout.php' );
require_once( 'views/recaptcha.php' );
require_once( 'views/email.php' );