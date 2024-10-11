<?php

defined( 'ABSPATH' ) or exit;

class Comment_Form_Admin_Layout extends Comment_Form_Main {
  public function __construct() {
      add_action( 'admin_init', array($this, 'sc_settings_layout') );
  }

  public function sc_settings_layout() {
      add_settings_section(
        'comment_form_layout_section',
        '',
        array($this, 'render_layout_section_callback'),
        'comment-form-layout'
      );

      add_settings_field(
        'commentform_settings_two_columns',
        __( 'Two column layout', 'commentform' ),
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
    ?>
        <div class="heading">
            <h2 class="mb-4"><?php _e( 'Layouts', 'commentform' ) ?></h2>
        </div>
        <p><?php _e( 'Changing the layout of the comment forms.' ) ?></p>
        <hr>
  <?php }

    /**
     * render comment form with a two column layout
     *
     * @since 1.2.0
     */
  public function render_two_columns_callback() {
    ?>
        <?php
          $this->generate_checkbox(
            'commentform_settings[two_columns]',
            '1',
            checked( 1, $this->options( 'two_columns' ), false ),
            false,
            'Two column layout'
          );
        ?>
        <p><?php _e( 'Use a simple two column layout for your comment form.', 'commentform' ) ?></p>
  <?php }
}

new Comment_Form_Admin_Layout();