<?php

// Load custom CSS and JS
function shift8_fullnav_scripts() {
        // pop out nav
        wp_enqueue_style( 'shift8-fullnav-style', plugin_dir_url(dirname(__FILE__)) . 'css/style.css');
        wp_enqueue_script( 'shift8-fullnav-modern', plugin_dir_url(dirname(__FILE__)) . 'js/modernizr.js', array(), true );
    	wp_enqueue_script( 'shift8_fullnav_main', plugin_dir_url(dirname(__FILE__)) . 'js/main.js', array(), true);
        // font awesome
        wp_enqueue_style( 'font-awesome-real', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );

        // Build inline style for menu based on administrative options chosen
        $shift8_fullnav_bar_color = hex2rgba(esc_attr( get_option('shift8_fullnav_design_bar_col') ), $opacity = esc_attr( get_option('shift8_fullnav_design_bar_tra')));
        $shift8_fullnav_ovr_color = hex2rgba(esc_attr( get_option('shift8_fullnav_design_ovr_col') ), $opacity = esc_attr( get_option('shift8_fullnav_design_ovr_tra')));

        // Dropdown hover & colors
        $shift8_fullnav_drp_color = (esc_attr( get_option('shift8_fullnav_design_drp_bak') ) ? esc_attr( get_option('shift8_fullnav_design_drp_bak') ) : '#212121');
        $shift8_fullnav_drp_hover_color = (esc_attr( get_option('shift8_fullnav_design_drp_hvr') ) ? esc_attr( get_option('shift8_fullnav_design_drp_hvr') ) : '#3e3c3c');
        $shift8_fullnav_drp_subcolor = (esc_attr( get_option('shift8_fullnav_design_drp_subbak') ) ? esc_attr( get_option('shift8_fullnav_design_drp_subbak') ) : '#212121');
        $shift8_fullnav_drp_subhover_color = (esc_attr( get_option('shift8_fullnav_design_drp_subhvr') ) ? esc_attr( get_option('shift8_fullnav_design_drp_subhvr') ) : '#3e3c3c');

        // Load google fonts if necessary
        $shift8_fullnav_bar_font = (esc_attr( get_option('shift8_fullnav_bar_font') ) == "Site default font" ? "inherit" : explode(':', esc_attr( get_option('shift8_fullnav_bar_font') ), 2));
        $shift8_fullnav_bar_font_color = (esc_attr( get_option('shift8_fullnav_bar_font_col') ) ? esc_attr( get_option('shift8_fullnav_bar_font_col') ) : 'inherit');
        $shift8_fullnav_bar_font_size = ( esc_attr( get_option('shift8_fullnav_bar_font_siz') ) ? esc_attr( get_option('shift8_fullnav_bar_font_siz') ) . 'px' : 'inherit');

        $shift8_fullnav_ovr_font = (esc_attr( get_option('shift8_fullnav_ovr_font') ) == "Site default font" ? "inherit" : explode(':', esc_attr( get_option('shift8_fullnav_ovr_font') ), 2));
        $shift8_fullnav_ovr_font_color = (esc_attr( get_option('shift8_fullnav_ovr_font_col') ) ? esc_attr( get_option('shift8_fullnav_ovr_font_col') ) : 'inherit');
        $shift8_fullnav_ovr_font_size = ( esc_attr( get_option('shift8_fullnav_ovr_font_siz') ) ? esc_attr( get_option('shift8_fullnav_ovr_font_siz') ) . 'px' : 'inherit');

        $shift8_fullnav_drp_font = (esc_attr( get_option('shift8_fullnav_drp_font') ) == "Site default font" ? "inherit" : explode(':', esc_attr( get_option('shift8_fullnav_drp_font') ), 2));
        $shift8_fullnav_drp_font_color = (esc_attr( get_option('shift8_fullnav_drp_font_col') ) ? esc_attr( get_option('shift8_fullnav_drp_font_col') ) : 'inherit');
        $shift8_fullnav_drp_font_size = ( esc_attr( get_option('shift8_fullnav_drp_font_siz') ) ? esc_attr( get_option('shift8_fullnav_drp_font_siz') ) . 'px' : 'inherit');

        // Fix if its an array
        $shift8_fullnav_bar_font = (is_array($shift8_fullnav_bar_font) ? "'" . $shift8_fullnav_bar_font[0] . "'" : $shift8_fullnav_bar_font);
        $shift8_fullnav_ovr_font = (is_array($shift8_fullnav_ovr_font) ? "'" . $shift8_fullnav_ovr_font[0] . "'" : $shift8_fullnav_ovr_font);
        $shift8_fullnav_drp_font = (is_array($shift8_fullnav_drp_font) ? "'" . $shift8_fullnav_drp_font[0] . "'" : $shift8_fullnav_drp_font);

        // Force mobile menu if option is enabled
        if (esc_attr( get_option('shift8_fullnav_mobilemode') ) == 'on') {
                $shift8_fullnav_mobileonly_css = "
                        .fn-secondary-nav {
                                display:none !important;
                        }
                        .fn-primary-nav-trigger {
                                display: inline-block !important;
                        }
                ";
        } else {
                $shift8_fullnav_mobileonly_css = null;
		$shift8_fullnav_mobilebreak = ( esc_attr( get_option('shift8_fullnav_mobilebreak') ) ? esc_attr( get_option('shift8_fullnav_mobilebreak') ) : '980');
        }

        $shift8_fullnav_custom_css = "
                .fn-header {
                        background-color: {$shift8_fullnav_bar_color};
                }
                .fn-primary-nav {
                        background-color: {$shift8_fullnav_ovr_color};
                }
                .fn-secondary-nav a, .fn-menu-text {
                        font-family: {$shift8_fullnav_bar_font};
			font-size: {$shift8_fullnav_bar_font_size};
                        color : {$shift8_fullnav_bar_font_color};
                }
                .fn-primary-nav-trigger {
                        color: {$shift8_fullnav_bar_font_color};
                }
                .fn-menu-icon, .fn-menu-icon::after, .fn-menu-icon::before, .fn-primary-nav-trigger .fn-menu-icon.is-clicked::before, .fn-primary-nav-trigger .fn-menu-icon.is-clicked::after {
                        background-color: {$shift8_fullnav_bar_font_color};
                }
                .fn-menu-icon.is-clicked {
                        background-color: transparent;
               }
                .fn-primary-nav a {
                        font-family: {$shift8_fullnav_ovr_font};
			font-size: {$shift8_fullnav_ovr_font_size};
                        color : {$shift8_fullnav_ovr_font_color};
                }
		.fn-sub-menu a {
			font-family: {$shift8_fullnav_drp_font};
			font-size: {$shift8_fullnav_drp_font_size};
			color: {$shift8_fullnav_drp_font_color};
		}
        .fn-sub-menu {
            background-color: {$shift8_fullnav_drp_color};
        }
        .fn-sub-menu > li > a:hover {
            background-color: {$shift8_fullnav_drp_hover_color};
        }
        .fn-sub-menu > li > ul > li {
            background-color: {$shift8_fullnav_drp_subcolor};
        }
        .fn-sub-menu > li > ul > li > a:hover {
            background-color: {$shift8_fullnav_drp_subhover_color};
        }

        .shift8-social {
            color: {$shift8_fullnav_ovr_font_color};
        }
		.fn-arrow-up {
			width: 0;
			height: 0;
			border-left: 8px solid transparent;
			border-right: 8px solid transparent;
			border-bottom: 8px solid {$shift8_fullnav_ovr_font_color};
			position:absolute;
			margin-top:10px;
		}
		.fn-arrow-down {
			width: 0;
			height: 0;
			border-left: 8px solid transparent;
			border-right: 8px solid transparent;
			border-top: 8px solid {$shift8_fullnav_ovr_font_color};
			position:absolute;
			margin-top:10px;
		}

		/* responsive */
		@media only screen and (min-width: {$shift8_fullnav_mobilebreak}px) {
			.fn-header {
				height: 80px;
				box-shadow: none;
			}
		}

		@media only screen and (min-width: {$shift8_fullnav_mobilebreak}px) {
			.fn-header {
				-webkit-transition: background-color 0.3s;
				-moz-transition: background-color 0.3s;
				transition: background-color 0.3s;
				-webkit-transform: translate3d(0, 0, 0);
				-moz-transform: translate3d(0, 0, 0);
				-ms-transform: translate3d(0, 0, 0);
				-o-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
				-webkit-backface-visibility: hidden;
				backface-visibility: hidden;
			}
			.fn-header.is-fixed {
				position: fixed;
				top: -80px;
				-webkit-transition: -webkit-transform 0.3s;
				-moz-transition: -moz-transform 0.3s;
				transition: transform 0.3s;
			}
			.fn-header.is-visible {
				-webkit-transform: translate3d(0, 100%, 0);
				-moz-transform: translate3d(0, 100%, 0);
				-ms-transform: translate3d(0, 100%, 0);
				-o-transform: translate3d(0, 100%, 0);
				transform: translate3d(0, 100%, 0);
			}
		}

		@media only screen and (min-width: {$shift8_fullnav_mobilebreak}px) {
			.fn-logo {
				left: 2.6em;
			}
		}

		@media only screen and (max-width: {$shift8_fullnav_mobilebreak}px) {
			.fn-secondary-nav {
				display: none;
			}
			.fn-primary-nav-trigger, .fn-primary-nav-trigger .fn-menu-text {
				dispaly:block;
			}
		}

		@media only screen and (min-width: {$shift8_fullnav_mobilebreak}px) {
			.fn-primary-nav-trigger {
				display: none;
				width: 100px;
				padding-left: 1em;
				background-color: transparent;
				height: 30px;
				line-height: 30px;
				right: 2.2em;
				top: 50%;
				bottom: auto;
				-webkit-transform: translateY(-50%);
				-moz-transform: translateY(-50%);
				-ms-transform: translateY(-50%);
				-o-transform: translateY(-50%);
				transform: translateY(-50%);
			}
			.fn-primary-nav-trigger .fn-menu-icon {
				left: auto;
				right: 0.6em;
				-webkit-transform: translateX(0) translateY(-50%);
				-moz-transform: translateX(0) translateY(-50%);
				-ms-transform: translateX(0) translateY(-50%);
				-o-transform: translateX(0) translateY(-50%);
				transform: translateX(0) translateY(-50%);
			}
		}

		@media only screen and (min-width: {$shift8_fullnav_mobilebreak}px) {
			.fn-primary-nav {
				padding: 80px 0;
			}
		}

		@media only screen and (min-width: {$shift8_fullnav_mobilebreak}px) {
			.fn-intro h1 {
				font-size: 30px;
				font-size: 1.875rem;
			}
		}
                " . $shift8_fullnav_mobileonly_css . "
        ";

        wp_add_inline_style( 'shift8-fullnav-style', $shift8_fullnav_custom_css );
}
/* Google Fonts */
function shift8_fullnav_load_google_fonts() {
        $shift8_bar_font = get_option('shift8_fullnav_bar_font');
        $shift8_ovr_font = get_option('shift8_fullnav_ovr_font');

        if ($shift8_bar_font != "Site default font") {
                wp_enqueue_style( 'shift8-fullnav-bar-font', '//fonts.googleapis.com/css?family=' . $shift8_bar_font );
        }
        if ($shift8_ovr_font != "Site default font") {
                wp_enqueue_style( 'shift8-fullnav-ovr-font', '//fonts.googleapis.com/css?family=' . $shift8_ovr_font );
        }
}

// Enqueue scripts and styles if enabled
if (esc_attr( get_option('shift8_fullnav_enabled') ) == 'on') {
        add_action( 'wp_enqueue_scripts', 'shift8_fullnav_scripts', 12,1 );
        add_action( 'wp_print_styles', 'shift8_fullnav_load_google_fonts');
}

// Register admin scripts for custom fields
function load_shift8_fullnav_wp_admin_style() {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'fullnav-color-picker-script', plugin_dir_url(dirname(__FILE__)) . 'js/shift8_fullnav_color.js', array( 'wp-color-picker' ), false, true );
        // admin always last
        wp_enqueue_style( 'shift8_fullnav_css', plugin_dir_url(dirname(__FILE__)) . 'css/shift8_fullnav_admin.css' );
        wp_enqueue_media();
        wp_enqueue_script( 'shift8_fullnav_script', plugin_dir_url(dirname(__FILE__)) . 'js/shift8_fullnav_admin.js' );
}
add_action( 'admin_enqueue_scripts', 'load_shift8_fullnav_wp_admin_style' );
