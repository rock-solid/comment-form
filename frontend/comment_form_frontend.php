<?php
class Comment_Form_Frontend extends Comment_Form_Main{

    /**
     * @since 1.0.0
     */
    public function __construct() {
        parent::__construct();

        // register comment form main fields filter
        add_filter('comment_form_default_fields', array($this, 'main_fields_filter'));

    }

    /**
     * filter for main fields
     *
     * @since 1.0.0
     * @see /wp-includes/comment-template.php comment_form()
     *
     * @param arr $fields array with main fields for comment form
     */
    public function main_fields_filter($fields){

        $option = get_option('cf_setting_hide_url');
        if($option)
            unset($fields['url']);

        return $fields;

    }
}