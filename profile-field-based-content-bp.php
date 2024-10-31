<?php
/* 
Plugin Name: Profile field based content shortcode
Plugin URI: http://www.poolgab.com
Description: A simple WordPress plugin to show content based on Buddypress profile field 
Version: 1.0
Author: alexhal
Author URI: http://www.poolgab.com
License: GPL2
*/
/*
Copyright 2014  Poolgab  (email : alexvibealex@gmail.com)

c program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

Group member mail plugin program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with wplms_customizer program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



include_once 'classes/pfbc.class.php';


if(class_exists('Profile_Field_Based_Content'))
{	
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('Profile_Field_Based_Content', 'activate'));
    register_deactivation_hook(__FILE__, array('Profile_Field_Based_Content', 'deactivate'));
     
}
add_action('bp_init','pfbc_plugin_init');
function pfbc_plugin_init(){
    if ( bp_is_active( 'xprofile' ) ) :
    // instantiate the plugin class
    $pfbc = new Profile_Field_Based_Content();
    endif;
}
add_action( 'plugins_loaded', 'profile_field_based_content_bp_language_setup' );
function profile_field_based_content_bp_language_setup(){
    $locale = apply_filters("plugin_locale", get_locale(), 'pfbc');
    
    $lang_dir = dirname( __FILE__ ) . '/languages/';
    $mofile        = sprintf( '%1$s-%2$s.mo', 'pfbc', $locale );
    $mofile_local  = $lang_dir . $mofile;
    $mofile_global = WP_LANG_DIR . '/plugins/' . $mofile;

    if ( file_exists( $mofile_global ) ) {
        load_textdomain( 'pfbc', $mofile_global );
    } else {
        load_textdomain( 'pfbc', $mofile_local );
    }   
}