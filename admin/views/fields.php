<?php

defined( 'ABSPATH' ) or exit;

class Comment_Form_Admin_Fields extends Comment_Form_Main {
    public function __construct() {
        add_action('admin_init', array($this, 'sc_settings_fields'));
    }

    public function sc_settings_fields() {
        add_settings_section(
            'comment_form_fields_section',
            __('Fields', 'commentform'),
            array($this, 'render_fields_section_callback'),
            'comment-form-fields'
        );
    
        add_settings_field(
            'commentform_settings_hide_url',
            __('remove url field', 'commentform'),
            array($this, 'render_hide_url_field_callback'),
            'comment-form-fields',
            'comment_form_fields_section'
        );
    
        add_settings_field(
            'commentform_settings_remove_email',
            __('remove email field', 'commentform'),
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
    public function render_fields_section_callback() {
        echo '<p>'.__('Customizing the field where a commenter can write his url into.').'</p>';
    }
    
    /**
     * content of the hide url setting
     *
     * @since 1.0.0
     */
    public function render_hide_url_field_callback() {
        echo '<input name="commentform_settings[hide_url]" id="commentform_settings_hide_url" type="checkbox" value="1" class="code" ' . checked(1, $this->options('hide_url'), false) . ' />';
        echo '<label for="commentform_settings_hide_url">'. __('remove website field', 'commentform') .'</label>';
        echo '<p class="description">'.__('Removes the "website" field from the frontend programmatically.', 'commentform').'</p>';
        echo '<input name="commentform_settings[hide_url_css]" id="commentform_settings_hide_url_css" type="checkbox" value="1" class="code" ' . checked(1, $this->options('hide_url_css'), false) . ' />';
        echo '<label for="commentform_settings_hide_url_css">'. __('remove website field with css', 'commentform') .'</label>';
        echo '<p class="description">'.__('Removes the "website" field with css. Use this only if the method above doesn’t work. This uses "display:none" on the most common css selectors for the url field. The value might still get submitted by bots and tech-savvy users.', 'commentform').'</p>';
    }
    
    /**
     * email field settings
     *
     * @since 1.2.0
     */
    public function render_remove_email_field_callback() {
        $req = get_option( 'require_name_email' );
        if($req){
            echo '<p class="warning">'.sprintf(__('Your current setting requires the email field to be filled. Change this option <a href="%s">here</a> before removing the field.', 'commentform'), admin_url() . 'options-discussion.php').'</p>';
        }
        echo '<input name="commentform_settings[remove_email]" id="commentform_settings_remove_email" type="checkbox" value="1" class="code" ' . checked(1, $this->options('remove_email'), false) . ' />';
        echo '<label for="commentform_settings_remove_email">'. __('remove email field', 'commentform') .'</label>';
        echo '<p class="description">'.__('Removes the "email" field from the frontend programmatically.', 'commentform').'</p>';
        echo '<input name="commentform_settings[remove_email_css]" id="commentform_settings_remove_email_css" type="checkbox" value="1" class="code" ' . checked(1, $this->options('remove_email_css'), false) . ' />';
        echo '<label for="commentform_settings_remove_email_css">'. __('remove email field with css', 'commentform') .'</label>';
        echo '<p class="description">'.__('Removes the "email" field with css. Use this only if the method above doesn’t work. This uses "display:none" on the most common css selectors for the email field. The value might still get submitted by bots and tech-savvy users.', 'commentform').'</p>';
    }
}

new Comment_Form_Admin_Fields();