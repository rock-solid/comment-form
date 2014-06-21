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
        add_comments_page(__('Customize Comment Form', 'commentform'), __('Comment Form', 'commentform'), 'manage_options', 'comment-form-customizer', array($this, 'render_settings_page'));
    }

    /**
     * render the comment form settings page
     *
     * @since 1.0.0
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'comment_form_url_section' );
                do_settings_sections( 'comment-form-customizer' );
                submit_button();
            ?>
            </form>
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
        // add sections to comment form settings page
        add_settings_section('comment_form_url_section', __('Commenter URL', 'commentform'), array($this, 'render_url_section_callback'), 'comment-form-customizer');

        // add settings fields
        add_settings_field('cf_setting_hide_url', __('remove url field', 'commentform'), array($this, 'render_hide_url_field_callback'), 'comment-form-customizer', 'comment_form_url_section');

        // register setting for $_POST handling
        register_setting('comment_form_url_section', 'cf_setting_hide_url');
    }

    /**
     * content put at the top of the url section on the comment form settings apge
     *
     * @since 1.0.0
     */
    public function render_url_section_callback() {
        echo '<p>'.__('Customizing the field where a commenter can write his url into.').'</p>';
    }

    /**
     * content of the hide url setting
     *
     * @since 1.0.0
     */
    public function render_hide_url_field_callback() {
        echo '<input name="cf_setting_hide_url" id="cf_setting_hide_url" type="checkbox" value="1" class="code" ' . checked(1, get_option('cf_setting_hide_url'), false) . ' />';
        echo '<p class="description">'.__('Removes the "website" field from the frontend.').'</p>';
    }

}
