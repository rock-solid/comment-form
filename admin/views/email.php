<?php

defined( 'ABSPATH' ) or exit;

class Comment_Form_Admin_Email extends Comment_Form_Main {
    public function __construct() {
        add_action('admin_init', array($this, 'sc_settings_email'));
    }

    public function sc_settings_email() {
        add_settings_section(
            'comment_form_email_section',
            '',
            array($this, 'render_email_section_callback'),
            'comment-form-email'
        );

        add_settings_field(
            'commentform_settings_mailchimp',
            __('Email integration', 'commentform'),
            array($this, 'render_mailchimp_field_callback'),
            'comment-form-email',
            'comment_form_email_section'
        );
    }

    /**
     * section to customize comment notes
     *
     * @since 1.0.0
     */
    public function render_email_section_callback() { ?>
        <div class="heading">
            <h2 class="mb-4"><?php _e('Email Integration', 'commentform') ?></h2>
        </div>
        <p><?php _e('Lorem ipsum') ?></p>
        <hr>
    <?php }

    /**
     * enable mailchimp field settings
     * 
     * @since 1.0.0
     */
    public function render_mailchimp_field_callback() { 
        $images_url = plugin_dir_url( SNAZZY_COMMENTS__FILE__ ) . 'admin/assets/images/'; ?>
        <?php
            $this->generate_toggle(
                'commentform_settings[enable_mailchimp]',
                '1',
                checked(1, $this->options('enable_mailchimp'), false),
                true,
                'Enable Mailchimp',
                '.mailchimp-inputs'
            );
        ?>

        <div class="mailchimp-inputs mt-4" style="display: none">
            <div class="flex items-center <?php echo ( sc_fs()->is__premium_only() ? '' : 'opacity-40' ) ?>">
                <div class="flex items-center text-green-100 font-medium mr-4">
                    <img src="<?php echo esc_url( $images_url . 'key.svg' ) ?>" class="mr-2" alt=""> API key
                </div>
                <div class="input-wrapper">
                    <input name="commentform_settings[mailchimp_api_key]" type="text"
                    <?php echo ( sc_fs()->is__premium_only() ? '' : 'disabled' ) ?>>
                    <div class="input-append copy-button">COPY</div>
                </div>
            </div>

            <div class="btn-o-round inline-block mt-4">Fetch audiences</div>
        </div>
    <?php }
}

new Comment_Form_Admin_Email();