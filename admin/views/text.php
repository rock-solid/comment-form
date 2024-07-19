<?php

defined( 'ABSPATH' ) or exit;

class Comment_Form_Admin_Text extends Comment_Form_Main {
    public function __construct() {
        add_action('admin_init', array($this, 'sc_settings_text'));
    }

    public function sc_settings_text() {
        add_settings_section(
            'comment_form_texts_section',
            '',
            array($this, 'render_texts_section_callback'),
            'comment-form-text'
        );

        add_settings_field(
            'commentform_settings_notes_before',
            __('Texts before the form', 'commentform'),
            array($this, 'render_comment_notes_before_callback'),
            'comment-form-text',
            'comment_form_texts_section'
        );

        add_settings_field(
            'commentform_settings_notes_after',
            __('Texts after the form', 'commentform'),
            array($this, 'render_comment_notes_after_callback'),
            'comment-form-text',
            'comment_form_texts_section'
        );

        add_settings_field(
            'commentform_settings_consent_text',
            __('Texts for consent', 'commentform'),
            array($this, 'render_comment_consent_text_callback'),
            'comment-form-text',
            'comment_form_texts_section'
        );
    }

    /**
     * section to customize comment notes
     *
     * @since 1.0.0
     */
    public function render_texts_section_callback() { ?>
        <div class="heading">
            <h2 class="mb-4"><?php _e('Texts', 'commentform') ?></h2>
        </div>
        <p><?php _e('Customizing additional notes and texts.') ?></p>
        <hr>
    <?php }

    /**
     * add addtional text before the form
     *
     * @since 1.0.0
     */
    public function render_comment_notes_before_callback() { ?>
        <textarea rows="5" name="commentform_settings[text_before]"><?php $this->options('text_before') ?></textarea>
        <p><?php _e('This text is inserted between the headline and the first output if commenting is allowed to the user.', 'commentform') ?></p>
        <?php 
            $this->generate_checkbox(
                'commentform_settings[hide_notes_before]',
                '1',
                checked(1, $this->options('hide_notes_before'), false),
                false,
                'Remove default text before the form'
            ); 
        ?>
        <p><?php _e('This is currently:', 'commentform') ?></p>
        <?php
            $req = get_option( 'require_name_email' );
            $required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
        ?>
        <blockquote><i>
            <?php _e( 'Your email address will not be published.', 'commentform' ) ?>
            <?php echo ( $req ? $required_text : '' ) ?>
        </i></blockquote>
    <?php }

    /**
     * add addtional text after the form
     *
     * @since 1.0.0
     */
    public function render_comment_notes_after_callback() { ?>
        <?php 
            $this->generate_checkbox(
                'commentform_settings[hide_notes_after]',
                '1',
                checked(1, $this->options('hide_notes_after'), false),
                false,
                'Remove default text after the form'
            ); 
        ?>
        <p><?php _e('This is currently:', 'commentform') ?></p>
        <p><?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:' ) ?></p>

        <code style="width: 600px"><?php echo allowed_tags() ?></code>

        <textarea rows="5" name="commentform_settings[text_after]" class="mt-4"><?php $this->options('text_after') ?></textarea>
        <p><?php _e('This text is inserted after the form when commenting if commiting is allowed to the user.', 'commentform') ?></p>
    <?php }

    /**
     * Change consent text
     *
     * @since 1.0.0
     */
    public function render_comment_consent_text_callback() { ?>
        <?php 
            $this->generate_checkbox(
                'commentform_settings[cookies_consent]',
                '1',
                checked(1, $this->options('cookies_consent'), false),
                false,
                'Remove consent default text'
            ); 
        ?>
        <p><?php _e('This is currently:', 'commentform') ?></p>
        <p><?php _e( 'Save my name, email, and website in this browser for the next time I comment.' ) ?></p>
        
        <textarea rows="5" name="commentform_settings[cookies_text]"><?php $this->options('cookies_text') ?></textarea>
        <p><?php _e('If the consent field is enabled, this text will appear beside it.', 'commentform') ?></p>
    <?php }
}

new Comment_Form_Admin_Text();