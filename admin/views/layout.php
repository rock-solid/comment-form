<?php

defined( 'ABSPATH' ) or exit;

class Comment_Form_Admin_Layout extends Comment_Form_Main {
    public function __construct() {
        add_action('admin_init', array($this, 'sc_settings_layout'));
    }

    public function sc_settings_layout() {
        add_settings_section(
            'comment_form_layout_section',
            __('Layouts', 'commentform'),
            array($this, 'render_layout_section_callback'),
            'comment-form-layout'
        );

        add_settings_field(
            'commentform_settings_two_columns',
            __('two column layout', 'commentform'),
            array($this, 'render_two_columns_callback'),
            'comment-form-layout',
            'comment_form_layout_section'
        );
    }

    /**
     * section to choose layout and layout options
     *
     * @since 1.2.0
     */
    public function render_layout_section_callback() {
        echo '<p>'.__('Changing the layout of the comment forms.').'</p>';
    }

    /**
     * render comment form with a two column layout
     *
     * @since 1.2.0
     */
    public function render_two_columns_callback() {
        echo '<input name="commentform_settings[two_columns]" id="commentform_settings_two_columns" type="checkbox" value="1" class="code" ' . checked(1, $this->options('two_columns'), false) . ' />';
        echo '<label for="commentform_settings_two_columns">'. __('two column layout', 'commentform') .'</label>';
        echo '<p class="description">'.__('Use a simple two column layout for your comment form.', 'commentform').'</p>';
    }
}

new Comment_Form_Admin_Layout();