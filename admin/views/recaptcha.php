<?php

defined( 'ABSPATH' ) or exit;

class Comment_Form_Admin_Recaptcha extends Comment_Form_Main {
    public function __construct() {
        add_action('admin_init', array($this, 'sc_settings_recaptcha'));
    }

    public function sc_settings_recaptcha() {
        add_settings_section(
            'comment_form_recaptcha_section',
            '',
            array($this, 'render_recaptcha_section_callback'),
            'comment-form-recaptcha'
        );

        add_settings_field(
          'commentform_settings_keys',
          '',
          array($this, 'render_recaptcha_key_field_callback'),
          'comment-form-recaptcha',
          'comment_form_recaptcha_section'
        );
    }

    /**
     * section to recaptcha
     *
     * @since 1.0.0
     */
    public function render_recaptcha_section_callback() { ?>
        <div class="heading">
            <h2 class="mb-4"><?php _e('reCAPTCHA', 'commentform') ?></h2>
        </div>
        <p>
            <?php _e('Use this site key in the HMTL code your site serves to users.') ?>
            <?php if ( !sc_fs()->is__premium_only() ) : ?>
            <?php $this->generate_unlock_badge() ?>
            <?php endif; ?>
        </p>
        <hr>
    <?php }

    /**
     * site key fields
     * 
     * @since 1.0.0
     */
    public function render_recaptcha_key_field_callback() { 
        $images_url = plugin_dir_url( SNAZZY_COMMENTS__FILE__ ) . 'admin/assets/images/'; ?>
        
        <div class="flex items-center <?php echo ( sc_fs()->is__premium_only() ? '' : 'opacity-40' ) ?>">
            <div class="flex items-center text-green-100 font-medium mr-4" style="width: 120px">
                <img src="<?php echo esc_url( $images_url . 'key.svg' ) ?>" class="mr-2" alt=""> SITE KEY
            </div>
            <input name="commentform_settings[recaptcha_site_key]" type="text"
            <?php echo ( sc_fs()->is__premium_only() ? '' : 'disabled' ) ?>>
        </div>
        
        <div class="flex items-center mt-4 <?php echo ( sc_fs()->is__premium_only() ? '' : 'opacity-40' ) ?>">
            <div class="flex items-center text-green-100 font-medium mr-4" style="width: 120px">
                <img src="<?php echo esc_url( $images_url . 'key.svg' ) ?>" class="mr-2" alt=""> SECRET KEY
            </div>
            <input name="commentform_settings[recaptcha_secret_key]" type="text"
            <?php echo ( sc_fs()->is__premium_only() ? '' : 'disabled' ) ?>>
        </div>
    <?php }
}

new Comment_Form_Admin_Recaptcha();