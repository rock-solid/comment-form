<?php

class Comment_Form_Admin extends Comment_Form_Main {

    public function __construct() {
        parent::__construct();

        add_action('admin_menu', array($this, 'add_menu_item'));
        add_action('admin_init', array($this, 'register_settings'));
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
            
                <form method="post" action="options.php">
                    <?php
                        // This prints out all hidden setting fields
                        // settings_fields( 'comment_form_fields_group' );
                        
                        settings_fields( 'comment_form_url_section' );
                        do_settings_sections( 'comment-form-fields' );
                        do_settings_sections( 'comment-form-text' );
                        do_settings_sections( 'comment-form-layout' );
                        submit_button();
                    ?>
                </form>
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