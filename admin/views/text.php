<?php

defined( 'ABSPATH' ) or exit;

class Comment_Form_Admin_Text extends Comment_Form_Main {
    public function __construct() {
        add_action('admin_init', array($this, 'sc_settings_text'));
    }

    public function sc_settings_text() {
        add_settings_section(
            'comment_form_texts_section',
            __('Texts', 'commentform'),
            array($this, 'render_texts_section_callback'),
            'comment-form-text'
        );

        add_settings_field(
            'commentform_settings_notes_before',
            __('texts before the form', 'commentform'),
            array($this, 'render_comment_notes_before_callback'),
            'comment-form-text',
            'comment_form_texts_section'
        );

        add_settings_field(
            'commentform_settings_notes_after',
            __('texts after the form', 'commentform'),
            array($this, 'render_comment_notes_after_callback'),
            'comment-form-text',
            'comment_form_texts_section'
        );
    }

    /**
     * section to customize comment notes
     *
     * @since 1.0.0
     */
    public function render_texts_section_callback() {
        echo '<p>'.__('Customizing additional notes and texts.').'</p>';
    }

    /**
     * add addtional text before the form
     *
     * @since 1.0.0
     */
    public function render_comment_notes_before_callback() {
        echo '<textarea name="commentform_settings[text_before]" id="commentform_settings_text_before">' . $this->options('text_before') . '</textarea>';
        echo '<p class="description">'.__('This text is inserted between the headline and the first output if commenting is allowed to the user.', 'commentform').'</p>';
        echo '<br/>';
        echo '<input name="commentform_settings[hide_notes_before]" id="commentform_settings_hide_notes_before" type="checkbox" value="1" class="code" ' . checked(1, $this->options('hide_notes_before'), false) . ' />';
        echo '<label for="commentform_settings_hide_notes_before">'. __('remove default text before the form', 'commentform') .'</label>';
        echo '<p class="description">'.__('This is currently:', 'commentform').'</p>';

        $req = get_option( 'require_name_email' );
        $required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

        echo '<blockquote><i>' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</i></blockquote>';

    }

    /**
     * add addtional text after the form
     *
     * @since 1.0.0
     */
    public function render_comment_notes_after_callback() {
        echo '<input name="commentform_settings[hide_notes_after]" id="commentform_settings_hide_notes_after" type="checkbox" value="1" class="code" ' . checked(1, $this->options('hide_notes_after'), false) . ' />';
        echo '<label for="commentform_settings_hide_notes_after">'. __('remove default text after the form', 'commentform') .'</label>';
        echo '<p class="description">'.__('This is currently:', 'commentform').'</p>';

        echo '<blockquote><i>' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</i></blockquote>';
        echo '<br/>';
        echo '<textarea name="commentform_settings[text_after]" id="commentform_settings_text_after">' . $this->options('text_after') . '</textarea>';
        echo '<p class="description">'.__('This text is inserted after the form when commenting if commiting is allowed to the user.', 'commentform').'</p>';
    }
}

new Comment_Form_Admin_Text();