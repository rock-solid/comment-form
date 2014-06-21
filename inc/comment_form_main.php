<?php

class Comment_Form_Main {

    /**
     * initialize the plugin
     * @since 1.0
     */
    public function __construct() {
        // Load plugin text domain
        add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
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
