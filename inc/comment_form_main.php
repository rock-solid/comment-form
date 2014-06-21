<?php

class Comment_Form_Main {

    /**
     * array with plugin options and settings
     *
     * @since 1.0.0
     */
    public $options = array();

    /**
     * initialize the plugin
     *
     * @since 1.0
     */
    public function __construct() {
        // load options

        // load plugin text domain
        add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
    }

    /**
     * get and load plugin options
     *
     * @since 1.0.0
     *
     * @param str $field which option to return
     *  empty to return all of them
     */
    public function options($field = ''){
        $defaults = array(
            'hide_url' => 0
        );
        $options = wp_parse_args(get_option('commentform_settings', array()), $defaults);

        $this->options = $options;

        if($field != '' && isset($options[$field])) {
            return $options[$field];
        } else {
            return $options;
        }
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.2.0
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain("commentform", false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

}
