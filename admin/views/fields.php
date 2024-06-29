<?php

defined( 'ABSPATH' ) or exit;

class Comment_Form_Admin_Fields extends Comment_Form_Main {
    public function __construct() {
        add_action('admin_init', array($this, 'sc_settings_fields'));
    }

    public function sc_settings_fields() {
        add_settings_section(
            'comment_form_fields_section',
            '',
            array($this, 'render_fields_section_callback'),
            'comment-form-fields'
        );
    
        add_settings_field(
            'commentform_settings_hide_url',
            __('Remove url field', 'commentform'),
            array($this, 'render_hide_url_field_callback'),
            'comment-form-fields',
            'comment_form_fields_section'
        );
    
        add_settings_field(
            'commentform_settings_remove_email',
            __('Remove email field', 'commentform'),
            array($this, 'render_remove_email_field_callback'),
            'comment-form-fields',
            'comment_form_fields_section'
        );
    }
    
    /**
     * content put at the top of the url section on the comment form settings apge
     *
     * @since 1.0.0
     */
    public function render_fields_section_callback() { ?>
        <div class="heading">
            <h2 class="mb-4"><?php _e('Fields', 'commentform') ?></h2>
        </div>
        <p><?php _e('Customizing the field where a commenter can write his url into.')?></p>
        <hr>
    <?php }
    
    /**
     * content of the hide url setting
     *
     * @since 1.0.0
     */
    public function render_hide_url_field_callback() { ?>
        <?php 
            $this->generate_checkbox(
                'commentform_settings[hide_url]',
                '1',
                checked(1, $this->options('hide_url'), false),
                false,
                'Remove website field'
            ); 
        ?>
        <p><?php _e('Removes the "website" field from the frontend programmatically.', 'commentform') ?></p>
        <?php
            $this->generate_checkbox(
                'commentform_settings[hide_url_css]',
                '1',
                checked(1, $this->options('hide_url_css'), false),
                false,
                'Remove website field with css'
            );
        ?>
        <p><?php _e('Removes the "website" field with css. Use this only if the method above doesn’t work. This uses "display:none" on the most common css selectors for the url field. The value might still get submitted by bots and tech-savvy users.', 'commentform') ?></p>
    <?php }
    
    /**
     * email field settings
     *
     * @since 1.2.0
     */
    public function render_remove_email_field_callback() {
        $req = get_option( 'require_name_email' ); ?>
        <?php if ($req) : ?>
        <p class="warning"><?php echo sprintf(__('Your current setting requires the email field to be filled. Change this option <a href="%s">here</a> before removing the field.', 'commentform'), admin_url() . 'options-discussion.php') ?></p>
        <?php endif; ?>
        <?php
            $this->generate_checkbox(
                'commentform_settings[remove_email]',
                '1',
                checked(1, $this->options('remove_email'), false),
                false,
                'Remove email field'
            );
        ?>
        <p><?php _e('Removes the "email" field from the frontend programmatically.', 'commentform') ?></p>
        <?php
            $this->generate_checkbox(
                'commentform_settings[remove_email_css]',
                '1',
                checked(1, $this->options('remove_email_css'), false),
                false,
                'Remove email field with css'
            );
        ?>
        <p><?php _e('Removes the "email" field with css. Use this only if the method above doesn’t work. This uses "display:none" on the most common css selectors for the email field. The value might still get submitted by bots and tech-savvy users.', 'commentform') ?></p>
    <?php }
}

new Comment_Form_Admin_Fields();