<?php
/**
 * Plugin Name: Shift8 Full Nav
 * Plugin URI: https://github.com/stardothosting/shift8-fullnav
 * Description: This plugin adds a sticky menu to your site. When the menu is clicked it expands to the full screen
 * Version: 1.40
 * Author: Shift8 Web 
 * Author URI: https://www.shift8web.ca
 * License: GPLv3
 */

require_once(plugin_dir_path(__FILE__).'components/enqueuing.php' );
require_once(plugin_dir_path(__FILE__).'components/settings.php' );
require_once(plugin_dir_path(__FILE__).'components/functions.php' );

// Admin welcome page
if (!function_exists('shift8_main_page')) {
	function shift8_main_page() {
	?>
	<div class="wrap">
	<h2>Shift8 Plugins</h2>
	Shift8 is a Toronto based web development and design company. We specialize in Wordpress development and love to contribute back to the Wordpress community whenever we can! You can see more about us by visiting <a href="https://www.shift8web.ca" target="_new">our website</a>.
	</div>
	<?php
	}
}

// Admin settings page
function shift8_fullnav_settings_page() {
	$fullnav_logo = esc_attr( get_option('shift8_fullnav_logo'));
	$fullnav_logo_id = shift8_fullnav_get_image_id($fullnav_logo);
	$fullnav_logo_thumb = wp_get_attachment_image_src($fullnav_logo_id, 'thumbnail');
	$fullnav_google_fonts = shift8_get_google_fonts();
?>
<div class="wrap">
<h2>Shift8 Full Nav Settings</h2>
<?php if (is_admin()) { ?>
<form method="post" action="options.php">
    <?php settings_fields( 'shift8-fullnav-settings-group' ); ?>
    <?php do_settings_sections( 'shift8-fullnav-settings-group' ); ?>
    <?php
	$locations = get_theme_mod( 'nav_menu_locations' );
	if (!empty($locations)) {
		foreach ($locations as $locationId => $menuValue) {
			if (has_nav_menu($locationId)) {
				$shift8_fullnav_menu = $locationId;
			}
		}
	}

	if (!has_nav_menu($shift8_fullnav_menu)) {
                echo '<span style="color:red;">You need to create a primary menu in Appearances -> menus first!</span>';
	}
	?>
    <table class="form-table">
	<tr valign="top">
	<th scope="row">Core Settings</th>
	</tr>
	<tr valign="top">
	<td>Enable Full Nav : </td>
	<td>
	<?php 
	if (esc_attr( get_option('shift8_fullnav_enabled') ) == 'on') { 
		$enabled_checked = "checked";
	} else {
		$enabled_checked = "";
	}
	?>
                <label class="switch">
                <input type="checkbox" name="shift8_fullnav_enabled" <?php echo $enabled_checked; ?>>
                <div class="slider round"></div>
                </label>
	</td>
	</tr>
	<tr valign="top">
        <td>Enable Mobile Mode : </td>
        <td>
        <?php
        if (esc_attr( get_option('shift8_fullnav_mobilemode') ) == 'on') {
                $mobile_enabled_checked = "checked";
        } else {
                $mobile_enabled_checked = "";
        }
        ?>
                <label class="switch">
                <input type="checkbox" name="shift8_fullnav_mobilemode" <?php echo $mobile_enabled_checked; ?>>
                <div class="slider round"></div>
                </label>
        </td>
	</th>
	</tr>
        <tr valign="top">
        <td>Select a Nav Menu to use : </td>
        <td>
        <div class="shift8-fullnav-select">
                <select name="shift8_fullnav_navlocation">
                        <option>Site default nav</option>
                        <?php
                            $menus = get_registered_nav_menus();
                            foreach ( $menus as $location => $description ) {
                                $selected = ($location == get_option('shift8_fullnav_navlocation') ? 'selected' : '');
                                echo "<option value='" . $location . "' " . $selected . ">" . esc_attr( $description ) . "</option>";
                            }
                        ?>
                </select>
        </div>
        </td>
        </tr>
        <tr valign="top">
        <td>Screen width mobile breakpoint : </td><td><input size="6" type="text" name="shift8_fullnav_mobilebreak" value="<?php echo esc_attr( get_option('shift8_fullnav_mobilebreak') ); ?>" /> (px)</td>
        </tr>
        <tr valign="top">
        <th scope="row">Menu Bar Logo</th>
	</tr>
	<tr valign="top">
	<td><input type="hidden" name="shift8_fullnav_logo" id="shift8_fullnav_logo" value="<?php echo esc_attr( get_option('shift8_fullnav_logo') );  ?>" />
        <input type="button" id="shift8_fullnav_image_button" class="button" style="vertical-align:bottom;" value="<?php _e( 'Choose or Upload Logo', 'prfx-textdomain' )?>" name="shift8_fullnav_logo" /></td>
        <?php if (!empty($fullnav_logo_thumb[0])) { ?>
		<td><img src="<?php echo $fullnav_logo_thumb[0]; ?>"></td>
		<?php } ?>
        </tr>
        <tr valign="top">
        <th scope="row">Font Options</th>
        </tr>
        <tr valign="top">
        <td>Menu Bar Font Color :</td><td><input type="text" name="shift8_fullnav_bar_font_col" value="<?php echo esc_attr( get_option('shift8_fullnav_bar_font_col') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
        </tr>
        <tr valign="top">
        <td>Menu Bar Font : </td>
	<td>
		<div class="shift8-fullnav-select">
		<select name="shift8_fullnav_bar_font">
			<option>Site default font</option>
			<?php
                                foreach ($fullnav_google_fonts as $fullnav_google_font) {
                                        $fullnav_google_font_item = esc_attr( $fullnav_google_font->family ) . ":" . implode(',', $fullnav_google_font->variants );
                                        $selected = ($fullnav_google_font_item == get_option('shift8_fullnav_bar_font') ? 'selected' : '');
                                        echo "<option value='" . $fullnav_google_font_item . "' " . $selected . ">" . esc_attr( $fullnav_google_font->family ) . "</option>";
                                }
			?>
		</select> 
		</div>
	</td>
        </tr>
        <tr valign="top">
        <td>Menu Bar Font Size : </td><td><input size="6" type="text" name="shift8_fullnav_bar_font_siz" value="<?php echo esc_attr( get_option('shift8_fullnav_bar_font_siz') ); ?>" /> (px)</td>
        </tr>
	<tr valign="top"><td><div class="font-option-divider"></div></td></tr>
        <tr valign="top">
        <td>Menu Overlay Font color : </td><td><input type="text" name="shift8_fullnav_ovr_font_col" value="<?php echo esc_attr( get_option('shift8_fullnav_ovr_font_col') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
        </tr>
        <tr valign="top">
        <td>Menu Overlay Font : </td>
        <td>
		<div class="shift8-fullnav-select">
                <select name="shift8_fullnav_ovr_font">
                        <option>Site default font</option>
                        <?php
                                foreach ($fullnav_google_fonts as $fullnav_google_font) {
					$fullnav_google_font_item = esc_attr( $fullnav_google_font->family ) . ":" . implode(',', $fullnav_google_font->variants );
					$selected = ($fullnav_google_font_item == get_option('shift8_fullnav_ovr_font') ? 'selected' : ''); 
					echo "<option value='" . $fullnav_google_font_item . "' " . $selected . ">" . esc_attr( $fullnav_google_font->family ) . "</option>";
                                }
                        ?>
                </select>
		</div>
        </td>
        </tr>
        <td>Menu Overlay Font Size : </td><td><input size="6" type="text" name="shift8_fullnav_ovr_font_siz" value="<?php echo esc_attr( get_option('shift8_fullnav_ovr_font_siz') ); ?>" /> (px)</td>
        </tr>
        <tr valign="top"><td><div class="font-option-divider"></div></td></tr>
                <tr valign="top">
        <td>Menu Dropdown Font Color :</td><td><input type="text" name="shift8_fullnav_drp_font_col" value="<?php echo esc_attr( get_option('shift8_fullnav_drp_font_col') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
        </tr>
        <tr valign="top">
        <td>Menu Dropdown Font : </td>
        <td>
                <div class="shift8-fullnav-select">
                <select name="shift8_fullnav_drp_font">
                        <option>Site default font</option>
                        <?php
                                foreach ($fullnav_google_fonts as $fullnav_google_font) {
                                        $fullnav_google_font_item = esc_attr( $fullnav_google_font->family ) . ":" . implode(',', $fullnav_google_font->variants );
                                        $selected = ($fullnav_google_font_item == get_option('shift8_fullnav_drp_font') ? 'selected' : '');
                                        echo "<option value='" . $fullnav_google_font_item . "' " . $selected . ">" . esc_attr( $fullnav_google_font->family ) . "</option>";
                                }
                        ?>
                </select>
                </div>
        </td>
        </tr>
        <tr valign="top">
        <td>Menu Dropdown Font Size : </td><td><input size="6" type="text" name="shift8_fullnav_drp_font_siz" value="<?php echo esc_attr( get_option('shift8_fullnav_drp_font_siz') ); ?>" /> (px)</td>
        </tr>
        <tr valign="top">
        <th scope="row">Design Options</th>
	</tr>
	<tr valign="top">
        <td>Menu Bar Color :</td><td><input type="text" name="shift8_fullnav_design_bar_col" value="<?php echo esc_attr( get_option('shift8_fullnav_design_bar_col') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
	</tr>
	<tr valign="top">
        <td>Menu Bar Transparency : </td><td><div id="barTraFilter" style="background-color:<?php echo esc_attr( get_option('shift8_fullnav_design_bar_col') ); ?>"></div><div id="barTraSlider"><input id="barTra" type="range" name="shift8_fullnav_design_bar_tra" value="<?php echo esc_attr( get_option('shift8_fullnav_design_bar_tra') ); ?>" max="1.0" min="0" step="0.01"/></div></td>
	</tr>
	<tr valign="top">
        <td>Overlay color : </td><td><input type="text" name="shift8_fullnav_design_ovr_col" value="<?php echo esc_attr( get_option('shift8_fullnav_design_ovr_col') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
	</tr>
	<tr valign="top">
        <td>Overlay transparency : </td><td><div id="ovrTraFilter" style="background-color:<?php echo esc_attr( get_option('shift8_fullnav_design_ovr_col') ); ?>"></div><div id="ovrTraSlider"><input id="ovrTra" type="range" name="shift8_fullnav_design_ovr_tra" value="<?php echo esc_attr( get_option('shift8_fullnav_design_ovr_tra') ); ?>" max="1.0" min="0" step="0.01"/></div></td>
        </tr>
        <tr valign="top">
        <td>Menu Dropdown Color :</td><td><input type="text" name="shift8_fullnav_design_drp_bak" value="<?php echo esc_attr( get_option('shift8_fullnav_design_drp_bak') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
        </tr>
        <tr valign="top">
        <td>Menu Dropdown Hover Color :</td><td><input type="text" name="shift8_fullnav_design_drp_hvr" value="<?php echo esc_attr( get_option('shift8_fullnav_design_drp_hvr') ); ?>" class="fullnav-color-field" data-default-color="#666666" /></td>
        </tr>
        <tr valign="top">
        <td>Menu Sub Dropdown Color :</td><td><input type="text" name="shift8_fullnav_design_drp_subbak" value="<?php echo esc_attr( get_option('shift8_fullnav_design_drp_subbak') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
        </tr>
        <tr valign="top">
        <td>Menu Sub Dropdown Hover Color :</td><td><input type="text" name="shift8_fullnav_design_drp_subhvr" value="<?php echo esc_attr( get_option('shift8_fullnav_design_drp_subhvr') ); ?>" class="fullnav-color-field" data-default-color="#666666" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Social Media Links</th>
	</tr>
        <tr valign="top">
        <td>Twitter : </td><td><input type="text" name="shift8_fullnav_social_twitter" value="<?php echo esc_attr( get_option('shift8_fullnav_social_twitter') ); ?>" /></td>
        </tr>
	<tr valign="top">
        <td>Facebook : </td><td><input type="text" name="shift8_fullnav_social_facebook" value="<?php echo esc_attr( get_option('shift8_fullnav_social_facebook') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <td>Instagram : </td><td><input type="text" name="shift8_fullnav_social_instagram" value="<?php echo esc_attr( get_option('shift8_fullnav_social_instagram') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <td>Google Plus : </td><td><input type="text" name="shift8_fullnav_social_googleplus" value="<?php echo esc_attr( get_option('shift8_fullnav_social_googleplus') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <td>Linkedin : </td><td><input type="text" name="shift8_fullnav_social_linkedin" value="<?php echo esc_attr( get_option('shift8_fullnav_social_linkedin') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php 
	} // is_admin
}

// add the menu if its switched on
if (esc_attr( get_option('shift8_fullnav_enabled') ) == 'on') {
	add_action('wp_footer', 'add_shift8_fullnav_menu', 1);
}
