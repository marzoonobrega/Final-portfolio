<?php

// Inject menu system in header
function add_shift8_fullnav_menu() {
        $chosen_menu = esc_attr( get_option('shift8_fullnav_navlocation'));
        // Build array from primary nav menu
        $locations = get_theme_mod( 'nav_menu_locations' );
        $shift8_fullnav_menu = array();

		foreach ($locations as $menuValue => $locationId) {
			if ($chosen_menu == $menuValue) {
				$location_obj = wp_get_nav_menu_object( $locationId );
				$shift8_fullnav_menu = array(
					'location_id' => $locationId,
					'location_name' => $menuValue,
					);
			} else if (has_nav_menu($locationId)) {
                    $shift8_fullnav_menu = array(
                        'location_id' => $locationId,
                        'location_name' => $menuValue,
                    );
			}
		}

        $menu_locations = get_nav_menu_locations();
        $menu_id = $menu_locations['$shift8_fullnav_menu'];
  //$menu_id = $menu_locations[ $shift8_fullnav_menu ] ;
        $menu_array = wp_get_nav_menu_items($menu_id);

        echo '<header class="fn-header is-visible is-fixed">
        <div class="fn-logo"><a href="' . get_site_url() . '"><img src="' . esc_attr( get_option('shift8_fullnav_logo')) . '" alt="Logo"></a></div>
        <a class="fn-primary-nav-trigger" href="#0">
        <span class="fn-menu-text">Menu</span><span class="fn-menu-icon"></span>
        </a>';
	$count = 0;
	$submenu = false;
	$first_level = $first_levels = $second_level = $second_levels = null;

    // Desktop Menu
	wp_nav_menu( array(
		'menu_id' => $shift8_fullnav_menu['location_id'],
		'theme_location' => $shift8_fullnav_menu['location_name'],
	    'container' => 'nav',
        'container_class' => 'desktop-menu',
        'menu_class' => 'fn-secondary-nav',
        'items_wrap' => shift8_woocommerce_icon(),
        'walker'          => new Shift8_Walker_Nav_Menu_Desktop()
	 ));

    echo '</header>';

	// Mobile Menu
    wp_nav_menu( array(
		'menu_id' => $shift8_fullnav_menu['location_id'],
		'theme_location' => $shift8_fullnav_menu['location_name'],
        'container' => 'nav',
        'container_class' => 'mobile-menu',
        'menu_class' => 'fn-primary-nav',
        'depth' => '2',
		'items_wrap' => shift8_mobile_social(),
        'walker'          => new Shift8_Walker_Nav_Menu_Mobile()
    ));

}

// Custom walker for desktop menu
class Shift8_Walker_Nav_Menu_Desktop extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {
        if ($depth >= "0") {
            $output .= "<ul class=\"fn-dropdown-content level-".$depth." fn-sub-menu \">\n";
        } else { 
			$output .= "<ul class=\"fn-secondary-nav\">\n";
		}
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $wp_query;
        $this->curItem = $item;
        //$class_names = 'fn-dropdown fn-menu-item-' . $item->ID;
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        $output .= '<li class="' . $class_names . ' fn-dropdown fn-menu-item-' . $item->ID . '">';
        $attributes  = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';


        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}

// Custom walker for mobile menu
class Shift8_Walker_Nav_Menu_Mobile extends Walker_Nav_Menu {
	private $curItem;

    function start_lvl(&$output, $depth = 0, $args = array()) {
        if ($depth == "0") {
            $output .= "<span id=\"fn-arrow-dropdown\" class=\"fn-arrow-down\"></span>";
            $output .= "<ul class=\"fn-mobile-dropdown-content fn-mobile-dropdown-content-" . $this->curItem->ID . " level-".$depth."\">\n";
        } else if ($depth == "1") {
            $output .= null;
        }
    }
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $wp_query;
		$this->curItem = $item;
		$class_names = 'fn-menu-mobile-parent fn-menu-mobile-parent-item-' . $item->ID;

		$output .= '<li class="' . $class_names . '">';
        $attributes  = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';


        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

		if (!$depth) {
			$output .= '<script>
                    		jQuery(".fn-menu-mobile-parent-item-' . $item->ID . '").click( function() {
							if (jQuery(".fn-menu-mobile-parent-item-' . $item->ID . ' #fn-arrow-dropdown").hasClass("fn-arrow-down")) {
								jQuery(".fn-menu-mobile-parent-item-' . $item->ID . ' #fn-arrow-dropdown").removeClass("fn-arrow-down");
								jQuery(".fn-menu-mobile-parent-item-' . $item->ID . ' #fn-arrow-dropdown").addClass("fn-arrow-up");
							} else {
								jQuery(".fn-menu-mobile-parent-item-' . $item->ID . ' #fn-arrow-dropdown").removeClass("fn-arrow-up");
								jQuery(".fn-menu-mobile-parent-item-' . $item->ID . ' #fn-arrow-dropdown").addClass("fn-arrow-down");
							}
							jQuery(".fn-mobile-dropdown-content-' . $item->ID . '").slideToggle();
					});
					</script>';
		}
	} 
}

// Generate Woocommerce shopping cart icon if installed
function shift8_woocommerce_icon() {

    // open the <ul>, set 'menu_class' and 'menu_id' values
    $wrap  = '<ul id="%1$s" class="%2$s">';

      // get nav items as configured in /wp-admin/
    $wrap .= '%3$s';

	// Add woocommerce cart link if it exists
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$count = WC()->cart->cart_contents_count;
		$wrap .= '<li class="fn-dropdown"><a class="title header-cart-count" href="' . WC()->cart->get_cart_url() . '"><i class="fa fa-shopping-cart">&nbsp;</i> ' . esc_html( $count ) . '</a></li>';
	}
	
	$wrap .= '</ul>';
	
	return $wrap;
}

// Generate social icons for mobile menu
function shift8_mobile_social() {

	// open the <ul>, set 'menu_class' and 'menu_id' values
	$wrap  = '<ul id="%1$s" class="%2$s">';
  
	  // get nav items as configured in /wp-admin/
	$wrap .= '%3$s';

	// build social icons
	$social_twitter = (esc_attr( get_option('shift8_fullnav_social_twitter') ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_twitter') ) . '" target="_new"><i class="fa fa-twitter"></i></a></li>' : '');
	$social_facebook = (esc_attr( get_option('shift8_fullnav_social_facebook') ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_facebook') ) . '" target="_new"><i class="fa fa-facebook"></i></a></li>' : '');
	$social_googleplus = (esc_attr( get_option('shift8_fullnav_social_googleplus') ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_googleplus') ) . '" target="_new"><i class="fa fa-google-plus"></i></a></li>' : '');
	$social_linkedin = (esc_attr( get_option('shift8_fullnav_social_linkedin') ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_linkedin') ) . '" target="_new"><i class="fa fa-linkedin"></i></a></li>' : '');
	$social_instagram = (esc_attr( get_option('shift8_fullnav_social_instagram') ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_instagram') ) . '" target="_new"><i class="fa fa-instagram"></i></a></li>' : '');

	$wrap .= $social_twitter . $social_facebook . $social_googleplus . $social_instagram . $social_linkedin;

	$wrap .= '</ul>';

	return $wrap;
}
// Convert hexdec color string to rgb(a) string
function hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if(empty($color))
        return $default;

        //Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
                $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
                if(abs($opacity) > 1)
                $opacity = 1.0;
                $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
                $output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}

// Function to get image ID
function shift8_fullnav_get_image_id($image_url) {
        global $wpdb;
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
}

// Function to get list of Google Fonts
function shift8_get_google_fonts() {
        $apikey = 'AIzaSyAc-nHc5ViyUFP_yLVIZMTcxb7qSq_JnhM';
        $fontFile = plugin_dir_path( __FILE__ ) . 'cache/fonts.json';

        //Total time the file will be cached in seconds, set to a week
        $cachetime = 86400 * 7;
        if(file_exists($fontFile) && $cachetime < filemtime($fontFile)) {
                $content = json_decode(file_get_contents($fontFile));
        } else {
                $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=' . $apikey;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_URL, $googleApi);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $fontContent = curl_exec($ch);
                curl_close($ch);
                $fp = fopen($fontFile, 'w');
                fwrite($fp, $fontContent);
                fclose($fp);
                $content = json_decode($fontContent);
        }
        if($amount == 'all') {
                return $content->items;
        } else {
                return array_slice($content->items, 0, $amount);
        }
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    /* update cart count when add to cart is clicked */
    add_filter( 'woocommerce_add_to_cart_fragments', 'shift8_cart_count_fragments', 10, 1 );
}
function shift8_cart_count_fragments( $fragments ) {
    $fragments['a.header-cart-count'] = '<a class="title header-cart-count" href="' . WC()->cart->get_cart_url() . '"><i class="fa fa-shopping-cart">&nbsp;</i> ' . WC()->cart->get_cart_contents_count() . '</a>';
    return $fragments;
}

// Multi dimensional array search
function shift8_multi_search($array, $key, $value) {
	$results = array();

	if (is_array($array)) {
		if (isset($array[$key]) && $array[$key] == $value) {
			$results[] = $array;
		}

		foreach ($array as $subarray) {
			$results = array_merge($results, shift8_multi_search($subarray, $key, $value));
		}
	}

	return $results;
}
