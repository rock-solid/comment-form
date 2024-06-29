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
    public function options($field = false){
        $defaults = $this->get_default_options();
        $options = wp_parse_args(get_option('commentform_settings', array()), $defaults);

        $this->options = $options;

        if($field != '' && isset($options[$field])) {
            return $options[$field];
        } elseif($field != false && !isset($options[$field])) {
            return false;
        } else {
            return $options;
        }
    }

    /**
     * pro badge wrap generator
     * 
     * @since 1.0.0
     * 
     */
    public function generate_unlock_badge() {
        $images_url = plugin_dir_url( SNAZZY_COMMENTS__FILE__ ) . 'admin/assets/images/'; ?>
        <?php if (!sc_fs()->is__premium_only()) : ?>
            <a href="" target="_blank" class="unlock-pill">
                <img src="<?php echo esc_url( $images_url . 'lock.svg' ) ?>" alt="">
                Unlock
            </a>
        <?php endif; ?>
    <?php }

    /**
     * checkbox component element wrap generator
     * 
     * @since 1.0.0
     * 
     * 
     */
    public function generate_checkbox($name, $value, $checked_attr, $is_pro, $label) { ?>
        <label class="checkbox-wrapper <?php echo $is_pro ? ( sc_fs()->is__premium_only() ? '' : 'disabled' ) : '' ?>">
            <input type="checkbox"
                name="<?php echo $name ?>"
                value="<?php echo $value ?>"
                <?php echo $checked_attr ?>
                <?php echo $is_pro ? ( sc_fs()->is__premium_only() ? '' : 'disabled' ) : '' ?>>
            <span class="thumb"></span>
            <?php if ( !empty( $label ) ) : ?>
                <span><?php _e($label, 'snazzy-comments') ?></span>
            <?php endif; ?>
            <?php echo $is_pro ? $this->generate_unlock_badge() : null; ?>
        </label>
    <?php }

    /**
     * toggle switch component element wrap generator
     * 
     * @since 1.0.0
     * 
     * 
     */
    public function generate_toggle($name, $value, $checked_attr, $is_pro, $label, ?string $showHideElementSelector) { ?>
        <div class="toggle-switch">
            <input type="checkbox"
                name="<?php echo $name ?>"
                value="<?php echo $value ?>"
                <?php echo $checked_attr ?>
                <?php echo $is_pro ? ( sc_fs()->is__premium_only() ? '' : 'disabled' ) : '' ?>
                <?php echo $showHideElementSelector ? 'data-show-hide-elements="' . $showHideElementSelector . '"' : ''?>>
            <?php if ( !empty( $label ) ) : ?>
                <span><?php _e($label, 'snazzy-comments') ?></span>
            <?php endif; ?>
            <?php echo $is_pro ? $this->generate_unlock_badge() : null; ?>
        </div>
    <?php }

    /**
     * prepare default options
     *
     * @since 1.0.0
     */
    public function get_default_options(){

        $req = get_option( 'require_name_email' );
        $required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

        $defaults = array(
            'hide_notes_after' => 0,
            'hide_notes_before' => 0,
            'remove_email' => false,
            'remove_email_css' => false,
            'hide_url' => 0,
            'hide_url_css' => false,
            'text_after' => '',
            'text_before' => '',
            'two_columns' => false
        );

        return $defaults;
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
