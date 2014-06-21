<?php
/**
 * Plugin Name: Comment Form
 * Description: Easily customize the standard comment form.
 * Version: 1.0.0
 * Plugin URI: http://webgilde.com/
 * Author: Thomas Maier
 * Author URI: http://www.webgilde.com/
 * License: GPL v2 or later
 *

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
//avoid direct calls to this file
if (!function_exists('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

define('CFVERSION', '1.0.0');
define('CFDIR', basename(dirname(__FILE__)));
define('CFPATH', plugin_dir_path(__FILE__));

if (!class_exists('Cf_Class')) {

    class Cf_Class {

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

            load_plugin_textdomain("commentform", false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
        }

    }

    $ima = new Cf_Class();
}
