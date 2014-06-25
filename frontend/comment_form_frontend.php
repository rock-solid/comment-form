<?php
class Comment_Form_Frontend extends Comment_Form_Main{

    /**
     * @since 1.0.0
     * @see /wp-includes/comment-template.php comment_form() for all hooks and filters applied here
     */
    public function __construct() {
        parent::__construct();

        // comment form main fields filter
        add_filter('comment_form_default_fields', array($this, 'comment_form_default_fields_filter'));
        // comment form defaults filter
        add_filter('comment_form_defaults', array($this, 'comment_form_defaults_filter'));
        // comment form do before printing the form
        add_action('comment_form_top', array($this, 'comment_form_top_action'));
        // comment form do after closing the form
        add_action('comment_form_after', array($this, 'comment_form_after_action'));

    }

    /**
     * filter for main fields
     *
     * @since 1.0.0
     * @see /wp-includes/comment-template.php comment_form()
     *
     * @param arr $fields array with main fields for comment form
     */
    public function comment_form_default_fields_filter($fields){

        $options = $this->options();

        // hide the url field
        if($options['hide_url'] && isset($fields['url'])) {
            unset($fields['url']);
        }

        return $fields;
    }

    /**
     * filter for additional comment form default settings
     *
     * @since 1.0.0
     *
     * @oaram arr $defaults array with default settings
     */
    public function comment_form_defaults_filter($defaults){

        $options = $this->options();

        // hide the default text before the form
        if($options['hide_notes_before']){
            $defaults['comment_notes_before'] = '';
        }
        // hide the default text after the form
        if($options['hide_notes_after']){
            $defaults['comment_notes_after'] = '';
        }
        return $defaults;
    }

    /**
     * action to do before the comment field, e.g. printing a custom message
     *
     * @since 1.0.0
     */
    public function comment_form_top_action(){

        $options = $this->options();

        // print custom text before the form
        if(isset($options['text_before']) && $options['text_before'] != ''){
            echo '<p class="comment_notes">'. $options['text_before'] .'</p>';
        }
    }

    /**
     * action to do after the comment field, e.g. printing a custom message
     *
     * @since 1.0.0
     */
    public function comment_form_after_action(){

        $options = $this->options();

        // print custom text before the form
        if(isset($options['text_after']) && $options['text_after'] != ''){
            echo '<p class="comment_text_after">'. $options['text_after'] .'</p>';
        }
    }
}