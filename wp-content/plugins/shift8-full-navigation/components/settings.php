<?php

// create custom plugin settings menu
add_action('admin_menu', 'shift8_fullnav_create_menu');
function shift8_fullnav_create_menu() {
        //create new top-level menu
        if ( empty ( $GLOBALS['admin_page_hooks']['shift8-settings'] ) ) {
                add_menu_page('Shift8 Settings', 'Shift8', 'administrator', 'shift8-settings', 'shift8_main_page' , 'dashicons-building' );
        }
        add_submenu_page('shift8-settings', 'Full Nav Settings', 'Full Nav Settings', 'manage_options', __FILE__.'/custom', 'shift8_fullnav_settings_page');
        //call register settings function
        add_action( 'admin_init', 'register_shift8_fullnav_settings' );
}

// Register admin settings
function register_shift8_fullnav_settings() {
    //register our settings
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_enabled' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_mobilemode' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_mobilebreak' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_navlocation' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_logo' );

    // options for menu fonts
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_bar_font' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_bar_font_col' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_bar_font_siz' );

    // options for menu overlay font
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_ovr_font' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_ovr_font_col' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_ovr_font_siz' );

    // options for menu dropdown font
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_drp_font' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_drp_font_col' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_drp_font_siz' );

    // options for menu bar and overlay color and opacity
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_bar_col' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_bar_tra' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_ovr_col' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_ovr_tra' );

    // Dropdown hover and bg colors
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_drp_bak' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_drp_hvr' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_drp_subbak' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_drp_subhvr' );

    // options for social media accounts
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_facebook' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_twitter' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_instagram' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_googleplus' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_linkedin' );
}
